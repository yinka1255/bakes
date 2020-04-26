<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />

	<link rel="icon" href="{{('public/admin/images/favicon.ico')}}">

	<title>Sellr | Forgot password</title>

	<link rel="stylesheet" href="{{('public/admin/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css')}}">
	<link rel="stylesheet" href="{{('public/admin/css/font-icons/entypo/css/entypo.css')}}">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="{{('public/admin/css/bootstrap.css')}}">
	<link rel="stylesheet" href="{{('public/admin/css/neon-core.css')}}">
	<link rel="stylesheet" href="{{('public/admin/css/neon-theme.css')}}">
	<link rel="stylesheet" href="{{('public/admin/css/neon-forms.css')}}">
	<link rel="stylesheet" href="{{('public/admin/css/custom.css')}}">

	<script src="{{('public/admin/js/jquery-1.11.3.min.js')}}"></script>

	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>
<body class="page-body login-page login-form-fall" data-url="http://neon.dev">


<!-- This is needed when you send requests via Ajax -->
<script type="text/javascript">
var baseurl = '';
</script>

<div class="login-container">
	
	<div class="login-header login-caret">
		
		<div class="login-content">
			
			<a href="{{url('/')}}" class="logo">
				<img src="{{asset('public/admin/images/logo.jpg')}}" width="80" alt="" />
			</a>
			
			<p class="description">Dear user, kindly input your email!</p>
			
			<!-- progress bar indicator -->
			<div class="login-progressbar-indicator">
				<h3>43%</h3>
				<span>logging in...</span>
			</div>
		</div>
		
	</div>
	
	<div class="login-progressbar">
		<div></div>
	</div>
	
	<div class="login-form">
		
		<div class="login-content">
			
			<div class="form-login-error">
				<h3>Invalid login</h3>
				<p>Enter <strong>demo</strong>/<strong>demo</strong> as login and password.</p>
			</div>
			
			<form method="post" role="form" action="{{url('forgot_password_post')}}">
					{{ csrf_field() }}
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
						<input type="email" class="form-control" name="email" id="username" placeholder="Email" autocomplete="off" />
					</div>
				</div>
				
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block btn-login ">
						<i class="entypo-login"></i>
						Reset password
					</button>
				</div>
				<!-- Implemented in v1.1.4 -->
				<div class="form-group">
					<em>- or -</em>
				</div>
				<a href="{{url('login')}}" class="link">
					<i class="entypo-lock"></i>
					Return to Login Page
				</a>
				
			</form>
			<div class="login-bottom-links">
				<a href="{{url('forgot-password')}}" class="link">Forgot your password?</a>
				<br />
				<a href="#">ToS</a>  - <a href="#">Privacy Policy</a>
			</div>
		</div>
	</div>
</div>


	@if(Session::has('success'))
	<script type="text/javascript">
		jQuery(document).ready(function($)
		{
			// Sample Toastr Notification
			setTimeout(function()
			{
				var opts = {
					"closeButton": true,
					"debug": false,
					"positionClass": rtl() || public_vars.$pageContainer.hasClass('right-sidebar') ? "toast-top-left" : "toast-top-right",
					"toastClass": "black",
					"onclick": null,
					"showDuration": "3000",
					"hideDuration": "1000",
					"timeOut": "5000",
					"extendedTimeOut": "1000",
					"showEasing": "swing",
					"hideEasing": "linear",
					"showMethod": "fadeIn",
					"hideMethod": "fadeOut"
				};
		
				toastr.success("{{Session::get('success')}}", opts);
			}, 10);
		});
	</script>
	@endif

	@if(Session::has('error'))
	<script type="text/javascript">
		jQuery(document).ready(function($)
		{
			// Sample Toastr Notification
			setTimeout(function()
			{
				var opts = {
					"closeButton": true,
					"debug": false,
					"positionClass": rtl() || public_vars.$pageContainer.hasClass('right-sidebar') ? "toast-top-left" : "toast-top-right",
					"toastClass": "black",
					"onclick": null,
					"showDuration": "3000",
					"hideDuration": "1000",
					"timeOut": "0",
					"extendedTimeOut": "0",
					"showEasing": "swing",
					"hideEasing": "linear",
					"showMethod": "fadeIn",
					"hideMethod": "fadeOut"
				};
		
				toastr.error("{{Session::get('error')}}", opts);
			}, 10);
		});
	</script>
	@endif
	<!-- Bottom scripts (common) -->
	<script src="{{('public/admin/js/gsap/TweenMax.min.js')}}"></script>
	<script src="{{('public/admin/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js')}}"></script>
	<script src="{{('public/admin/js/bootstrap.js')}}"></script>
	<script src="{{('public/admin/js/joinable.js')}}"></script>
	<script src="{{('public/admin/js/resizeable.js')}}"></script>
	<script src="{{('public/admin/js/neon-api.js')}}"></script>
	<script src="{{('public/admin/js/jquery.validate.min.js')}}"></script>
	<script src="{{('public/admin/js/neon-login.js')}}"></script>
	<script src="{{asset('public/admin/js/toastr.js')}}"></script>

	<!-- JavaScripts initializations and stuff -->
	<script src="{{('public/admin/js/neon-custom.js')}}"></script>


	<!-- Demo Settings -->
	<script src="{{('public/admin/js/neon-demo.js')}}"></script>

</body>
</html>