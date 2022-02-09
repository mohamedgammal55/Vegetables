<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{url('assets/admin/js/plugins.bundle.js')}}"></script>
<script src="{{url('assets/admin/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->



<!----- start js custom ------->
<script>
    $(document).ready(function (){
        $('.lds-hourglass').fadeOut(1000)
    })
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
