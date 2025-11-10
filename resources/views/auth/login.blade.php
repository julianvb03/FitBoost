@extends('layouts.app')

@section('title', trans('auth/auth.login'))

@section('content')
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">
            <!-- Logo/Brand Section -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-primary-content" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2L3 7v11a1 1 0 001 1h12a1 1 0 001-1V7l-7-5z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-base-content">{{ trans('auth/auth.welcome_back') }}</h1>
                <p class="text-base-content/70 mt-2">{{ trans('auth/auth.login_subtitle') }}</p>
            </div>

            <!-- Login Card -->
            <div class="card bg-base-100 shadow-2xl border border-base-300">
                <div class="card-body p-8">
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Email Field -->
                        <div class="form-control">
                            <label for="email" class="label">
                                <span class="label-text font-medium">{{ trans('auth/auth.email_address') }}</span>
                            </label>
                            <div class="relative">
                                <input id="email" type="email"
                                    class="input input-bordered w-full pl-12 @error('email') input-error @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="{{ trans('auth/auth.email_placeholder') }}">
                                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-base-content/50"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            @error('email')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="form-control">
                            <label for="password" class="label">
                                <span class="label-text font-medium">{{ trans('auth/auth.password') }}</span>
                            </label>
                            <div class="relative">
                                <input id="password" type="password"
                                    class="input input-bordered w-full pl-12 @error('password') input-error @enderror"
                                    name="password" required autocomplete="current-password"
                                    placeholder="{{ trans('auth/auth.password_placeholder') }}">
                                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-base-content/50"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            @error('password')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <label class="cursor-pointer label p-0">
                                <input type="checkbox" class="checkbox checkbox-primary checkbox-sm mr-3" name="remember"
                                    id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span class="label-text text-sm">{{ trans('auth/auth.remember_me') }}</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="link link-primary link-hover text-sm" href="{{ route('password.request') }}">
                                    {{ trans('auth/auth.forgot_password') }}
                                </a>
                            @endif
                        </div>

                        <!-- Login Button -->
                        <div class="form-control mt-8">
                            <div class="flex justify-center">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ trans('auth/auth.login') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Divider -->
                    <div class="divider my-8">{{ trans('auth/auth.or') }}</div>

                    <!-- Register Link -->
                    <div class="text-center">
                        <p class="text-base-content/70 text-sm mb-4">
                            {{ trans('auth/auth.dont_have_account') }}
                        </p>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline btn-secondary">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                                </svg>
                                {{ trans('auth/auth.create_account') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-8">
                <p class="text-base-content/50 text-xs">
                    {{ trans('auth/auth.footer_text') }}
                </p>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endpush
