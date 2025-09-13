@extends('layouts.app')

@section('title', __('Dashboard'))

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title text-2xl font-bold mb-4">{{ __('Dashboard') }}</h2>
            
            @if (session('status'))
                <div class="alert alert-success mb-6" role="alert">
                    <div class="flex-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current"> 
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path> 
                        </svg>
                        <label>{{ session('status') }}</label>
                    </div>
                </div>
            @endif

            <div class="bg-base-200 p-6 rounded-lg">
                <p class="text-lg">{{ __('You are logged in!') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection