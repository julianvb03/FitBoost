@extends('layouts.app')

@section('title', __('Confirm Password'))

@section('content')
<div class="max-w-md mx-auto">
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title text-2xl font-bold mb-6 justify-center">{{ __('Confirm Password') }}</h2>

            <p class="text-base-content mb-6">{{ __('Please confirm your password before continuing.') }}</p>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="form-control mb-4">
                    <label for="password" class="label">
                        <span class="label-text">{{ __('Password') }}</span>
                    </label>
                    <input id="password" type="password" class="input input-bordered @error('password') input-error @enderror" 
                           name="password" required autocomplete="current-password">
                    
                    @error('password')
                        <div class="text-error mt-2 text-sm">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="form-control mb-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Confirm Password') }}
                    </button>
                </div>

                @if (Route::has('password.request'))
                    <div class="text-center mt-4">
                        <a class="link link-primary" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection