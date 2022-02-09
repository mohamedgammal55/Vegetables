<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    public function orders(Request $request){
        $data = Order::with('details.product')
            ->where('added_by_id',auth()->user()->id)->latest()->get();
        return helperJson($data);
    }//end fun
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeOrder(Request $request){
        $rules = [
            'id'=>'required|unique:orders,id',
            'customer_name'=>'required|min:3|max:500',
            'total'=>'required|regex:/^\d+(\.\d{1,9})?$/',
            'discount'=>'required|regex:/^\d+(\.\d{1,9})?$/',
            'tax'=>'required|regex:/^\d+(\.\d{1,9})?$/',
            "order_date_time"=>'required|numeric',
            "details"=>'required|array',
            "details.*"=>'required|array',
            "details.*.product_id"=>'required|exists:products,id',
            "details.*.total"=>'required|regex:/^\d+(\.\d{1,9})?$/',
            "details.*.qty"=>'required|regex:/^\d+(\.\d{1,9})?$/',
            "details.*.price"=>'required|regex:/^\d+(\.\d{1,9})?$/',
        ];

        $rulesForOrder_id = [
            "details.*.order_id"=>'required|exists:orders,id',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            return helperJson(null,$validator->errors());
        }
        $data = $request->except('details');
        $data['added_by_id'] = auth()->user()->id;

        ///// store
         if ($newOrder = Order::create($data)){
             $validatorDorOrderId = Validator::make($request->all(),$rulesForOrder_id);
             if ($validatorDorOrderId->fails()){
                 Order::destroy($request->id);
                 return helperJson(null,'the order id in details is invalid',490);
             }
         }

        //// store order details
//        foreach ($request->details as $detail){
//            if ($detail['order_id'] != $request->id){
//                Order::destroy($request->id);
//                return helperJson(null,'the order id in details is invalid',490);
//            }
//            $newDetail = new OrderDetails();
//            $newDetail->product_id = $newOrder->product_id;
//            $newDetail->price = $detail->price;
//            $newDetail->qty = $detail->qty;
//            $newDetail->order_id = $detail->order_id;
//            $newDetail->total = $detail->total;
//            $newDetail->save();
//        }
        for($i = 0 ; $i < count($request->details) ; $i++){
            if ($request->details[$i]['order_id'] != $request->id){
                Order::destroy($request->id);
                return helperJson(null,'the order id in details is invalid',490);
            }
            $OrderDetails                = new OrderDetails();
            $OrderDetails->order_id      = $newOrder->id;
            $OrderDetails->product_id    = $request->details[$i]['product_id'];
            $OrderDetails->price          = $request->details[$i]['price'];
            $OrderDetails->qty           = $request->details[$i]['qty'];
            $OrderDetails->total = $request->details[$i]['total'];
            $OrderDetails->save();
        }

        $data = Order::with('details.product')->findOrFail($request->id);

        return helperJson($data);

    }//end fun
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function backOrder(Request $request){
        $rules = [
            "id"=>'required|exists:orders,id',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            return helperJson(null,$validator->errors());
        }
        $data = $request->only('id');
        $find = Order::where($data)->firstOrFail();

        if ($find->added_by_id != auth()->user()->id){
            return helperJson(null,'that order is invalid',380);
        }

        $data['is_back'] = true;
        $find->update($data);


        $data = Order::with('details.product')->findOrFail($request->id);
        return helperJson($data);

    }//end fun

}//end class
