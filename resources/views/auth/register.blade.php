<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 p-4">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all duration-300 hover:shadow-2xl">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 text-center relative">
                    <div class="absolute inset-0 bg-black opacity-0 hover:opacity-5 transition-opacity duration-300"></div>
                    <div class="relative z-10">
                        <div class="mx-auto bg-white/20 backdrop-blur-sm rounded-full p-3 w-16 h-16 flex items-center justify-center mb-4">
                            <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <h1 class="text-3xl font-bold text-white">Create Account</h1>
                        <p class="text-blue-200 mt-2">Join us today to get started</p>
                    </div>
                </div>
                
                <div class="p-8">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-6">
                            <x-input-label for="name" :value="__('Full Name')" class="text-gray-700 font-medium mb-2" />
                            <div class="mt-1 relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 transition-colors duration-200 group-focus-within:text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <x-text-input id="name" 
                                            class="block w-full pl-10 pr-3 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 shadow-sm hover:shadow-md" 
                                            type="text" 
                                            name="name" 
                                            :value="old('name')" 
                                            required 
                                            autofocus 
                                            autocomplete="name" 
                                            placeholder="John Doe" />
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mb-6">
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
                                            autocomplete="username" 
                                            placeholder="your@email.com" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mb-6">
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
                                            autocomplete="new-password" 
                                            placeholder="••••••••" />
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-6">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 font-medium mb-2" />
                            <div class="mt-1 relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 transition-colors duration-200 group-focus-within:text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <x-text-input id="password_confirmation" 
                                            class="block w-full pl-10 pr-3 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 shadow-sm hover:shadow-md" 
                                            type="password" 
                                            name="password_confirmation" 
                                            required 
                                            autocomplete="new-password" 
                                            placeholder="••••••••" />
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-between mt-8">
                            <a class="text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors duration-200" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <x-primary-button class="flex justify-center py-4 px-6 border border-transparent rounded-xl shadow-sm text-base font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-0.5">
                                {{ __('Register') }}
                            </x-primary-button>
                        </div>
                    </form>
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