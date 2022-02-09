<!--begin::Form-->
<form id="form" enctype="multipart/form-data" method="POST" action="{{route('admins.store')}}">
    @csrf
    <!--begin::Input group-->
    <div class="d-flex flex-column mb-7 fv-row">
        <!--begin::Label-->
        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
            <span class="required">الإسم</span>
            <i class="fa fa-exclamation-circle ms-2 fs-7" title="الإسم"></i>
        </label>
        <!--end::Label-->
        <input type="text" class="form-control form-control-solid" placeholder="الإسم" name="name" value="" />
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="d-flex flex-column mb-7 fv-row">
        <!--begin::Label-->
        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
            <span class="required">اسم المستخدم</span>
            <i class="fa fa-exclamation-circle ms-2 fs-7" title="اسم المستخدم"></i>
        </label>
        <!--end::Label-->
        <input type="text" class="form-control form-control-solid" placeholder="اسم المستخدم" name="user_name" value="" />
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="d-flex flex-column mb-7 fv-row">
        <!--begin::Label-->
        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
            <span class="required">كلمة المرور</span>
            <i class="fa fa-exclamation-circle ms-2 fs-7" title="كلمة المرور"></i>
        </label>
        <!--end::Label-->
        <input type="password" class="form-control form-control-solid" placeholder="كلمة المرور" name="password" value="" />
    </div>
    <!--end::Input group-->
</form>
<!--end::Form-->
