@extends('layouts.app')

@section('title', trans('auth/auth.confirm_password'))

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <!-- Logo/Brand Section -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-accent rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-accent-content" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-base-content">{{ trans('auth/auth.confirm_password') }}</h1>
            <p class="text-base-content/70 mt-2">{{ trans('auth/auth.confirm_password_subtitle') }}</p>
        </div>

        <!-- Confirm Password Card -->
        <div class="card bg-base-100 shadow-2xl border border-base-300">
            <div class="card-body p-8">
                
                <!-- Shield Icon Illustration -->
                <div class="flex justify-center mb-6">
                    <div class="relative">
                        <div class="w-24 h-24 bg-base-200 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-accent" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <!-- User icon overlay -->
                        <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-primary-content" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- User Info (if available) -->
                 <!-- Avoided for bad practices -->
                <!-- @auth/auth
                    <div class="text-center mb-6">
                        <div class="flex items-center justify-center space-x-3 mb-3">
                            <div class="avatar placeholder">
                                <div class="bg-primary text-primary-content rounded-full w-12">
                                    <span class="text-xl font-semibold">
                                        {{ strtoupper(substr(auth/Auth::user()->name ?? auth/Auth::user()->email, 0, 1)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="text-left">
                                <p class="font-semibold text-base-content">{{ auth/Auth::user()->name ?? 'User' }}</p>
                                <p class="text-sm text-base-content/70">{{ auth/Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                @endauth/auth -->

                <!-- Instructions -->
                <div class="alert alert-info mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h3 class="font-bold">{{ trans('auth/auth.security_check') }}</h3>
                        <div class="text-xs">{{ trans('auth/auth.confirm_password_message') }}</div>
                    </div>
                </div>

                <!-- Confirm Form -->
                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                    @csrf

                    <!-- Password Field -->
                    <div class="form-control">
                        <label for="password" class="label">
                            <span class="label-text font-medium">{{ trans('auth/auth.password') }}</span>
                        </label>
                        <div class="relative">
                            <input 
                                id="password" 
                                type="password" 
                                class="input input-bordered w-full pl-12 pr-12 @error('password') input-error @enderror"
                                name="password" 
                                required 
                                autocomplete="current-password"
                                placeholder="{{ trans('auth/auth.enter_current_password') }}"
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
                    </div>

                    <!-- Submit Button -->
                    <div class="form-control">
                        <button type="submit" class="btn btn-accent btn-lg w-full" id="confirm-btn">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            {{ trans('auth/auth.confirm_password') }}
                        </button>
                    </div>

                    <!-- Alternative Actions -->
                    <div class="space-y-4">
                        @if (Route::has('password.request'))
                            <div class="text-center">
                                <a class="link link-primary link-hover text-sm" href="{{ route('password.request') }}">
                                    <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L10 14l-4 4-4-4 4-4 .257-.257A6 6 0 1118 8zm-6-2a1 1 0 10-2 0 1 1 0 002 0z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ trans('auth/auth.forgot_password') }}
                                </a>
                            </div>
                        @endif

                        <!-- Divider -->
                        <div class="divider text-xs">{{ trans('auth/auth.or') }}</div>

                        <!-- Logout Option -->
                        <div class="text-center">
                            <p class="text-base-content/70 text-sm mb-2">
                                {{ trans('auth/auth.not_you') }}
                            </p>
                            <a href="{{ route('logout') }}" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="btn btn-outline btn-sm">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/>
                                </svg>
                                {{ trans('auth/auth.switch_account') }}
                            </a>
                        </div>
                    </div>
                </form>

                <!-- Hidden logout form -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>

        <!-- Security Info -->
        <div class="card bg-base-200/50 mt-6 border border-base-300">
            <div class="card-body p-6">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-warning" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-medium text-base-content mb-2">
                            {{ trans('auth/auth.why_confirm') }}
                        </h3>
                        <ul class="text-sm text-base-content/70 space-y-1">
                            <li>• {{ trans('auth/auth.protect_sensitive_actions') }}</li>
                            <li>• {{ trans('auth/auth.verify_identity') }}</li>
                            <li>• {{ trans('auth/auth.session_timeout') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-base-content/50 text-xs">
                {{ trans('auth/auth.confirm_footer') }}
            </p>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth/auth/passwords/confirm.css') }}">
@endpush