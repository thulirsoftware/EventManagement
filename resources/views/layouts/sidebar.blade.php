<style>
    .nav-sidebar .nav-item > .nav-link {
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
  text-align: center;
}
</style>
<?php
     
      use Illuminate\Support\Str;
      $path = Request::path();
       $member = App\Member::where('user_id',Auth::user()->id)->first();
       if($member==null)
       {
         $member = App\NonMember::where('user_id',Auth::user()->id)->first();
       }
     ?>
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:#f5f5fc">
    <!-- Brand Logo -->


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <br>
                 <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

        <div class="image">
          <img src="{{ URL::to('/') }}/profiles/{{$member->profile}}" class="img-circle center" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{$member->firstName}}<br>
          {{Auth::user()->Member_Id}}</p>
        </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column"   data-widget="tree" role="menu" data-accordion="true">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           <?php
           $this_year =  Carbon\Carbon::now()->format('Y-m-d');
            $Member = App\Member::where('user_id',Auth::user()->id)->where('membershipExpiryDate','>=',$this_year)->first();
       ?>
          <li class="nav-item">
                <a href="{{ url('MemberShip') }}" class="nav-link {{ Str::contains($path, ['MemberShip']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>Membership</p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ url('memberTickets') }}" class="nav-link {{ Str::contains($path, ['memberTickets','memberBuyTicket']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar"></i>
                <p>Events</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('MyEvents') }}" class="nav-link {{ Str::contains($path, ['MyEvents','ViewEvent']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar-plus"></i>
                <p>My events</p>
                </a>
            </li>
              <li class="nav-item">
                <a href="{{ url('donations') }}" class="nav-link {{ Str::contains($path, ['donations']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>Donations</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ url('sponsors') }}" class="nav-link {{ Str::contains($path, ['sponsors']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-donate"></i>
                <p>Sponsors</p>
                </a>
            </li>
         
            <?php
                $member = App\Member::where('user_id',Auth::user()->id)->first();
            ?>
            @if($member!=null)
            <li class="nav-item">
                <a href="{{ url('editProfile') }}" class="nav-link {{ Str::contains($path, ['editProfile']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>My profile</p>
                </a>
            </li>
            @else
                <li class="nav-item">
                <a href="{{ url('editProfile') }}" class="nav-link {{ Str::contains($path, ['editProfile']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>My profile</p>
                </a>
            </li>
            @endif
              <li class="nav-item">
                <a href="{{ url('ChangePassword') }}" class="nav-link {{ Str::contains($path, ['ChangePassword']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-key"></i>
                <p>Change password</p>
                </a>
            </li>

           
            
                <li class="nav-item">
                <a href="{{ url('familyMembers') }}" class="nav-link {{ Str::contains($path, ['familyMembers']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p> Family members</p>
                </a>
            </li> 
            <li class="nav-item">
                <a href="{{ url('AddVolunteer') }}" class="nav-link {{ Str::contains($path, ['AddVolunteer','AddAsVolunteer']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-handshake"></i>
                <p> Enroll as volunteer</p>
                </a>
            </li>         
             <li class="nav-item">
                <a class="nav-link" role="button" 
                href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
                </a>
            </li>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
           
            

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Header (Page header) -->
 