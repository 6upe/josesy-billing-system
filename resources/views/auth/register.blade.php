<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Josesy - Billing System</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Josesy Billing System">
    <meta name="author" content="Katongo Bupe">    
    <link rel="shortcut icon" href="{{ asset('assets/images/icon1.png') }}"> 
    
    <!-- FontAwesome JS-->
    <script defer src="{{ asset('assets/plugins/fontawesome/js/all.min.js') }}"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="{{ asset('assets/css/portal.css') }}">

</head> 

<body class="app app-login p-0">    	
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">	
				    <div class="app-auth-branding mb-4"><a class="app-logo" href="#"><img class="logo-icon me-2" src="{{ asset('assets/images/icon1.png') }}" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-5">Registration to Billing System</h2>
			        <div class="auth-form-container text-start">

					<div class="col-auto">
						@if (session('success'))
							<div class="alert alert-success">
								{{ session('success') }}
							</div>
						@endif
						@if (session('error'))
							<div class="alert alert-danger">
								{{ session('error') }}
							</div>
						@endif
						@if ($errors->any())
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
					</div>
						<form class="auth-form login-form"  method="POST" action="{{ route('auth.register') }}">
                        @csrf
                            <div class="email mb-3">
								<label class="sr-only" for="signin-email">Full Names</label>
								<input id="name" name="name" type="text" class="form-control signin-email" placeholder="Fullname" required="required">
							</div><!--//form-group-->   
							<div class="email mb-3">
								<label class="sr-only" for="signin-email">Position</label>
								<input id="position" name="position" type="text" class="form-control signin-email" placeholder="Position" required="required">
							</div><!--//form-group-->
							  
							<div class="email mb-3">
								<label class="sr-only" for="signin-email">Email</label>
								<input id="email" name="email" type="email" class="form-control signin-email" placeholder="Email address" required="required">
							</div><!--//form-group-->
							<div class="password mb-3">
								<label class="sr-only" for="signin-password">Password</label>
								<div class="input-group">
									<input id="password" name="password" type="password" class="form-control signin-password" placeholder="Password" required="required">
									<button class="btn btn-outline-secondary toggle-password" type="button" id="icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
											<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
											<path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
										</svg>
									</button>
								</div>
							</div><!--//form-group-->

							<div class="password mb-3">
								<label class="sr-only" for="signin-password">Confirm Password</label>
								<div class="input-group">
									<input id="password_confirmation" name="password_confirmation" type="password" class="form-control signin-password" placeholder="Confirm Password" required="required">
									<button class="btn btn-outline-secondary toggle-password" type="button" id="icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
											<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
											<path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
										</svg>
									</button>
								</div>
							</div><!--//form-group-->



							<div class="text-center">
								<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto" id="register-btn">Register</button>
								<div id="loading-spinner" class="text-center" style="display: none;">
									<div class="spinner-border text-light" role="status">
										<span class="sr-only">Loading...</span>
									</div>
								</div>
							</div>
						</form>
						
					</div><!--//auth-form-container-->	

			    </div><!--//auth-body-->
		    
			    
		    </div><!--//flex-column-->   
	    </div><!--//auth-main-col-->
	    <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
		    <div class="auth-background-holder">
		    </div>
		    <div class="auth-background-mask"></div>
		    <div class="auth-background-overlay p-3 p-lg-5">
			    <div class="d-flex flex-column align-content-end h-100">
				    <div class="h-100"></div>
				    <div class="overlay-content p-3 p-lg-4 rounded">
					    <h5 class="mb-3 overlay-title">Welcome to Josesy Billing System</h5>
						<a href="/auth/login">Login here</a>
				    </div>
				</div>
		    </div><!--//auth-background-overlay-->
	    </div><!--//auth-background-col-->
    
    </div><!--//row-->

	<script>
		document.addEventListener('DOMContentLoaded', function() {


			const form = document.querySelector('.auth-form');
			const loadingSpinner = document.getElementById('loading-spinner');
			const registerBtn = document.getElementById('register-btn');

			form.addEventListener('submit', function () {
				// Show the loading spinner
				loadingSpinner.style.display = 'block';
				registerBtn.style.display = 'none';
			});



			const togglePasswordButtons = document.querySelectorAll('.toggle-password');
			
			togglePasswordButtons.forEach(button => {
				button.addEventListener('click', function() {
					const passwordField = this.parentElement.querySelector('input');
					const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';

					console.log('Type: ', type);

					passwordField.setAttribute('type', type);

					// Toggle eye icon
					const eyeIcon = document.getElementById('icon');

					if (type === 'text') {
						console.log('Type: ', 'bi bi-eye-slash');
						eyeIcon.innerHTML = `
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
								<path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7 7 0 0 0 2.79-.588M5.21 3.088A7 7 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474z"/>
								<path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z"/>
							</svg>
						`;

					} else {
						console.log('Type: ', 'bi bi-eye-fill');

						eyeIcon.innerHTML = `
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
								<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
								<path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
							</svg>
						`;

					}
				});
			});
		});
	</script>



</body>
</html> 

