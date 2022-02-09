<title>تسجيل الدخول | {{$setting->title??''}}</title>
<meta charset="utf-8" />
<link rel="shortcut icon" href="{{get_file($setting->logo)}}" />
<!--begin::Fonts-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
<!--end::Fonts-->
<!--begin::Global Stylesheets Bundle(used by all pages)-->
<link href="{{url('assets/admin/auth/css/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('assets/admin/auth/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
<!--end::Global Stylesheets Bundle-->
<!--Begin::Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&amp;l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-5FS8GGP');</script>
<!--End::Google Tag Manager -->
{{--include loader css--}}
@include('layouts.loader.loaderCss')
{{-- end include loader css--}}
