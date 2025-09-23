@extends('layouts.app')

@section('title', trans('auth/auth.register'))

@section('content')
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">
            <!-- Logo/Brand Section -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-secondary rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-secondary-content" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-base-content">{{ trans('auth/auth.create_new_account') }}</h1>
                <p class="text-base-content/70 mt-2">{{ trans('auth/auth.register_subtitle') }}</p>
            </div>

            <!-- Register Card -->
            <div class="card bg-base-100 shadow-2xl border border-base-300">
                <div class="card-body p-8">
                    <form method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf

                        <!-- Name Field -->
                        <div class="form-control">
                            <label for="name" class="label">
                                <span class="label-text font-medium">{{ trans('auth/auth.name') }}</span>
                            </label>
                            <div class="relative">
                                <input id="name" type="text"
                                    class="input input-bordered w-full pl-12 @error('name') input-error @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                    placeholder="{{ trans('auth/auth.name_placeholder') }}">
                                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-base-content/50"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            @error('name')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="form-control">
                            <label for="email" class="label">
                                <span class="label-text font-medium">{{ trans('auth/auth.email_address') }}</span>
                            </label>
                            <div class="relative">
                                <input id="email" type="email"
                                    class="input input-bordered w-full pl-12 @error('email') input-error @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email"
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
                                    name="password" required autocomplete="new-password"
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

                        <!-- Confirm Password Field -->
                        <div class="form-control">
                            <label for="password-confirm" class="label">
                                <span class="label-text font-medium">{{ trans('auth/auth.confirm_password') }}</span>
                            </label>
                            <div class="relative">
                                <input id="password-confirm" type="password" class="input input-bordered w-full pl-12"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="{{ trans('auth/auth.confirm_password_placeholder') }}">
                                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-base-content/50"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>

                        <!-- Register Button -->
                        <div class="form-control mt-8">
                            <div class="flex justify-center">
                                <button type="submit" class="btn btn-secondary btn-lg">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                                    </svg>
                                    {{ trans('auth/auth.register') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Divider -->
                    <div class="divider my-8">{{ trans('auth/auth.or') }}</div>

                    <!-- Login Link -->
                    <div class="text-center">
                        <p class="text-base-content/70 text-sm mb-4">
                            {{ trans('auth/auth.already_have_account') }}
                        </p>
                        <a href="{{ route('login') }}" class="btn btn-outline btn-primary">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ trans('auth/auth.login_here') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-8">
                <p class="text-base-content/50 text-xs">
                    {{ trans('auth/auth.register_footer') }}
                </p>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endpush
