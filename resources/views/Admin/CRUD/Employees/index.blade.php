@extends('Admin.layouts.inc.app')
@section('style')

    {{--<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">--}}
    {{--<link href="{{url('assets/datatables/datatables.bundle..css')}}">--}}
    <style>
        ul.pagination {
            justify-content: left;
        }
    </style>
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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">الموظفين

                    <!--end::Description--></h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center py-1">

                <!--begin::Button-->
                <button class="btn btn-sm btn-primary"
                        id="addBtn">إضافة جديد
                </button>
                <!--end::Button-->
            </div>
            <!--end::Actions-->
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
                                <span class="card-label fw-bolder fs-3 mb-1">الموظفين</span>
                            </h3>

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-3">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table id="table"
                                       class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                    <!--begin::Table head-->
                                    <thead>
                                    <tr class="fw-bolder text-muted">
                                        <th class="min-w-150px">الإسم</th>
                                        <th class="min-w-140px">اسم المستخدم</th>
                                        <th class="min-w-100px">تحكم</th>
                                    </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <tbody>

                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
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


    <div class="modal fade" id="Modal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content" id="modalContent">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2>الموظفين</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                      fill="black"/>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"/>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7" id="form-load">

                </div>
                <!--end::Modal body-->
                <div class="modal-footer">
                    <div class="text-center">
                        <button type="reset"  data-bs-dismiss="modal" class="btn btn-light me-3">غلق</button>
                        <button form="form" type="submit" id="submit" class="btn btn-primary">
                            <span class="indicator-label">حفظ</span>
                        </button>
                    </div>
                </div>
            </div>

            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>


@endsection
@section('js')
    <script src="{{url('assets/datatables/datatables.bundle.js')}}"></script>

    <script>
        var loader = ` <div class="linear-background">
                            <div class="inter-crop"></div>
                            <div class="inter-right--top"></div>
                            <div class="inter-right--bottom"></div>
                        </div>
        `;
        $(function () {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('employees.index') !!}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'user_name', name: 'user_name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],

                "language": {
                    "sProcessing": "جاري التحميل ..",
                    "sLengthMenu": "اظهار _MENU_ سجل",
                    "sZeroRecords": "لا يوجد نتائج",
                    "sInfo": "اظهار _START_ الى  _END_ من _TOTAL_ سجل",
                    "sInfoEmpty": "لا نتائج",
                    "sInfoFiltered": "للبحث",
                    "sSearch": "بحث :    ",
                    "oPaginate": {
                        "sPrevious": "السابق",
                        "sNext": "التالي",
                    }
                },

                dom: 'frtip',
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });
        });
        //======================== addBtn =============================
        $(document).on('click', '#addBtn', function () {
            $('#form-load').html(loader)
            $('#Modal').modal('show')

            setTimeout(function (){
                $('#form-load').load("{{route('employees.create')}}")
            },1000)


        });
    // =========================== edit btn

    $(document).on('click', '.editBtn', function () {
        var  id = $(this).data('id');
            $('#form-load').html(loader)
            $('#Modal').modal('show')

        var url = "{{route('employees.edit',':id')}}";
        url = url.replace(':id',id)

            setTimeout(function (){
                $('#form-load').load(url)
            },1000)


        });

    // =========================== edit btn

    $(document).on('click', '.showBtn', function () {
        var  id = $(this).data('id');
            $('#form-load').html(loader)
            $('#Modal').modal('show')

        var url = "{{route('employees.show',':id')}}";
        url = url.replace(':id',id)

            setTimeout(function (){
                $('#form-load').load(url)
            },1000)


        });


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


                    $('#submit').html('<span class="spinner-border spinner-border-sm mr-2" ' +
                        ' ></span> <span style="margin-left: 4px;">جاري الحفظ</span>').attr('disabled', true);
                    $('#form-load').append(loader)
                    $('#form').hide()
                },
                complete: function () {
                },
                success: function (data) {

                    window.setTimeout(function () {
                        $('#submit').html('حفظ').attr('disabled', false);

                        // $('#product-model').modal('hide')
                        if (data.code == 200) {
                            toastr.success(data.message)
                            $('#Modal').modal('hide')
                            $('#table').DataTable().ajax.reload();
                        }else {
                            $('#form-load > .linear-background').hide(loader)
                            $('#form').show()
                            toastr.error(data.message)
                        }
                    }, 1000);



                },
                error: function (data) {
                    $('#form-load > .linear-background').hide(loader)
                    $('#submit').html('حفظ').attr('disabled', false);
                    $('#form').show()
                    console.log(data)
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

                },//end error method

                cache: false,
                contentType: false,
                processData: false
            });
        });


    //============================ delete ====================
        $(document).on('click', '.delete', function () {

            var id = $(this).data('id');
            swal.fire({
                title: "هل أنت متأكد من الحذف؟",
                text: "لا يمكنك التراجع بعد ذلك؟",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "موافق",
                cancelButtonText: "الغاء",
                okButtonText: "موافق",
                closeOnConfirm: false
            }).then((result) => {


                var url = '{{ route("employees.destroy",":id") }}';
                url = url.replace(':id',id)
                console.log(url);
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    beforeSend: function(){
                        $('.loader-ajax').show()

                    },
                    success: function (data) {
                        toastr.success(data.message)

                        window.setTimeout(function() {
                            $('.loader-ajax').hide()
                            if (data.code == 200){
                                toastr.success(data.message)
                                $('#table').DataTable().ajax.reload();
                            }else {
                                toastr.error("هناك خطأ")
                            }

                        }, 1000);
                    }, error: function (data) {

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
                    }

                });
            });
        });


    </script>
@endsection
