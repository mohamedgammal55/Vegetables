<?php

namespace App\Http\Controllers\Admin\CRUD;

use App\Http\Controllers\Controller;
use App\Http\Traits\DefaultImage;
use App\Http\Traits\UploadFiles;
use App\Models\Admin;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class AdminsController extends Controller
{
    use UploadFiles;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $admins = Admin::latest()->get();
            return Datatables::of($admins)
//                ->editColumn('photo', function ($admin) {
//                    return '<img style="width: 50px;height: 50px" onclick="window.open(this.src)" src="'.get_file($admin->photo).'">';
//                })
                ->addColumn('action', function ($admin) {
                    if (\admin()->user()->id == $admin->id || $admin->id == 1)
                    return '
                            <button id="editBtn" class="btn btn-icon btn-bg-light btn-primary btn-sm me-1" style="border-radius: 50% !important"
                                    data-id="' . $admin->id . '"
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-edit"></i>
                                </span>
                            </span>
                            </button>

                       ';
                    else
                        return '
                            <button id="editBtn" class="btn btn-icon btn-bg-light btn-primary btn-sm me-1" style="border-radius: 50% !important"
                                    data-id="' . $admin->id . '"
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-edit"></i>
                                </span>
                            </span>
                            </button>
                            <button class="btn btn-icon btn-bg-light btn-danger btn-sm me-1 delete" style="border-radius: 50% !important"
                                    data-id="' . $admin->id . '">
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </span>
                            </button>
                       ';
                })->escapeColumns([])
                ->make(true);
        }//end if
        return view('Admin.CRUD.Admins.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.CRUD.Admins.parts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_name'=>'required|unique:admins,user_name',
            'name'=>'required',
            'password'=>'required|min:6|max:20',
        ]);

        $data = $request->all();

        $data['password'] = Hash::make($request->password);
        $data['photo'] = $this->storeDefaultImage('admins',$request->name);
        Admin::create($data);

        return response()->json(['message'=>'تم الحفظ بنجاح','code'=>200],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $find = Admin::findOrFail($id);

        return view('Admin.CRUD.Admins.parts.edit',compact('find'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_name'=>"required|unique:admins,user_name,$id",
            'name'=>'required',
            'password'=>'nullable|min:6|max:20',
        ]);

        $data = $request->all();

        if ($request->has('password'))
        $data['password'] = Hash::make($request->password);

        delete_file(Admin::findOrFail($id)->photo);

        $data['photo'] = $this->storeDefaultImage('admins',$request->name);
        Admin::findOrFail($id)->update($data);

        return response()->json(['message'=>'تم التعديل بنجاح','code'=>200],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        delete_file(Admin::findOrFail($id)->photo);
        Admin::destroy($id);
        return response()->json(['message'=>'تم الحذف بنجاح','code'=>200],200);
    }
}
