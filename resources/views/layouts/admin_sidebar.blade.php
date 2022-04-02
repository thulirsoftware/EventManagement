<style>
    .nav-sidebar .nav-item > .nav-link {
  color: black;
  padding: 6px;
}
 .nav-sidebar .nav-item > a {
  color: black;
  padding: 6px;
}
[class*="sidebar-dark-"] .nav-sidebar > .nav-item.menu-open > .nav-link, [class*="sidebar-dark-"] .nav-sidebar > .nav-item:hover > .nav-link, [class*="sidebar-dark-"] .nav-sidebar > .nav-item > .nav-link:focus {
  background-color: rgba(255,255,255,.1);
  color: black;
}
.info {
  color: black;
  font-weight: bold;
  }
  [class*="sidebar-dark-"] .nav-treeview > .nav-item > .nav-link {
  color: #101010;
}
[class*="sidebar-dark-"] .nav-treeview > .nav-item :hover {
  color: #101010;
}
.image-cirlce {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 40%;
}
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:#f5f5fc">


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
       <br>
                 <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                   <div class="image">
          <img src="http://netamilsangam.org/assets/img/nets-logo.png" class="img-circle center image-cirlce" alt="User Image">
        </div>
     <?php
     use Illuminate\Support\Str;
      $path = Request::path();
     ?>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column"   data-widget="tree" >
         @if(Auth::user()->job_title=='SAdmin')
             <li class="nav-item">
                <a href="{{ url('/admin/manageAdmin') }}" class="nav-link {{ Str::contains($path, ['manageAdmin','addAdmin','adminEdit']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-cog"></i>
                <p> Manage Admin</p>
                </a>
            </li>
            @endif
           
            
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
                <a href="{{ route('admin.location.list') }}" class="nav-link {{ Str::contains($path, ['Location','location']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-map-marker"></i>
                <p>Manage Location</p>
                </a>
            </li>
            @endif
           
             @if(Auth::user()->job_title=='SAdmin' || Auth::user()->job_title=='Admin')
             <li class="nav-item">
                <a href="{{ route('admin.entry.list') }}" class="nav-link {{ Str::contains($path, ['entry','Entry']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-ticket-alt"></i>
                <p>Manage Entry</p>
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
              @if(Auth::user()->job_title=='SAdmin' || Auth::user()->job_title=='Admin')
             <li class="nav-item">
                <a href="{{ route('admin.food.list') }}" class="nav-link {{ Str::contains($path, ['food','Food']) ? 'active' : '' }}">
                <i class="nav-icon fas fas fa-bacon"></i>
                <p>Manage Food</p>
                </a>
            </li>
            @endif
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
                <a href="{{ url('/admin/Payments') }}" class="nav-link {{ Str::contains($path, ['Payments','UpdatePayment','PaymentEdit']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>Manage Payments</p>
                </a>
            </li>
            @endif
             @if(Auth::user()->job_title=='SAdmin' || Auth::user()->job_title=='Admin')
             <li class="nav-item">
                <a href="{{ route('admin.sponsorship.list') }}" class="nav-link {{ Str::contains($path, ['sponsorship']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar-plus"></i>
                <p> Manage Sponsorship</p>
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
             <li class="nav-item">
                <a href="{{ url('/admin/memberDetails') }}" class="nav-link {{ Str::contains($path, ['memberDetails']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>Update Member Package</p>
                </a>
            </li>
             <li class="nav-item">
                <a href="{{ route('admin.campaign.list') }}" class="nav-link {{ Str::contains($path, ['campaign']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>Manage Campaign</p>
                </a>
            </li>
         @endif
       
        
         @if(Auth::user()->job_title=='SAdmin' || Auth::user()->job_title=='Admin')
             <li  class="nav-item treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Reports&nbsp;&nbsp;
                <i class="fas fa-angle-down"></i>
              </p>
            </a>
            <ul class="nav nav-treeview "  data-widget="treeview" style="padding-left:20px">
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
              <li class="nav-item">
                <a href="{{ url('/admin/EntryTicketsReport') }}" class="nav-link {{ Str::contains($path, ['EntryTicketsReport']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-ticket-alt"></i>
                <p> Entry Tickets</p>
                </a>
            </li>
               <li class="nav-item">
                <a href="{{ url('/admin/FoodTicketsReport') }}" class="nav-link {{ Str::contains($path, ['FoodTicketsReport']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-ticket-alt"></i>
                <p> Food Tickets</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/CompetitionReport') }}" class="nav-link {{ Str::contains($path, ['CompetitionReport']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-ticket-alt"></i>
                <p> Competition Reports</p>
                </a>
            </li>
              <li class="nav-item">
                <a href="{{ url('/admin/VolunteerReports') }}" class="nav-link {{ Str::contains($path, ['VolunteerReports']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-handshake"></i>
                <p>Volunteer</p>
                </a>
            </li>
              <li class="nav-item">
                <a href="{{ url('/admin/sponsors') }}" class="nav-link {{ Str::contains($path, ['sponsors']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-ticket-alt"></i>
                <p> Sponsors</p>
                </a>
            </li>
             <li class="nav-item">
                <a href="{{ url('/admin/donations') }}" class="nav-link {{ Str::contains($path, ['donations']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-ticket-alt"></i>
                <p> Donations</p>
                </a>
            </li>
           
           
          
           
         
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
