@extends('layouts.app')

@section('title', trans('auth/auth.reset_password'))

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <!-- Logo/Brand Section -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-success rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-success-content" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-base-content">{{ trans('auth/auth.new_password') ?? 'Set New Password' }}</h1>
            <p class="text-base-content/70 mt-2">{{ trans('auth/auth.new_password_subtitle') ?? 'Create a strong password for your account' }}</p>
        </div>

        <!-- Reset Password Card -->
        <div class="card bg-base-100 shadow-2xl border border-base-300">
            <div class="card-body p-8">
                
                <!-- Security Icon Illustration -->
                <div class="flex justify-center mb-6">
                    <div class="relative">
                        <div class="w-24 h-24 bg-base-200 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-success" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <!-- Check mark -->
                        <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-primary-content" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Instructions -->
                <div class="text-center mb-8">
                    <p class="text-base-content leading-relaxed">
                        {{ trans('auth/auth.password_reset_instructions') ?? 'Almost done! Create a strong password to secure your account.' }}
                    </p>
                </div>

                <!-- Reset Form -->
                <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Email Field (Read-only) -->
                    <div class="form-control">
                        <label for="email" class="label">
                            <span class="label-text font-medium">{{ trans('auth/auth.email_address') }}</span>
                        </label>
                        <div class="relative">
                            <input 
                                id="email" 
                                type="email" 
                                class="input input-bordered w-full pl-12 bg-base-200 @error('email') input-error @enderror"
                                name="email" 
                                value="{{ $email ?? old('email') }}" 
                                required 
                                autocomplete="email" 
                                readonly
                            >
                            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-base-content/50" 
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            <!-- Lock icon for readonly -->
                            <svg class="absolute right-4 top-1/2 transform -translate-y-1/2 w-4 h-4 text-base-content/30" 
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        @error('email')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- New Password Field -->
                    <div class="form-control">
                        <label for="password" class="label">
                            <span class="label-text font-medium">{{ trans('auth/auth.new_password') }}</span>
                        </label>
                        <div class="relative">
                            <input 
                                id="password" 
                                type="password" 
                                class="input input-bordered w-full pl-12 pr-12 @error('password') input-error @enderror"
                                name="password" 
                                required 
                                autocomplete="new-password"
                                placeholder="{{ trans('auth/auth.new_password_placeholder') }}"
                                autofocus
                            >
                            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-base-content/50" 
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                            <!-- Show/Hide Password Button -->
                            <button type="button" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-base-content/50 hover:text-base-content" onclick="togglePassword('password')">
                                <svg id="password-show" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                                <svg id="password-hide" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd"/>
                                    <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                        
                        <!-- Password Strength Indicator -->
                        <div id="password-strength" class="mt-2 hidden">
                            <div class="flex items-center space-x-2">
                                <div class="text-xs text-base-content/70">{{ trans('auth/auth.password_strength') ?? 'Strength:' }}</div>
                                <div class="flex space-x-1">
                                    <div id="strength-1" class="w-6 h-2 bg-base-300 rounded"></div>
                                    <div id="strength-2" class="w-6 h-2 bg-base-300 rounded"></div>
                                    <div id="strength-3" class="w-6 h-2 bg-base-300 rounded"></div>
                                    <div id="strength-4" class="w-6 h-2 bg-base-300 rounded"></div>
                                </div>
                                <span id="strength-text" class="text-xs font-medium"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="form-control">
                        <label for="password-confirm" class="label">
                            <span class="label-text font-medium">{{ trans('auth/auth.confirm_password') }}</span>
                        </label>
                        <div class="relative">
                            <input 
                                id="password-confirm" 
                                type="password" 
                                class="input input-bordered w-full pl-12 pr-12"
                                name="password_confirmation" 
                                required 
                                autocomplete="new-password"
                                placeholder="{{ trans('auth/auth.confirm_password_placeholder') }}"
                            >
                            <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-base-content/50" 
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <!-- Match indicator -->
                            <div id="password-match" class="absolute right-4 top-1/2 transform -translate-y-1/2 hidden">
                                <svg class="w-5 h-5 text-success" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <div id="password-match-text" class="label hidden">
                            <span class="label-text-alt text-success">{{ trans('auth/auth.passwords_match') ?? 'Passwords match' }}</span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-control mt-8">
                        <button type="submit" class="btn btn-success btn-lg w-full" id="reset-password-btn">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                            {{ trans('auth/auth.reset_password_button') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Password Requirements -->
        <div class="card bg-base-200/50 mt-6 border border-base-300">
            <div class="card-body p-6">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-info" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-medium text-base-content mb-2">
                            {{ trans('auth/auth.password_requirements') ?? 'Password Requirements' }}
                        </h3>
                        <ul class="text-sm text-base-content/70 space-y-1">
                            <li id="req-length" class="flex items-center">
                                <span class="w-4 h-4 mr-2">•</span>
                                {{ trans('auth/auth.min_8_characters') ?? 'At least 8 characters' }}
                            </li>
                            <!-- Actually we only validate the length -->
                            <!-- <li id="req-uppercase" class="flex items-center">
                                <span class="w-4 h-4 mr-2">•</span>
                                {{ trans('auth/auth.one_uppercase') ?? 'One uppercase letter' }}
                            </li>
                            <li id="req-lowercase" class="flex items-center">
                                <span class="w-4 h-4 mr-2">•</span>
                                {{ trans('auth/auth.one_lowercase') ?? 'One lowercase letter' }}
                            </li>
                            <li id="req-number" class="flex items-center">
                                <span class="w-4 h-4 mr-2">•</span>
                                {{ trans('auth/auth.one_number') ?? 'One number' }}
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-base-content/50 text-xs">
                {{ trans('auth/auth.secure_connection') ?? 'Your connection is secure and your password is encrypted.' }}
            </p>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth/passwords/reset.css') }}">
@endpush