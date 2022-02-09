<?php

namespace App\Http\Controllers\Admin\CRUD;

use App\Http\Controllers\Controller;
use App\Http\Traits\UploadFiles;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    use UploadFiles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::with('category')->latest()->get();
            return Datatables::of($products)
                ->editColumn('photo', function ($product) {
                    return '<img style="width: 70px;height: 70px" onclick="window.open(this.src)" src="' . get_file($product->photo) . '">';
                })

                ->addColumn('category', function ($product) {
                    return $product->category->title_ar??'' .' -- '. $product->category->title_en??'';
                })
                ->addColumn('action', function ($product) {
                    return '
                            <button id="editBtn" class="btn btn-icon btn-bg-light btn-primary btn-sm me-1" style="border-radius: 50% !important"
                                    data-id="' . $product->id . '"
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-edit"></i>
                                </span>
                            </span>
                            </button>
                            <button class="btn btn-icon btn-bg-light btn-danger btn-sm me-1 delete" style="border-radius: 50% !important"
                                    data-id="' . $product->id . '">
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </span>
                            </button>
                       ';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('Admin.CRUD.Products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('Admin.CRUD.Products.parts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title_ar'=>'required',
            'title_en'=>'nullable',
            'category_id'=>'required|exists:categories,id',
            'photo'=>'required|image:mimes:*',
        ]);


        if ($request->hasFile('photo')){
            $data['photo'] = $this->uploadFiles('products',$request->file('photo'));
        }
        Product::create($data);
        return response()->json(['message'=>'تم الحفظ بنجاح','code'=>200],200);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::latest()->get();
        return view('Admin.CRUD.Products.parts.edit',compact('categories','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title_ar'=>'required',
            'title_en'=>'nullable',
            'category_id'=>'required|exists:categories,id',
            'photo'=>'nullable|image:mimes:*',
        ]);


        if ($request->hasFile('photo')){
            $data['photo'] = $this->uploadFiles('products',$request->file('photo'),$product->photo);
        }
        $product->update($data);
        return response()->json(['message'=>'تم التعديل بنجاح','code'=>200],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        delete_file($product->photo);
        $product->delete();
        return response()->json(['message'=>'تم الحذف بنجاح','code'=>200],200);
    }
}
