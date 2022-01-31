
@section('title', 'Login')
@include('main')
<!-- Main Content -->
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
                        Member Login
                     </div>
                <div class="card-body">
                   @if(count($errors)>0)
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
@if (Session::has('message'))

                         <div class="alert alert-success" role="alert">

                            {{ Session::get('message') }}

                        </div>

                    @endif
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row pb-2">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"  name="email" class="form-control" required autocomplete="email" autofocus>

                              
                            </div>
                        </div>

                        <div class="form-group row pb-2">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">

                              
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('forget.password.get') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </article>
    </div>
</div>
<div class="col-lg-2">
           </div>
</div>
</div>
</section>
  
  <!-- Footer -->
