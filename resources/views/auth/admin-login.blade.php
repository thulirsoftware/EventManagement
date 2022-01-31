
@section('title', 'Login')
@include('main')
<section class="wrapper">
      <div class="container py-14 py-md-16">
        <div class="row gx-lg-8 gx-xl-12">
           <div class="col-lg-2">
           </div>
          <div class="col-lg-8">
            <div class="blog classic-view">
              <article class="post">
                <div class="card">
                     <div class="card-header">
                        Admin Login
                     </div>
                <div class="card-body">
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
              <div class="row pb-4">
               <input id="validation-email"
                                       class="form-control"
                                       placeholder="Email"
                                       name="email"
                                       type="email"
                                      required>
              </div>
              <div class="row pb-4">
                                 <input id="validation-password"
                                       class="form-control password"
                                       name="password"
                                       type="password"
                                       placeholder="Password"
                                       required>
                                        <span toggle="#validation-password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
             <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                              
                            </div>
                        </div>
            </form>
          </div>
          
        </div>
      </div>
      </article>
    </div>
  </div>
   </div>
  </div>
  </section>
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