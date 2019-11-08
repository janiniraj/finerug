@extends('frontend.layouts.master')

@section('content')
 <header>
<div class="container" style="margin-top: 20px;">
    	<div class="row">
			<div class="col-md-8 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6" id="login_div">
								<a href="javascript:void(0);" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6" id="register_div">
								<a href="javascript:void(0);" id="register-form-link">Register</a>
							</div>
							<div class="col-xs-12" id="forgot_div" style="display: none;">
								<a href="#" id="forgot_link">Forgot Password</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								{{ Form::open(['route' => 'frontend.auth.login.post', 'class' => 'form-horizontal', 'id' => 'login-form', 'style' => 'display:block;']) }}
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" value="" required>
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login" id="login" tabindex="3" class="form-control btn btn-login" value="Login">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="javascript:void(0);" tabindex="4" class="forgot-password" id="forgot_password">Forgot Password?</a>
												</div>
											</div>
										</div>
									</div>
								{{ Form::close() }}
								{{ Form::open(['route' => 'frontend.auth.register.post-ajax', 'class' => 'form-horizontal', 'id' => 'register-form', 'style' => 'display:none;']) }}
									<div class="form-group">
										<input type="text" name="first_name" id="first_name" tabindex="1" class="form-control" placeholder="First Name" value="" required>
									</div>
									<div class="form-group">
										<input type="text" name="last_name" id="last_name" tabindex="1" class="form-control" placeholder="Last Name" value="" required>
									</div>
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="" required>
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
									</div>
									<div class="form-group">
										<input type="password" name="password_confirmation" id="password_confirmation" tabindex="2" class="form-control" placeholder="Confirm Password" required>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register" id="register" tabindex="4" class="form-control btn btn-register" value="Register Now">
											</div>
										</div>
									</div>
								{{ Form::close() }}
								{{ Form::open(['route' => 'frontend.auth.password.email.post', 'class' => 'form-horizontal', 'id' => 'forgot_password_form', 'style' => 'display:none;']) }}
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="" required>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login" id="login" tabindex="2" class="form-control btn btn-register" value="Submit">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="javascript:void(0);" tabindex="3" class="forgot-password" id="back_login">Back To Login</a>
												</div>
											</div>
										</div>
									</div>
								{{ Form::close() }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('after-scripts')
<script>
$(function() {

    $('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#forgot_password').click(function(e) {
 		$("#login-form").fadeOut(100);
 		$("#login_div").fadeOut(100);
 		$("#register_div").fadeOut(100);
 		$("#forgot_div").fadeIn(100);
 		$("#register-form").fadeOut(100);
 		$("#forgot_password_form").delay(100).fadeIn(100);
 		$('#login-form-link').removeClass('active');
 		$('#register-form-link').removeClass('active');
 		$('#forgot_link').addClass('active');
		e.preventDefault();
	});

	$('#back_login').click(function(e) {
 		$("#login-form").fadeIn(100);
 		$("#login_div").fadeIn(100);
 		$("#register_div").fadeIn(100);
 		$("#forgot_div").fadeOut(100);
 		$("#forgot_password_form").fadeOut(100);
 		$('#login-form-link').addClass('active');
 		$('#forgot_link').removeClass('active');
		e.preventDefault();
	});

});
</script>
@endsection