
@section('title', 'Login')
@include('main')
 <nav class="navbar navbar-expand-md fixed-top" style="background-color: white;box-shadow: 0 0 1px rgba(0,0,0,.125),0 1px 3px rgba(0,0,0,.2);height:65px">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><img src="../../assets/img/thulir-logo-1.png"></a>
    </div>
    <ul class="nav navbar-nav navbar-right">

   

    </ul>
  </div>
</nav> <br>
      <body style="background-color:#f4f6f9">
<!-- Main Content -->
  <div class="container-fluid">
    <div class="main-content bg-success text-center">
      <div class="col-md-4 text-center company__info">
          <h4 class="company_title">தமிழ் சங்கம்</h4>
        <span class="company__logo"><h2><img src="../../assets/img/thiruvalluvar.webp" width="120px" height="120px"></h2></span>
        
      </div>
      <div class="col-md-8 col-xs-12 col-sm-12 login_form ">
        <div class="container-fluid"><br>
          <div class="row">
            <h4>ADMIN LOGIN</h4>
          </div>
           @if(isset(Auth::user()->email))
                          <script>window.location="/main/dashboard"</script>
                        @endif
                         @if($message = Session::get('error'))
                          <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>{{ $message }}</strong>
                          </div>  
                        @endif    
            @if (count($errors)>0)
              <div class="alert alert-danger">
                <ul>
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach 
                </ul>
              </div>
            @endif  
            @if(Session::has('success'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
{{Session::get('success')}}
</div>
@endif
          <div class="row">
           <form id="form-validation" name="form-validation" method="POST" action="{{ route('admin.login.submit') }}">
               @csrf
              <div class="row">
               <input id="validation-email"
                                       class="form__input"
                                       placeholder="Email"
                                       name="email"
                                       type="email"
                                      required>
              </div>
              <div class="row">
                                 <input id="validation-password"
                                       class="form__input password"
                                       name="password"
                                       type="password"
                                       placeholder="Password"
                                       required>
                                        <span toggle="#validation-password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
              <div class="row">
                <input type="submit" value="Submit" class="btn btn-back">
              </div><br>
            </form>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
   <script>
    $(".toggle-password").click(function() {
console.log("click");
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>
<!-- START: page scripts -->
<script>
    $(function() {

        // Form Validation
        $('#form-validation').validate({
            submit: {
                settings: {
                    errorListClass: 'form__input-error',
                    errorClass: 'has-danger'
                }
            }
        });

        // Show/Hide Password
        $('.password').password({
            eyeClass: '',
            eyeOpenClass: 'icmn-eye',
            eyeCloseClass: 'icmn-eye-blocked'
        });

        // Change BG
        var min = 1, max = 5,
            next = Math.floor(Math.random()*max) + min,
            final = next > max ? min : next;
        $('.random-bg-image').data('img', final);
    
    });
</script>
<!-- END: page scripts -->
</body>