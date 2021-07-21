
<?php
     
      use Illuminate\Support\Str;
      $path = Request::path();
       $member = App\Member::where('user_id',Auth::user()->id)->first();
       if($member==null)
       {
         $member = App\NonMember::where('user_id',Auth::user()->id)->first();
       }
     ?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <br>
        <div class="image">
          <img src="{{ URL::to('/') }}/profiles/{{$member->profile}}" class="img-circle center" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{$member->firstName}}<br>
          {{$member->Member_Id}}</p>
        </div>
     <hr style="color:white">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           <?php
           $this_year =  Carbon\Carbon::now()->format('Y-m-d');
            $Member = App\Member::where('user_id',Auth::user()->id)->where('membershipExpiryDate','>=',$this_year)->first();
       ?>
         
          <li class="nav-item">
                <a href="{{ url('MemberShip') }}" class="nav-link {{ Str::contains($path, ['MemberShip']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>MemberShip</p>
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
                <p>My Events</p>
                </a>
            </li>
            <?php
                $member = App\Member::where('user_id',Auth::user()->id)->first();
            ?>
            @if($member!=null)
            <li class="nav-item">
                <a href="{{ url('editProfile') }}" class="nav-link {{ Str::contains($path, ['editProfile']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>My Profile</p>
                </a>
            </li>
            @else
                <li class="nav-item">
                <a href="{{ url('editProfile') }}" class="nav-link {{ Str::contains($path, ['editProfile']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>My Profile</p>
                </a>
            </li>
            @endif
              <li class="nav-item">
                <a href="{{ url('ChangePassword') }}" class="nav-link {{ Str::contains($path, ['ChangePassword']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-key"></i>
                <p>Change Password</p>
                </a>
            </li>

           
            
                <li class="nav-item">
                <a href="{{ url('familyMembers') }}" class="nav-link {{ Str::contains($path, ['familyMembers']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p> Family Members</p>
                </a>
            </li> 
            <li class="nav-item">
                <a href="{{ url('AddVolunteer') }}" class="nav-link {{ Str::contains($path, ['AddVolunteer']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-handshake"></i>
                <p> Enroll as Volunteer</p>
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
