<?php
namespace App\Http\Controllers\Api\Home;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResources;
use App\Http\Resources\CustomersResources;
use App\Http\Resources\ProductResources;
use App\Http\Traits\UploadFiles;
use App\Models\Category;
use App\Models\Customers;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller{

    use UploadFiles;
    /////////////////////////// products ////////////////////////
    public function products(Request $request){

         $request->validate([
            'category_id'=>'nullable|exists:categories,id',
            'title'=>'nullable',
        ]);
         $query = $request->only('category_id');

        $data = Product::where($query)
            ->where('title_ar','LIKE','%'.$request->title.'%')
            ->orwhere('title_en','LIKE','%'.$request->title.'%')
            ->latest()->get();
        return helperJson(ProductResources::collection($data));
    }//end fun
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function setting(request $request){
        $data = Setting::select('vat','logo','name_ar','name_en')->first();
        return helperJson($data);
    }
    public function addProduct(Request $request){
        $rules = [
            'category_id'=>'required|exists:categories,id',
            'title_ar'=>'required|unique:products,title_ar',
            'title_en'=>'required|unique:products,title_en',
            'photo'=>'required|image:mimes:*',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            return helperJson(null,$validator->errors());
        }
        $data = $validator->validated();

        $data['photo'] = $this->uploadFiles('products',$request->file('photo'));

        $data['added_by_id'] = auth()->user()->id;

        $store = Product::create($data);
        return helperJson(new ProductResources($store));
    }//end fun

    ///////////////////////////////// customers ////////////////////////////////////
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function customers(Request $request){

        $data = Customers::query();

        if ($request->has('name')){
            $data->where('name','LIKE','%'.$request->name.'%');
        }

        if ($request->has('phone')){
            $data->where('phone','LIKE','%'.$request->phone.'%');
        }

        return helperJson(CustomersResources::collection($data->get()));
    }//end fun
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCustomer(Request $request){
      $data =  $request->validate([
            'name'=>'required|unique:customers,name',
            'phone'=>'required|unique:customers,phone',
        ]);

        $data['added_by_id'] = auth()->user()->id;

        $store = Customers::create($data);
        return helperJson(new CustomersResources($store));
    }//end fun
    ///////////////////////// categories ////////////////////////
    public function categories(Request $request){

        $data = Category::query();


        return helperJson(CategoryResources::collection($data->get()));
    }//end fun

}//end class
