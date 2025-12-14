<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Verify Your Email - Prep</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex items-center justify-center min-h-screen p-5 relative bg-gradient-to-br from(gray-50) to(gray-100)">
	<!-- Floating decorations -->
	<div class="floating-decoration-1"></div>
	<div class="floating-decoration-2"></div>
	<div class="floating-decoration-3"></div>
	<div class="floating-decoration-4"></div>
	<div class="floating-decoration-5"></div>
	<div class="floating-decoration-6"></div>
    
	<div class="bg-white rounded-3xl shadow-xl w-full max-w-2xl relative z-10 overflow-hidden p-12 md:p-16">
		<!-- Header with logo -->
		<div class="text-center mb-8">
			<div class="inline-flex items-center justify-center w-14 h-14 bg-prep-green/10 rounded-full mb-4">
				<svg class="w-7 h-7 text-prep-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
				</svg>
			</div>
			<h1 class="text-3xl font-bold text-prep-text-dark mb-1">Email Verification Required</h1>
			<p class="text-prep-text-light">Thanks for signing up! Please verify your email to continue.</p>
		</div>

		<div class="mb-6">
			<div class="bg-prep-bg-light rounded-2xl p-6 border border-prep-border-light">
				<p class="text-sm text-prep-text-light">
					We've sent a verification link to <span class="font-medium text-prep-green">{{ auth()->user()->email }}</span>.
					Click the link in the email to verify your account and access all features.
				</p>
			</div>
		</div>

		@if (session('message'))
			<div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl mb-6 flex items-start gap-3">
				<svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
					<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
				</svg>
				<div>
					<p class="font-medium">{{ session('message') }}</p>
				</div>
			</div>
		@endif

		<form method="POST" action="{{ route('verification.send') }}" class="mb-6">
			@csrf
			<button type="submit" 
				class="w-full btn-prep-green text-white py-3 px-4 rounded-full transition-all font-semibold text-base hover:shadow-lg transform hover:-translate-y-0.5">
				<svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
				</svg>
				Resend Verification Email
			</button>
		</form>

		<div class="text-center">
			<form method="POST" action="{{ route('logout') }}">
				@csrf
				<button type="submit" class="px-4 py-2 border-2 border-prep-border-light text-prep-text-dark rounded-full font-semibold hover:bg-prep-bg-light transition-all">
					Log Out
				</button>
			</form>
		</div>

		<div class="mt-8 pt-8 border-t border-prep-border-light text-center">
			<p class="text-xs text-prep-text-muted">
				Having trouble? <a href="mailto:support@prep.com" class="text-prep-green hover:text-prep-green-dark font-medium">Contact support</a>
			</p>
		</div>
	</div>
</body>
</html>
