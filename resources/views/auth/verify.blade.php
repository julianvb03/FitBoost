@extends('layouts.app')

@section('title', __('Verify Your Email Address'))

@section('content')
<div class="max-w-md mx-auto">
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title text-2xl font-bold mb-6 justify-center">{{ __('Verify Your Email Address') }}</h2>

            @if (session('resent'))
                <div class="alert alert-success mb-6" role="alert">
                    <div class="flex-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current"> 
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path> 
                        </svg>
                        <label>{{ __('A fresh verification link has been sent to your email address.') }}</label>
                    </div>
                </div>
            @endif

            <div class="mb-6">
                <p class="text-base-content">{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                <p class="text-base-content">{{ __('If you did not receive the email') }},</p>
            </div>

            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-link p-0 text-primary hover:text-primary-focus">
                    {{ __('click here to request another') }}
                </button>.
            </form>
        </div>
    </div>
</div>
@endsection