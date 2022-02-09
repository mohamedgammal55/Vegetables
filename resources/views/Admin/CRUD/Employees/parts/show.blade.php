<!--begin::Form-->
<form id="form" enctype="multipart/form-data" method="POST" action="{{route('employees.update-permission',$user->id)}}">
@csrf
    <div class="row">
        @foreach($permissions as $permission)
            <div class="form-check" style="margin: 5px;">
                <input class="form-check-input" name="permissions[]" type="checkbox" {{$user->can($permission->name)?'checked':''}} value="{{$permission->name}}" id="permission{{$permission->id}}">
                <label class="form-check-label" for="permission{{$permission->id}}">
                    {{$permission->title}}
                </label>
            </div>
        @endforeach
    </div>
</form>
<!--end::Form-->
