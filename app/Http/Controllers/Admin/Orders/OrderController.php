<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::with('employee')
                ->where('is_back',false)->latest()->get();
            return Datatables::of($orders)
                ->editColumn('added_by_id',function ($order){
                    return $order->employee->name??'';
                })
                ->editColumn('order_date_time',function ($order){
                    return date('Y-m-d H:i A',$order->order_date_time/1000);
                })

                ->editColumn('is_back',function ($order){
                    return $order->is_back ?'تم الإرجاع':'لم يتم الإرجاع';
                })
                ->addColumn('action', function ($order) {
                    return '
                            <button  class="btn showBtn btn-icon btn-bg-light btn-success btn-sm me-1" style="border-radius: 50% !important"
                                    data-id="' . $order->id . '"
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </span>
                            </button>
                            <button class="btn btn-icon btn-bg-light btn-danger btn-sm me-1 delete" style="border-radius: 50% !important"
                                    data-id="' . $order->id . '">
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </span>
                            </button>
                       ';
                })
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('Admin.orders.parts.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['message'=>'تم الحذف بنجاح','code'=>200],200);

    }
}
