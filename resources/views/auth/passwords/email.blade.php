
@section('title', 'Login')
@include('main')
 <nav class="navbar navbar-expand-md fixed-top" style="background-color: white;box-shadow: 0 0 1px rgba(0,0,0,.125),0 1px 3px rgba(0,0,0,.2);height:65px">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><img src="../../assets/img/thulir-logo-1.png"></a>
    </div>
    <ul class="nav navbar-nav navbar-right">

      <li><a href="{{route('login')}}"><span class="glyphicon glyphicon-log-in"></span> Sign In</a></li>
            <li><a href="{{route('register')}}" ><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>

    </ul>
  </div>
</nav> <br>
<body style="background-color:#f4f6f9">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    @if (Session::has('message'))

                         <div class="alert alert-success" role="alert">

                            {{ Session::get('message') }}

                        </div>

                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('forget.password.post') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
