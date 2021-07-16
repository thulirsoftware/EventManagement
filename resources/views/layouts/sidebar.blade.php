

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="https://www.thulirsoft.com/assets/img/thulir-logo-1.png" class="brand-image img-circle elevation-7"
           style="opacity: .8">
      <span class="brand-text font-weight-light"></span>
    </a>
    
<br>

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
               with font-awesome or any other icon font library -->
           <?php
           $this_year =  Carbon\Carbon::now()->format('Y');
            $Member = App\Member::where('user_id',Auth::user()->id)->where('membershipExpiryDate','>=',$this_year)->first();
       ?>
        @if($Member==null)
         
          <li class="nav-item">
                <a href="{{ url('MemberShip') }}" class="nav-link {{ Str::contains($path, ['MemberShip']) ? 'active' : '' }}">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>MemberShip</p>
                </a>
            </li>
          @endif
            
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
