@extends('Admin.layouts.inc.app')
@section('style')

    {{--<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">--}}
    {{--<link href="{{url('assets/datatables/datatables.bundle..css')}}">--}}
    <style>
        ul.pagination {
            justify-content: left;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{url('assets/admin/css/dropify.min.css')}}">
@endsection
@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                 data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">الإعدادات الرئيسية

                    <!--end::Description--></h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Row-->
            <div class="row gy-5 g-xl-8">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">الإعدادات الرئيسية</span>
                            </h3>

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-3">
                            <!--begin::Table container-->
                            <!--begin::Form-->
                            <form id="form" enctype="multipart/form-data" method="POST" action="{{route('settings.update',$setting->id)}}">
                            @csrf
                                @method('PUT')
                            <!--begin::Input group-->
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span class="required">العنوان</span>
                                        <i class="fa fa-exclamation-circle ms-2 fs-7" title="العنوان"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" class="form-control form-control-solid"  placeholder="العنوان" name="name_ar" value="{{$setting->name_ar}}" />
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span class="required">العنوان (إنجليزي)</span>
                                        <i class="fa fa-exclamation-circle ms-2 fs-7" title="إنجليزي"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" class="form-control form-control-solid"  placeholder="إنجليزي" name="name_en" value="{{$setting->name_en}}" />
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="d-flex flex-column mb-7 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                        <span class="required">اللوجو</span>
                                        <i class="fa fa-exclamation-circle ms-2 fs-7" title="اللوجو"></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="file" name="logo" class="dropify" data-default-file="{{get_file($setting->logo)}}" />
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="text-center col-sm-2">
                                    <!--begin::Submit button-->
                                    <button type="submit" id="submit" form="form" class="btn btn-lg btn-primary w-100 mb-5">
                                        <span class="indicator-label">حفظ</span>
                                    </button>
                                    <!--end::Submit button-->
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->

                            <!--end::Table container-->
                        </div>
                        <!--begin::Body-->
                    </div>
                </div>
                <!--end::Col-->

            </div>
            <!--end::Row-->

        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->




@endsection
@section('js')
    <script type="text/javascript" src="{{url('assets/admin/js/dropify.min.js')}}"></script>
    <script src="{{url('assets/datatables/datatables.bundle.js')}}"></script>

    <script>
        $('.dropify').dropify();


        //======================== store Data ==========================
        $(document).on('submit',"form#form",function (e) {
            e.preventDefault();

            var formData = new FormData(this);

            var url = $('#form').attr('action');
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                beforeSend: function () {
                    $('.loader-ajax').show()
                    $('#submit').html('<span class="spinner-border spinner-border-sm mr-2" ' +
                        ' ></span> <span style="margin-left: 4px;">جاري الحفظ</span>').attr('disabled', true);
                },
                complete: function () {
                },
                success: function (data) {

                    window.setTimeout(function () {
                        $('#submit').html('حفظ').attr('disabled', false);

                        // $('#product-model').modal('hide')
                        if (data.code == 200) {
                            toastr.success(data.message)
                        }else {
                            toastr.error(data.message)
                        }
                        $('.loader-ajax').hide()
                    }, 500);

                    window.setTimeout(function () {
                        if (data.code == 200) {
                            location.reload()
                        }
                        $('.loader-ajax').hide()
                    }, 700);



                },
                error: function (data) {
                  setTimeout(function (){
                      $('.loader-ajax').hide()

                      $('#submit').html('حفظ').attr('disabled', false);console.log(data)
                      if (data.status === 500) {
                          toastr.error('هناك خطأ ما')
                      }

                      if (data.status === 422) {
                          var errors = $.parseJSON(data.responseText);

                          $.each(errors, function (key, value) {
                              if ($.isPlainObject(value)) {
                                  $.each(value, function (key, value) {
                                      toastr.error(value)
                                  });

                              } else {

                              }
                          });
                      }
                      if (data.status == 421){
                          toastr.error(data.message)
                      }
                  },500)

                },//end error method

                cache: false,
                contentType: false,
                processData: false
            });
        });


    </script>
@endsection
