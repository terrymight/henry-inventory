 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-indigo elevation-4">
   <!-- Brand Logo -->
   <a href="index3.html" class="brand-link">
     <img src="{{URL::asset('dist/img/AdminLTELogo.png')}}" class="brand-image img-circle elevation-3" style="opacity: .8" alt="AdminLTE Logo">
     <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
     <!-- Sidebar user panel (optional) -->
     <div class="user-panel mt-3 pb-3 mb-3 d-flex">
       <div class="image">
         <img src="{{URL::asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
       </div>
       <div class="info">
         <a href="#" class="d-block">{{ Auth::user()->name }}</a>
       </div>
     </div>

     <!-- SidebarSearch Form -->
     <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

     <!-- Sidebar Menu -->
     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               @if(Auth::user()->role_permission == 1)
         <li class="nav-item">
           <a href="{{ url('/dashboard') }}" class="nav-link">
             <i class="nav-icon fas fa-tachometer-alt"></i>
             <p>
               Dashboard
             </p>
           </a>
         </li>
         @endif
         <li class="nav-item">
           <a href="{{ url('/customers/list') }}" class="nav-link">
             <i class="nav-icon fas fa-store-alt"></i>
             <p>
               Customers List
             </p>
           </a>
         </li>
         

         @if(Auth::user()->role_permission == 1)
         <li class="nav-item menu-close">
           <a href="#" class="nav-link active">
             <i class="nav-icon fas fa-cogs"></i>
             <p>
               Administrator Control
               <i class="right fas fa-angle-left"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">

             <li class="nav-item">
               <a href="{{ url('state/list') }}" class="nav-link">
                 <i class="nav-icon fas fa-map-marked-alt"></i>
                 <p>
                   Manage System States
                 </p>
               </a>
             </li>

             <li class="nav-item">
               <a href="{{ url('users/list') }}" class="nav-link">
                 <i class="nav-icon fas fa-user-alt"></i>
                 <p>
                   Manage All Dispatcher
                 </p>
               </a>
             </li>

             <li class="nav-item">
               <a href="{{ url('staff/list') }}" class="nav-link">
                 <i class="nav-icon fas fa-user-cog"></i>
                 <p>
                   Manage All Staff
                 </p>
               </a>
             </li>

             <li class="nav-item">
               <a href="{{ url('products/list') }}" class="nav-link">
                 <i class="nav-icon fas fa-luggage-cart"></i>
                 <p>
                   Manage Products
                 </p>
               </a>
             </li>

             <li class="nav-item">
               <a href="{{ url('/sms-settings/') }}" class="nav-link">
                 <i class="fas fa-sms nav-icon"></i>
                 <p>SMS Config</p>
               </a>
             </li>

             <li class="nav-item">
               <a href="{{ url('application/list') }}" class="nav-link">
                 <i class="fas fas fa-cogs"></i>
                 <p>Application Config</p>
               </a>
             </li>

           </ul>
         </li>
         @endif
         <li class="nav-item">
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
             Log out
            </p>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </li>
         


       </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>