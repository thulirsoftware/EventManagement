<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <center>
      <img src="https://www.thulirsoft.com/assets/img/thulir-logo-1.png" class="img-circle elevation-7"
           ></center>
      <span class="brand-text font-weight-light"></span>
    </a>
    


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
     
     <?php
     use Illuminate\Support\Str;
      $path = Request::path();
     ?>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library 
          
             <li class="nav-item">
                <a href="{{ url('/admin/manageAdmin') }}" class="nav-link {{ Str::contains($path, ['manageAdmin','addAdmin','adminEdit']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-cog"></i>
                <p> Manage Admin</p>
                </a>
            </li>-->
           
            
             <!---@if(Auth::user()->job_title=='SAdmin' || Auth::user()->job_title=='Admin')
            <li class="nav-item">
                <a href="{{ url('/admin/member_details') }}" class="nav-link  {{  Str::contains($path, ['member_details']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-search"></i>
                <p> Member Search</p>
                </a>
            </li>
            @endif--->
           @if(Auth::user()->job_title=='SAdmin' || Auth::user()->job_title=='Admin')
             <li class="nav-item">
                <a href="{{ url('/admin/manageEvent') }}" class="nav-link {{ Str::contains($path, ['manageEvent','event','editEventTicket','editEventEntryTicket','addEvent']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar-plus"></i>
                <p> Manage Events</p>
                </a>
            </li>
            @endif
             @if(Auth::user()->job_title=='SAdmin' || Auth::user()->job_title=='Admin')
            <li class="nav-item">
                <a href="{{ url('/admin/Membership/List') }}" class="nav-link {{ Str::contains($path, ['Membership']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>Manage Membership</p>
                </a>
            </li>
         @endif
           @if(Auth::user()->job_title=='SAdmin' || Auth::user()->job_title=='Admin')
            <li class="nav-item">
                <a href="{{ route('admin.competition.list') }}" class="nav-link {{ Str::contains($path, ['Competition']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>Manage Competition</p>
                </a>
            </li>
         @endif
           @if(Auth::user()->job_title=='SAdmin')
             <li class="nav-item">
                <a href="{{ route('admin.location.list') }}" class="nav-link {{ Str::contains($path, ['Location','location']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-map-marker"></i>
                <p>Manage Location</p>
                </a>
            </li>
            @endif
             @if(Auth::user()->job_title=='SAdmin')
             <li class="nav-item">
                <a href="{{ route('admin.food.list') }}" class="nav-link {{ Str::contains($path, ['food','Food']) ? 'active' : '' }}">
                <i class="nav-icon fas fas fa-bacon"></i>
                <p>Manage Food</p>
                </a>
            </li>
            @endif
             @if(Auth::user()->job_title=='SAdmin')
             <li class="nav-item">
                <a href="{{ route('admin.entry.list') }}" class="nav-link {{ Str::contains($path, ['entry','Entry']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-ticket-alt"></i>
                <p>Manage Entry</p>
                </a>
            </li>
            @endif
          @if(Auth::user()->job_title=='SAdmin')
             <li class="nav-item">
                <a href="{{ url('/admin/Payments') }}" class="nav-link {{ Str::contains($path, ['Payments','UpdatePayment','PaymentEdit']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>Manage Payments</p>
                </a>
            </li>
            @endif
         @if(Auth::user()->job_title=='SAdmin' || Auth::user()->job_title=='Admin')
         <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Reports&nbsp;&nbsp;
                <i class="fas fa-angle-down"></i>
              </p>
            </a>
            <ul class="nav nav-treeview " style="padding-left:20px">
               <li class="nav-item">
                <a href="{{ url('/admin/FoodTicketsReport') }}" class="nav-link {{ Str::contains($path, ['FoodTicketsReport']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-ticket-alt"></i>
                <p> Food Tickets</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/EntryTicketsReport') }}" class="nav-link {{ Str::contains($path, ['EntryTicketsReport']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-ticket-alt"></i>
                <p> Entry Tickets</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/VolunteerReports') }}" class="nav-link {{ Str::contains($path, ['VolunteerReports']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-handshake"></i>
                <p>Volunteer</p>
                </a>
            </li>
             @if(Auth::user()->job_title=='SAdmin' || Auth::user()->job_title=='Admin' || Auth::user()->job_title=='SchoolAdmin' )
            <li class="nav-item">
                <a href="{{ url('/admin/memberDetails') }}" class="nav-link {{ Str::contains($path, ['memberDetails', 'editMember','viewFamilyMember']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p> Members</p>
                </a>
            </li>
             @endif
             @if(Auth::user()->job_title=='SAdmin' || Auth::user()->job_title=='Admin' || Auth::user()->job_title=='SchoolAdmin' )
            <li class="nav-item">
                <a href="{{ url('/admin/nonMemberDetails') }}" class="nav-link {{ Str::contains($path, ['nonMemberDetails']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p> Non Members</p>
                </a>
            </li>
             @endif
          </ul>
        </li>
                 @endif

             <li class="nav-item">
                <a class="nav-link" role="button" 
                href="{{ route('admin.logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
                </a>
            </li>
             <form id="logout-form" action="{{ route('admin.logout') }}" method="get" class="d-none">
            @csrf
        </form>
           
            

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
