<ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item {{ request()->segment(2) == 'dashboard' ? 'active' : '' }}">
        <a href="{{ route('super_admin_dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Dashboards">Dashboards</div>
        </a>
    </li>

    <!-- Role Management -->
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Role Management</span>
    </li>
    <li class="menu-item {{ request()->segment(2) == 'roles-management' || request()->segment(2) == 'create-role' || request()->segment(2) == 'edit-role' ? 'active' : '' }}">
        <a href="{{ route('backend_roles') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-check-shield"></i>
            <div data-i18n="Roles Management">Roles Management</div>
        </a>
    </li>

    <!-- User Management -->
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">User Management</span>
    </li>
    <li class="menu-item {{ request()->segment(2) == 'users-management' || request()->segment(2) == 'create-user' || request()->segment(2) == 'edit-user' ? 'active' : '' }}">
        <a href="{{ route('backend_all_users') }}" class="menu-link">
            <i class="menu-icon fas fa-users"></i>
            <div data-i18n="User Management">User Management</div>
        </a>
    </li>
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Category Management</span>
    </li>
    <li class="menu-item {{ request()->segment(2) == 'main-categories' || request()->segment(2) == 'create-main-category' || request()->segment(2) == 'edit-main-category' ? 'active' : '' }}">
        <a href="{{ route('backend_all_main_categories') }}" class="menu-link">
            <i class="menu-icon fas fa-sitemap"></i>
            <div data-i18n="Main Categories">Main Categories</div>
        </a>
    </li>
    <li class="menu-item {{ request()->segment(2) == 'sub-categories' || request()->segment(2) == 'create-sub-category' || request()->segment(2) == 'edit-sub-category' ? 'active' : '' }}">
        <a href="{{ route('backend_all_sub_categories') }}" class="menu-link">
            <i class="menu-icon fas fa-th-large"></i>
            <div data-i18n="Sub Categories">Sub Categories</div>
        </a>
    </li>
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Preferances</span>
    </li>
</ul>