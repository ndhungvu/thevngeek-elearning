@extends('layouts.admin-login')

@section('content')
<div class="login-box">
  	<div class="login-box-body">
    	<p class="login-box-msg">ĐĂNG NHẬP</p>
    	@include('layouts.partials.admin.message')
	    {{ Form::open(['method' => 'POST', 'id' => 'frmLogin']) }}
	      	<div class="form-group has-feedback">
	      		{{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
	      		@if ($errors->has('email'))
                <span class="help-block mgs-error">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	      	</div>
	      	<div class="form-group has-feedback">
	        	{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
	        	@if ($errors->has('password'))
                <span class="help-block mgs-error">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
	        	<span class="glyphicon glyphicon-lock form-control-feedback"></span>
	      	</div>
	      	<div class="row ">
	        	<div class="col-xs-8">
	          		<div class="checkbox icheck">
		            	<label>{{ Form::checkbox('remember', '1') }} Ghi nhớ</label>
	          		</div>
	        	</div>
		        <div class="col-xs-4">
		        	{{ Form::submit('ĐĂNG NHẬP',['class' => 'btn btn-primary btn-block btn-flat']) }}
		        </div>
	      	</div>
	   	{{ Form::close() }}
	   	<a href="#">Quên mật khẩu?</a><br>
 	</div>
</div>
{{ Html::script('assets/admin/js/validate/login.js', ['type' => 'text/javascript']) }}
@endsection