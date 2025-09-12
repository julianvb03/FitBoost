@extends('layouts.app')

@section('title', __('Login'))

@section('content')
<div class="max-w-md mx-auto">
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title text-2xl font-bold mb-6 justify-center">{{ __('Login') }}</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-control mb-4">
                    <label for="email" class="label">
                        <span class="label-text">{{ __('Email Address') }}</span>
                    </label>
                    <input id="email" type="email" class="input input-bordered @error('email') input-error @enderror" 
                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    
                    @error('email')
                        <div class="text-error mt-2 text-sm">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

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

                <div class="form-control mb-6">
                    <label class="cursor-pointer label justify-start">
                        <input type="checkbox" class="checkbox checkbox-primary mr-2" 
                               name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="label-text">{{ __('Remember Me') }}</span>
                    </label>
                </div>

                <div class="form-control mb-4">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Login') }}
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