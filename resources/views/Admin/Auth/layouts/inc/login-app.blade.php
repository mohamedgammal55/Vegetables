<!DOCTYPE html>
<html lang="en" dir="rtl" direction="rtl" style="direction:rtl;">
<!--begin::Head-->
<head>
    {{-- include css --}}
    @include('Admin.Auth.layouts.assets.css')
    {{-- end include css --}}
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="{{date('A') == 'AM'?'bg-body':'bg-dark'}}">
{{--include loader--}}
@include('layouts.loader.loader')
{{-- end include loader--}}
<!--Begin::Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!--End::Google Tag Manager (noscript) -->
<!--begin::Main-->
<!--begin::content-->
@yield('content')
<!--end::content-->
<!--end::Main-->
<!--end::Javascript-->
{{-- include js --}}
@include('Admin.Auth.layouts.assets.js')
{{-- end include js --}}

<!--begin::js-->
@yield('js')
<!--end::js-->
</body>
<!--end::Body-->
</html>
