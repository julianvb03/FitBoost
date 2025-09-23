@extends('layouts.app')

@section('title', trans('auth/auth.reset_password'))

@section('content')
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">
            <!-- Logo/Brand Section -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-warning rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-warning-content" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 8a6 6 0 01-7.743 5.743L10 14l-4 4-4-4 4-4 .257-.257A6 6 0 1118 8zm-6-2a1 1 0 10-2 0 1 1 0 002 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-base-content">{{ trans('auth/auth.reset_password') }}</h1>
                <p class="text-base-content/70 mt-2">{{ trans('auth/auth.reset_password_subtitle') }}</p>
            </div>

            <!-- Reset Password Card -->
            <div class="card bg-base-100 shadow-2xl border border-base-300">
                <div class="card-body p-8">

                    <!-- Success Alert -->
                    @if (session('status'))
                        <div class="alert alert-success mb-6" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h3 class="font-bold">{{ trans('auth/auth.reset_link_sent') }}</h3>
                                <div class="text-xs">{{ session('status') }}</div>
                            </div>
                        </div>
                    @endif

                    <!-- Lock Icon Illustration -->
                    <div class="flex justify-center mb-6">
                        <div class="relative">
                            <div class="w-24 h-24 bg-base-200 rounded-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-warning" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 8a6 6 0 01-7.743 5.743L10 14l-4 4-4-4 4-4 .257-.257A6 6 0 1118 8zm-6-2a1 1 0 10-2 0 1 1 0 002 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <!-- Key icon overlay -->
                            <div
                                class="absolute -bottom-2 -right-2 w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-primary-content" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 8a6 6 0 01-7.743 5.743L10 14l-4 4-4-4 4-4 .257-.257A6 6 0 1118 8zm-6-2a1 1 0 10-2 0 1 1 0 002 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Instructions -->
                    @if (!session('status'))
                        <div class="text-center mb-8">
                            <p class="text-base-content mb-4 leading-relaxed">
                                {{ trans('auth/auth.forgot_password_instructions') }}
                            </p>
                        </div>
                    @endif

                    <!-- Reset Form -->
                    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
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
                                    placeholder="{{ trans('auth/auth.email_placeholder') }}"
                                    @if (session('status')) disabled @endif>
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

                        <!-- Submit Button -->
                        <div class="form-control">
                            @if (!session('status'))
                                <button type="submit" class="btn btn-warning btn-lg w-full" id="reset-btn">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                    {{ trans('auth/auth.send_reset_link') }}
                                </button>
                            @else
                                <button type="submit" class="btn btn-warning btn-lg w-full">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ trans('auth/auth.send_another_link') }}
                                </button>
                            @endif
                        </div>
                    </form>

                    <!-- Divider -->
                    <div class="divider my-8">{{ trans('auth/auth.or') }}</div>

                    <!-- Back to Login -->
                    <div class="text-center">
                        <p class="text-base-content/70 text-sm mb-4">
                            {{ trans('auth/auth.remember_password') }}
                        </p>
                        <a href="{{ route('login') }}" class="btn btn-outline btn-primary">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ trans('auth/auth.back_to_login') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Security Info -->
            <div class="card bg-base-200/50 mt-6 border border-base-300">
                <div class="card-body p-6">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-info" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-medium text-base-content mb-2">
                                {{ trans('auth/auth.security_notice') }}
                            </h3>
                            <ul class="text-sm text-base-content/70 space-y-1">
                                <li>• {{ trans('auth/auth.reset_link_expires') }}</li>
                                <li>• {{ trans('auth/auth.check_spam_folder') }}</li>
                                <li>• {{ trans('auth/auth.one_time_use') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-8">
                <p class="text-base-content/50 text-xs">
                    {{ trans('auth/auth.reset_footer') }}
                </p>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth/passwords/email.css') }}">
@endpush
