@extends('layouts.app')

@section('title', trans('auth.verify_email'))

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <!-- Logo/Brand Section -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-info rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-info-content" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-base-content">{{ trans('auth.verify_email') }}</h1>
            <p class="text-base-content/70 mt-2">{{ trans('auth.verify_email_subtitle') }}</p>
        </div>

        <!-- Verification Card -->
        <div class="card bg-base-100 shadow-2xl border border-base-300">
            <div class="card-body p-8">
                
                <!-- Success Alert -->
                @if (session('resent'))
                    <div class="alert alert-success mb-6" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h3 class="font-bold">{{ trans('auth.verification_sent') }}</h3>
                            <div class="text-xs">{{ trans('auth.check_email') }}</div>
                        </div>
                    </div>
                @endif

                <!-- Email Icon Illustration -->
                <div class="flex justify-center mb-6">
                    <div class="relative">
                        <div class="w-24 h-24 bg-base-200 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-info" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                        </div>
                        <!-- Notification dot -->
                        <div class="absolute -top-1 -right-1 w-6 h-6 bg-warning rounded-full flex items-center justify-center">
                            <span class="text-warning-content text-xs font-bold">!</span>
                        </div>
                    </div>
                </div>

                <!-- Instructions -->
                <div class="text-center mb-8">
                    <p class="text-base-content mb-4 leading-relaxed">
                        {{ trans('auth.check_email') }}
                    </p>
                    <p class="text-base-content/70 text-sm">
                        {{ trans('auth.not_receive_email') }} 
                    </p>
                </div>

                <!-- Resend Form -->
                <form method="POST" action="{{ route('verification.resend') }}" class="space-y-6">
                    @csrf
                    
                    <div class="form-control">
                        <button type="submit" class="btn btn-info btn-lg w-full">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                            </svg>
                            {{ trans('auth.resend_verification') }}
                        </button>
                    </div>
                </form>

                <!-- Divider -->
                <div class="divider my-8">{{ trans('auth.or') }}</div>

                <!-- Alternative Actions -->
                <div class="text-center space-y-4">
                    <!-- Edit Profile Link (if available) -->
                    @if (Route::has('profile.edit'))
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline btn-secondary btn-sm">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                            </svg>
                            {{ trans('auth.update_email')}}
                        </a>
                    @endif

                    <!-- Logout Link -->
                    <div>
                        <a href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="link link-primary link-hover text-sm">
                            {{ trans('auth.logout') }}
                        </a>
                    </div>
                </div>

                <!-- Hidden logout form -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>

        <!-- Help Section -->
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
                            {{ trans('auth.having_trouble') }}
                        </h3>
                        <ul class="text-sm text-base-content/70 space-y-1">
                            <li>• {{ trans('auth.check_spam_folder') }}</li>
                            <li>• {{ trans('auth.verification_expires') }}</li>
                            <li>• {{ trans('auth.contact_support') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-base-content/50 text-xs">
                {{ trans('auth.verification_footer') }}
            </p>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth/verify.css') }}">
@endpush

{{--
@push('scripts')
    @vite('resources/js/auth/verificationScript.js')
@endpush
--}}