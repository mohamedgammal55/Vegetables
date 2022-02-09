<!--begin::Form-->
<form id="form" enctype="multipart/form-data" method="POST" action="{{route('products.update',$product->id)}}">
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
        <input type="text" class="form-control form-control-solid" placeholder="عربي" name="title_ar" value="{{$product->title_ar}}" />
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
        <input type="text" class="form-control form-control-solid" placeholder="إنجليزي" name="title_en" value="{{$product->title_en}}" />
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="d-flex flex-column mb-7 fv-row">
        <!--begin::Label-->
        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
            <span class="required">الفئة</span>
            <i class="fa fa-exclamation-circle ms-2 fs-7" title="الفئة"></i>
        </label>
        <!--end::Label-->
        <select name="category_id" class="form-control">
            <option value="">أختر الفئة</option>
            {!! myForEach($categories,'id','title_ar',$product->category_id) !!}
        </select>
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="d-flex flex-column mb-7 fv-row">
        <!--begin::Label-->
        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
            <span class="required">الصورة</span>
            <i class="fa fa-exclamation-circle ms-2 fs-7" title="الصورة"></i>
        </label>
        <!--end::Label-->
        <input type="file" name="photo" class="dropify" data-default-file="{{get_file($product->photo)}}" />
    </div>
    <!--end::Input group-->
</form>
<!--end::Form-->
<script>
    $('.dropify').dropify();

</script>
