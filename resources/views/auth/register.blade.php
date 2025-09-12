@extends('layouts.app')

@section('title', __('Register'))

@section('content')
<div class="max-w-md mx-auto">
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title text-2xl font-bold mb-6 justify-center">{{ __('Register') }}</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-control mb-4">
                    <label for="name" class="label">
                        <span class="label-text">{{ __('Name') }}</span>
                    </label>
                    <input id="name" type="text" class="input input-bordered @error('name') input-error @enderror" 
                           name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    
                    @error('name')
                        <div class="text-error mt-2 text-sm">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="form-control mb-4">
                    <label for="email" class="label">
                        <span class="label-text">{{ __('Email Address') }}</span>
                    </label>
                    <input id="email" type="email" class="input input-bordered @error('email') input-error @enderror" 
                           name="email" value="{{ old('email') }}" required autocomplete="email">
                    
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
                           name="password" required autocomplete="new-password">
                    
                    @error('password')
                        <div class="text-error mt-2 text-sm">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

                <div class="form-control mb-6">
                    <label for="password-confirm" class="label">
                        <span class="label-text">{{ __('Confirm Password') }}</span>
                    </label>
                    <input id="password-confirm" type="password" class="input input-bordered" 
                           name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="form-control">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection