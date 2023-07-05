<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <a href="#" class="d-block">{{ Auth::user()->name }}</a>
    </div>
  </div>

  <!-- SidebarSearch Form -->
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
      <li class="nav-item ">
        <a href="{{ route('super_admin_dashboard') }}" class="nav-link {{ request()->segment(2) == 'dashboard' ? 'active' : '' }}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>
      <li class="nav-header">User Management</li>
      <li class="nav-item ">
        <a href="{{ route('backend_all_users') }}" class="nav-link {{ request()->segment(2) == 'users' || request()->segment(2) == 'create-user' || request()->segment(2) == 'edit-user' ? 'active' : '' }}">
          <i class="nav-icon fas fa-users"></i>
          <p>
            Users
          </p>
        </a>
      </li>
      <li class="nav-header">Chef Management</li>
      <li class="nav-item ">
        <a href="{{ route('backend_all_chefs') }}" class="nav-link {{ request()->segment(2) == 'chefs' || request()->segment(2) == 'create-chef' || request()->segment(2) == 'edit-chef' ? 'active' : '' }}">
          <i class="nav-icon fas fa-glass-cheers"></i>
          <p>
            Chefs
          </p>
        </a>
      </li>
      <li class="nav-header">Recipes Management</li>
      <li class="nav-item {{ request()->segment(2) == 'pre-built-recipes' || request()->segment(2) == 'create-pre-built-recipes' || request()->segment(2) == 'edit-pre-built-recipes' || request()->segment(2) == 'dish-parameters' || request()->segment(2) == 'create-dish-parameter' || request()->segment(2) == 'edit-dish-parameter' || request()->segment(2) == 'trending-recipes' || request()->segment(2) == 'create-trending-recipes' || request()->segment(2) == 'edit-trending-recipes' || request()->segment(2) == 'fitness-parameters' || request()->segment(2) == 'create-fitness-parameter' || request()->segment(2) == 'edit-fitness-parameter' ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ request()->segment(2) == 'pre-built-recipes' || request()->segment(2) == 'create-pre-built-recipes' || request()->segment(2) == 'edit-pre-built-recipes' || request()->segment(2) == 'dish-parameters' || request()->segment(2) == 'create-dish-parameter' || request()->segment(2) == 'edit-dish-parameter' || request()->segment(2) == 'trending-recipes' || request()->segment(2) == 'create-trending-recipes' || request()->segment(2) == 'edit-trending-recipes' || request()->segment(2) == 'fitness-parameters' || request()->segment(2) == 'create-fitness-parameter' || request()->segment(2) == 'edit-fitness-parameter' ? 'active' : '' }}">
          <i class="nav-icon fas fa-cookie-bite"></i>
          <p>
            Recipes Management
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('backend_all_pre_built_recipes') }}" class="nav-link {{ request()->segment(2) == 'pre-built-recipes' || request()->segment(2) == 'create-pre-built-recipes' || request()->segment(2) == 'edit-pre-built-recipes' ? 'active' : '' }}">
              <i class="nav-icon fas fa-cookie"></i>
              <p>Pre-Built Recipes</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('backend_all_trending_recipes') }}" class="nav-link {{ request()->segment(2) == 'trending-recipes' || request()->segment(2) == 'create-trending-recipes' || request()->segment(2) == 'edit-trending-recipes' ? 'active' : '' }}">
              <i class="nav-icon fas fa-blender"></i>
              <p>Trending Recipes</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('backend_all_dish_parameters') }}" class="nav-link {{ request()->segment(2) == 'dish-parameters' || request()->segment(2) == 'create-dish-parameter' || request()->segment(2) == 'edit-dish-parameter' ? 'active' : '' }}">
              <i class="nav-icon fas fa-utensils"></i>
              <p>Dish Parameters</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('backend_all_fitness_parameters') }}" class="nav-link {{ request()->segment(2) == 'fitness-parameters' || request()->segment(2) == 'create-fitness-parameter' || request()->segment(2) == 'edit-fitness-parameter' ? 'active' : '' }}">
              <i class="nav-icon fas fa-heartbeat"></i>
              <p>Fitness Parameters</p>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>