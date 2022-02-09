<!--begin::Form-->
<form id="form" enctype="multipart/form-data" method="POST" action="{{route('categories.update',$category->id)}}">
@csrf
    @method('PUT')
<!--begin::Input group-->
    <div class="d-flex flex-column mb-7 fv-row">
        <!--begin::Label-->
        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
            <span class="required">عربي</span>
            <i class="fa fa-exclamation-circle ms-2 fs-7" title="عربي"></i>
        </label>
        <!--end::Label-->
        <input type="text" class="form-control form-control-solid" placeholder="عربي" name="title_ar" value="{{$category->title_ar}}" />
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="d-flex flex-column mb-7 fv-row">
        <!--begin::Label-->
        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
            <span class="required">إنجليزي</span>
            <i class="fa fa-exclamation-circle ms-2 fs-7" title="إنجليزي"></i>
        </label>
        <!--end::Label-->
        <input type="text" class="form-control form-control-solid" placeholder="إنجليزي" name="title_en" value="{{$category->title_en}}" />
    </div>
    <!--end::Input group-->

</form>
<!--end::Form-->
