<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Prep</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex items-center justify-center min-h-screen p-5 relative">
    <!-- Floating decorations -->
    <div class="floating-decoration-1"></div>
    <div class="floating-decoration-2"></div>
    <div class="floating-decoration-3"></div>
    <div class="floating-decoration-4"></div>
    <div class="floating-decoration-5"></div>
    <div class="floating-decoration-6"></div>
    
    <div class="bg-white rounded-3xl shadow-xl w-full max-w-4xl relative z-10 overflow-hidden flex flex-col md:flex-row min-h-[600px]">
        <!-- left panel -->
        <div class="w-full md:w-2/5 bg-gradient-to-br from-prep-green to-prep-green-medium p-12 flex flex-col justify-center text-white relative">
            <div class="absolute top-8 left-8">
                <div class="text-3xl font-bold">Prep</div>
                <p class="text-white/80 text-sm mt-1">Cook smart with what you have</p>
            </div>
            
            <div class="mt-16">
                <h1 class="text-4xl font-bold mb-4">Create New Password</h1>
                <p class="text-white/90 mb-8 text-base">Enter your new password to regain access to your account</p>
            </div>
        </div>
        
        <!-- right panel -->
        <div class="w-full md:w-3/5 p-12 flex flex-col justify-center">
            <div class="max-w-md mx-auto w-full">
                <h2 class="text-3xl font-bold mb-8 text-prep-text-dark text-center">Reset Password</h2>
                
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ url('/reset-password') }}" class="space-y-5">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    
                    <div>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-prep-text-muted">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <input type="email" id="email" name="email" placeholder="Email" required 
                                class="w-full pl-12 pr-4 py-3 bg-prep-bg-light border border-prep-border-light rounded-xl focus:outline-none focus:ring-2 focus:ring-prep-green focus:border-transparent text-base transition-all"
                                value="{{ $email ?? old('email') }}" readonly>
                        </div>
                    </div>
                    
                    <div>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-prep-text-muted">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </span>
                            <input type="password" id="password" name="password" placeholder="New Password" required 
                                class="w-full pl-12 pr-4 py-3 bg-prep-bg-light border border-prep-border-light rounded-xl focus:outline-none focus:ring-2 focus:ring-prep-green focus:border-transparent text-base transition-all">
                        </div>
                        @error('password')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-prep-text-muted">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </span>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required 
                                class="w-full pl-12 pr-4 py-3 bg-prep-bg-light border border-prep-border-light rounded-xl focus:outline-none focus:ring-2 focus:ring-prep-green focus:border-transparent text-base transition-all">
                        </div>
                        @error('password_confirmation')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <button type="submit" 
                        class="w-full btn-prep-green text-white py-3 px-4 rounded-full transition-all font-semibold text-base hover:shadow-lg transform hover:-translate-y-0.5">
                        RESET PASSWORD
                    </button>
                </form>
                
                <p class="mt-6 text-center text-sm text-prep-text-light">
                    <a href="{{ url('/login') }}" class="text-prep-green hover:text-prep-green-dark font-medium">Back to login</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
