@extends('Admin.Auth.layouts.inc.login-app')
@section('content')
    @php
        $backGround = date('A') == 'AM'?get_file('assets/admin/auth/img/14.png'):get_file('assets/admin/auth/img/14-dark.png');
    @endphp
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-in -->
        <div
            class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
            style="background-image: url({{$backGround}})">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <!--begin::Logo-->
                <a href="" class="mb-12">
                    <img alt="Logo" src="{{get_file($setting->logo)}}" class="h-40px"/>
                </a>
                <!--end::Logo-->
                <!--begin::Wrapper-->
                <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->
                    <form class="form w-100" novalidate="novalidate" id="Form" action="{{route('admin.login.submit')}}"
                          enctype="multipart/form-data" method="POST">
                    @csrf
                    <!--begin::Heading-->
                        <div class="text-center mb-10">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">تسجيل الدخول | {{$setting->title}}</h1>
                            <!--end::Title-->
                        </div>
                        <!--begin::Heading-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="form-label fs-6 fw-bolder text-dark">اسم المستخدم</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-lg form-control-solid " id="email" type="text" name="user_name"
                                   autocomplete="on"/>
                            <!--end::Input-->
                            <!--begin::error-->
                            <div style="display: none" class="fv-plugins-message-container invalid-feedback"
                                 id="emailValidate">
                            </div>
                            <!--end::error-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack mb-2">
                                <!--begin::Label-->
                                <label class="form-label fw-bolder text-dark fs-6 mb-0">كلمة المرور</label>
                                <!--end::Label-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Input-->
                            <input class="form-control form-control-lg form-control-solid" id="password" type="password"
                                   name="password" autocomplete="off"/>
                            <!--end::Input-->
                            <!--begin::error-->
                            <div style="display: none" class="fv-plugins-message-container invalid-feedback"
                                 id="passwordValidate">
                            </div>
                            <!--end::error-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <!--begin::Submit button-->
                            <button type="submit" id="submit" class="btn btn-lg btn-primary w-100 mb-5">
                                <span class="indicator-label">تسجيل</span>
                            </button>
                            <!--end::Submit button-->
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Footer-->
                <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
                    <!--begin::Links-->
                    <div class="d-flex flex-center fw-bold fs-6">
                        <a href="https://rynprogramming.com" class="text-muted text-hover-primary px-2" target="_blank">RYN tech</a>
                    </div>
                    <!--end::Links-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Content-->

        </div>
        <!--end::Authentication - Sign-in-->
    </div>
@endsection
@section('js')
    <script>
        $("form#Form").submit(function (e) {
                e.preventDefault();
            var formData = new FormData(this);
            var url = $('#Form').attr('action');
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                beforeSend: function () {
                    $('.loader-ajax').show()
                    $('.form-control').removeClass('is-invalid')
                    $('.invalid-feedback').html('')
                    $('.invalid-feedback').hide()

                    $('#submit').html('<span class="spinner-border spinner-border-sm mr-2" ' +
                        ' ></span> <span style="margin-left: 4px;">جاري العمل</span>').attr('disabled', true);
                },
                complete: function () {
                    $('#submit').html('تسجيل').attr('disabled', false);

                },
                success: function (data) {

                    if (data.code == 200) {

                        window.setTimeout(function () {
                            $('.loader-ajax').hide()
                        }, 500);
                        window.setTimeout(function () {
                            toastr.success('تم تسجيل الدخول بنجاح')
                        }, 750);
                        window.setTimeout(function () {
                            window.location = "{{route('admin.index')}}"
                        }, 1000);

                    } else {
                        toastr.error(data.message)
                    }


                },
                error: function (data) {

                    window.setTimeout(function () {
                        $('.loader-ajax').hide()
                        if (data.status === 500) {
                            toastr.error('هناك خطأ ما')
                        } else if (data.status == 300) {
                            var loginErrors =$.parseJSON(data.responseText);
                            console.log(loginErrors.code)
                            if(loginErrors.code === 401){
                                $('#emailValidate').html(loginErrors.message)
                                $('#email').addClass('is-invalid')
                                $('#emailValidate').show()
                            }else if(loginErrors.code === 402){
                                $('#passwordValidate').html(loginErrors.message)
                                $('#password').addClass('is-invalid')
                                $('#passwordValidate').show()
                            }
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
                    }, 500);


                },//end error method

                cache: false,
                contentType: false,
                processData: false
            });
        });

    </script>
@endsection
