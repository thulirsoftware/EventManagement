  <nav class=" navbar navbar-expand-md navbar-light navbar-white" style="background-color:#8f3319;color:white">
    <div class="container">
      <a href="/" class="navbar-brand">
        
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
    
        </ul>
         <ul class="navbar-nav ml-auto">
         @if(Request::path() == 'register')
    
              <li class="nav-item">
                <a href="{{route('login')}}" class="nav-link" style="color:white">SignIn</a>
              </li>
          @elseif(Request::path() == 'register')
              <li class="nav-item">
                <a href="{{route('register')}}" class="nav-link" style="color:white">SignUp</a>
              </li>
          @endif
          
        
        </ul>

       
      </div>

      
    </div>
  </nav>
  <!-- /.navbar -->