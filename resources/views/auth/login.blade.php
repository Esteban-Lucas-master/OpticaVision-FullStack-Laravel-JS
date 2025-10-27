<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 p-4">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all duration-300 hover:shadow-2xl">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 text-center relative">
                    <div class="absolute inset-0 bg-black opacity-0 hover:opacity-5 transition-opacity duration-300"></div>
                    <div class="relative z-10">
                        <div class="mx-auto bg-white/20 backdrop-blur-sm rounded-full p-3 w-16 h-16 flex items-center justify-center mb-4">
                            <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h1 class="text-3xl font-bold text-white">Welcome Back</h1>
                        <p class="text-blue-200 mt-2">Sign in to continue to your account</p>
                    </div>
                </div>
                
                <div class="p-8">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-6" :status="session('status')" />
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="space-y-6">
                            <!-- Email Address -->
                            <div>
                                <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 font-medium mb-2" />
                                <div class="mt-1 relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 transition-colors duration-200 group-focus-within:text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                    </div>
                                    <x-text-input id="email" 
                                                class="block w-full pl-10 pr-3 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 shadow-sm hover:shadow-md" 
                                                type="email" 
                                                name="email" 
                                                :value="old('email')" 
                                                required 
                                                autofocus 
                                                autocomplete="username" 
                                                placeholder="your@email.com" />
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            
                            <!-- Password -->
                            <div>
                                <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium mb-2" />
                                <div class="mt-1 relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 transition-colors duration-200 group-focus-within:text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <x-text-input id="password" 
                                                class="block w-full pl-10 pr-3 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 shadow-sm hover:shadow-md" 
                                                type="password" 
                                                name="password" 
                                                required 
                                                autocomplete="current-password" 
                                                placeholder="••••••••" />
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            
                            <!-- Remember Me & Forgot Password -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input id="remember_me" type="checkbox" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded transition duration-200 cursor-pointer" name="remember">
                                    <label for="remember_me" class="ml-2 block text-sm text-gray-700 cursor-pointer">
                                        {{ __('Remember me') }}
                                    </label>
                                </div>
                                
                                @if (Route::has('password.request'))
                                    <a class="text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors duration-200" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>
                            
                            <!-- Login Button -->
                            <div>
                                <x-primary-button class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-sm text-base font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-0.5">
                                    {{ __('Sign In') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                    
                    <!-- Registration Link -->
                    <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                        <p class="text-sm text-gray-600">
                            Don't have an account?
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                    {{ __('Sign up') }}
                                </a>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 text-center">
                <p class="text-xs text-gray-500">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>