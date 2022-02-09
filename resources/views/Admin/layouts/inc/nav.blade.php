<!--begin::Navbar-->
<div class="d-flex align-items-stretch" id="kt_header_nav">
    <!--begin::Menu wrapper-->
    <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
        <!--begin::Menu-->
        <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
            <div class="menu-item me-lg-1">
                <a class="menu-link {{checkActive('admin.index')}} py-3" href="{{route('admin.index')}}">
                    <span class="menu-title">الرئيسية</span>
                </a>
            </div>
            <div class="menu-item me-lg-1">
                <a class="menu-link {{checkActive('employees.index')}} py-3" href="{{route('employees.index')}}">
                    <span class="menu-title">الموظفين</span>
                </a>
            </div>
            <div class="menu-item me-lg-1">
                <a class="menu-link {{checkActive('categories.index')}} py-3" href="{{route('categories.index')}}">
                    <span class="menu-title">الفئات</span>
                </a>
            </div>
            <div class="menu-item me-lg-1">
                <a class="menu-link {{checkActive('admins.index')}} py-3" href="{{route('admins.index')}}">
                    <span class="menu-title">المشرفين</span>
                </a>
            </div>
            <div class="menu-item me-lg-1">
                <a class="menu-link {{checkActive('products.index')}} py-3" href="{{route('products.index')}}">
                    <span class="menu-title">المنتجات</span>
                </a>
            </div>
            <div class="menu-item me-lg-1">
                <a class="menu-link {{checkActive('settings.index')}} py-3" href="{{route('settings.index')}}">
                    <span class="menu-title">الإعدادات</span>
                </a>
            </div>
        </div>
        <!--end::Menu-->
    </div>
    <!--end::Menu wrapper-->
</div>
<!--end::Navbar-->
