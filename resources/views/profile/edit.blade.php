<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Profile - Prep</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen">
    <!-- Floating decorations -->
    <div class="floating-decoration-1"></div>
    <div class="floating-decoration-2"></div>
    <div class="floating-decoration-3"></div>
    <div class="floating-decoration-4"></div>
    <div class="floating-decoration-5"></div>
    <div class="floating-decoration-6"></div>
    
    <!-- Header -->
    <header class="text-white py-8 relative z-10" style="background: linear-gradient(135deg, #4CAF50 0%, #66BB6A 100%);">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center">
                <h1 class="text-4xl font-bold">Prep</h1>
                
                <a href="/home" class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8 relative z-10 max-w-4xl">
        <!-- Page Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-prep-text-dark mb-2">Edit Profile</h2>
            <p class="text-prep-text-light">Manage your account settings</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-2xl mb-6 flex items-center">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid md:grid-cols-3 gap-6">
            <!-- Sidebar Profile Card -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-prep-border-light">
                    <!-- Profile Avatar -->
                    <div class="text-center mb-6">
                        <div class="w-32 h-32 rounded-full bg-gradient-to-br from-prep-green to-prep-green-medium flex items-center justify-center text-white text-5xl font-bold border-4 border-prep-green shadow-lg mx-auto">
                            {{ strtoupper(substr($user->username, 0, 1)) }}
                        </div>
                        
                        <h2 class="text-xl font-bold text-prep-text-dark mt-4">{{ $user->username }}</h2>
                        <p class="text-prep-text-muted text-sm">{{ $user->email }}</p>
                    </div>

                    <!-- Quick Stats -->
                    <div class="space-y-3 pt-4 border-t border-prep-border-light">
                        <div class="flex justify-between items-center">
                            <span class="text-prep-text-muted text-sm">Favorite Recipes</span>
                            <span class="font-bold text-prep-green">{{ $user->favoriteRecipes->count() }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-prep-text-muted text-sm">Member Since</span>
                            <span class="font-bold text-prep-text-dark">{{ \Carbon\Carbon::parse($user->created_date)->format('M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="md:col-span-2 space-y-6">
                <!-- Username Form -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-prep-border-light">
                    <h3 class="text-xl font-semibold text-prep-text-dark mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-prep-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Profile Information
                    </h3>

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Username -->
                        <div class="mb-6">
                            <label for="username" class="block text-sm font-medium text-prep-text-dark mb-2">Username</label>
                            <input type="text" 
                                   name="username" 
                                   id="username" 
                                   value="{{ old('username', $user->username) }}"
                                   class="w-full px-4 py-3 border border-prep-border-light rounded-xl focus:ring-2 focus:ring-prep-green focus:border-transparent transition"
                                   required>
                            @error('username')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-xs text-prep-text-muted">This is your display name on the platform</p>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="btn-prep-green text-white px-8 py-3 rounded-full font-semibold hover:shadow-lg transition">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Change Password Form -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-prep-border-light">
                    <h3 class="text-xl font-semibold text-prep-text-dark mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-prep-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        Change Password
                    </h3>

                    <form action="{{ route('profile.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Current Password -->
                        <div class="mb-4">
                            <label for="current_password" class="block text-sm font-medium text-prep-text-dark mb-2">Current Password</label>
                            <input type="password" 
                                   name="current_password" 
                                   id="current_password"
                                   class="w-full px-4 py-3 border border-prep-border-light rounded-xl focus:ring-2 focus:ring-prep-green focus:border-transparent transition"
                                   required>
                            @error('current_password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-prep-text-dark mb-2">New Password</label>
                            <input type="password" 
                                   name="password" 
                                   id="password"
                                   class="w-full px-4 py-3 border border-prep-border-light rounded-xl focus:ring-2 focus:ring-prep-green focus:border-transparent transition"
                                   required>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-xs text-prep-text-muted">Must be at least 8 characters long</p>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-6">
                            <label for="password_confirmation" class="block text-sm font-medium text-prep-text-dark mb-2">Confirm New Password</label>
                            <input type="password" 
                                   name="password_confirmation" 
                                   id="password_confirmation"
                                   class="w-full px-4 py-3 border border-prep-border-light rounded-xl focus:ring-2 focus:ring-prep-green focus:border-transparent transition"
                                   required>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="btn-prep-green text-white px-8 py-3 rounded-full font-semibold hover:shadow-lg transition">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Back to Home Button -->
        <div class="mt-8 text-center">
            <a href="/home" class="inline-flex items-center text-prep-green hover:text-prep-green-dark font-semibold transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Home
            </a>
        </div>
    </main>
</body>
</html>