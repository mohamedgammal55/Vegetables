<?php

namespace App\Http\Controllers\Admin\CRUD;

use App\Http\Controllers\Controller;
use App\Http\Traits\DefaultImage;
use App\Models\Admin;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class AdminEmployeesController extends Controller
{
    use DefaultImage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            $employees = User::latest()->get();
            return Datatables::of($employees)
                ->addColumn('action', function ($employee) {


                        return '
                            <button  class="btn showBtn btn-icon btn-bg-light btn-success btn-sm me-1" style="border-radius: 50% !important"
                                    data-id="' . $employee->id . '"
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </span>
                            </button>
                             <button id="editBtn" class="btn editBtn btn-icon btn-bg-light btn-primary btn-sm me-1" style="border-radius: 50% !important"
                                    data-id="' . $employee->id . '"
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-edit"></i>
                                </span>
                            </span>
                            </button>
                            <button class="btn btn-icon btn-bg-light btn-danger btn-sm me-1 delete" style="border-radius: 50% !important"
                                    data-id="' . $employee->id . '">
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </span>
                            </button>
                       ';
                })
                ->make(true);
        }//end if
        return view('Admin.CRUD.Employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.CRUD.Employees.parts.create');
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
            'user_name'=>'required|unique:users,user_name',
            'name'=>'required',
            'password'=>'required|min:6|max:20',
        ]);

        $data = $request->all();

        $data['password'] = Hash::make($request->password);
        $data['photo'] = $this->storeDefaultImage('admins',$request->name);
        User::create($data);

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
        $user = User::findOrFail($id);
        $permissions = Permission::all();

        return view('Admin.CRUD.Employees.parts.show',compact('user','permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('Admin.CRUD.Employees.parts.edit',compact('user'));
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
        $data =$request->validate([
            'user_name'=>"required|unique:users,user_name,$id",
            'name'=>'required',
            'password'=>'nullable|min:6|max:20',
        ]);


        if ($request->has('password'))
            $data['password'] = Hash::make($request->password);

         delete_file(User::findOrFail($id)->photo);

        $data['photo'] = $this->storeDefaultImage('employees',$request->name);

        User::findOrFail($id)->update($data);

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
        delete_file(User::findOrFail($id)->photo);
        User::destroy($id);
        return response()->json(['message'=>'تم الحذف بنجاح','code'=>200],200);
    }

    public function employeeUpdatePermission(Request $request,$id){
        $data =$request->validate([
            'permissions'=>"nullable|array",
            'permissions.*.'=>'exists:permissions,name',
        ]);

        $user = User::findOrFail($id);

        $names = $user->getPermissionNames();
        foreach ($names as $name)
        $user->revokePermissionTo($name);


        $user->givePermissionTo($request->permissions);

        return response()->json(['message'=>'تم الحفظ بنجاح','code'=>200],200);
    }

}//end class
