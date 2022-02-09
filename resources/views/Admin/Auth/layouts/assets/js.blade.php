<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{url('assets/admin/auth/js/plugins.bundle.js')}}"></script>
<script src="{{url('assets/admin/auth/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{url('assets/admin/auth/js/general.js')}}"></script>
<!--end::Page Custom Javascript-->

<!----- start js custom ------->
<script>
    $(document).ready(function (){
        $('.lds-hourglass').fadeOut(1000)
    })
</script>
