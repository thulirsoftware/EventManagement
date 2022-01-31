
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
                        Reset password
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
                    <form class="form-horizontal" method="POST" action="{{ route('reset.password.post') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-12 control-label">E-Mail Address</label>

                            <div class="col-md-10 pb-4">
                                <input id="email" type="email" class="form-control" name="email" value="{{  old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} pb-4">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-10 ">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} pb-4">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-10 ">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</article>
</div>
</div>
</div>
</div>
</section>

