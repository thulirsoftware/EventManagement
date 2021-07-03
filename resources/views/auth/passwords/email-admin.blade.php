@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
         <div class="col-12">

          <div class="row">
            
          <div class="col-sm-4">
          </div>
          <div class="col-sm-4">
              <h2 class="title-head">Admin Reset Password</h2>
          </div>
          <div class="col-sm-4">
          </div>
          
      </div>
  </div><br>
      <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-8 ">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.password.email') }}">
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
</section>
</div>
@endsection
