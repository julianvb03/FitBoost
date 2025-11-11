@extends('layouts.app')
@section('title', trans('layout/app.car_shop') . ' - FitBoost')

@section('content')
    <div class="space-y-8">
        <div class="flex items-center justify-between">
            <h1 class="text-4xl font-bold text-base-content">{{ trans('layout/app.car_shop') }}</h1>
            @if ($viewData['count'] > 0)
                <span class="badge badge-primary badge-lg text-lg px-4 py-3">{{ $viewData['count'] }} {{ trans('items') }}</span>
            @endif
        </div>

        @if (isset($viewData['success']))
            <div class="alert alert-success shadow-lg text-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ $viewData['success'] }}</span>
            </div>
        @endif

        @if (isset($viewData['error']))
            <div class="alert alert-error shadow-lg text-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ $viewData['error'] }}</span>
            </div>
        @endif

        @if (isset($viewData['warning']))
            <div class="alert alert-warning shadow-lg text-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span>{{ $viewData['warning'] }}</span>
            </div>
        @endif

        @if ($viewData['count'] === 0)
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body items-center text-center py-16">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 text-base-content/20" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <h2 class="card-title text-3xl mt-6">{{ trans('Your cart is empty.') }}</h2>
                    <p class="text-base-content/70 mb-8 text-lg">{{ trans('Start adding products to your cart!') }}</p>
                    <a class="btn btn-primary btn-lg" href="{{ route('supplements.index') }}">
                        {{ trans('Continue shopping') }}
                    </a>
                </div>
            </div>
        @else
            <div class="space-y-6">
                @foreach ($viewData['items'] as $row)
                    @php
                        $supplement = is_array($row) ? $row['supplement'] : $row->getSupplement();
                        $quantity = is_array($row) ? $row['quantity'] : $row->getQuantity();
                        $subtotal = is_array($row) ? $row['subtotal'] : $row->getTotalPrice();
                        $supplementId = $supplement->getId();
                    @endphp
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body p-8">
                            <div class="flex flex-col lg:flex-row gap-8 items-center lg:items-start">
                                <div class="avatar placeholder">
                                    <div class="bg-primary text-primary-content rounded-xl w-24 h-24">
                                        <span class="text-3xl font-bold">
                                            {{ substr($supplement->getName(), 0, 2) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="flex-1 w-full">
                                    <h2 class="card-title text-2xl mb-2">{{ $supplement->getName() }}</h2>
                                    <p class="text-base-content/60 text-lg mb-4">
                                        {{ trans('Stock') }}: <span class="font-semibold">{{ $supplement->getStock() }}</span>
                                    </p>
                                    <div class="text-2xl font-bold text-primary mb-6">
                                        ${{ number_format($supplement->getPrice(), 0) }}
                                    </div>
                                </div>

                                <div class="flex flex-col lg:flex-row items-center gap-6 w-full lg:w-auto">
                                    <div class="flex items-center gap-4">
                                        <form method="POST"
                                            action="{{ route('cart.items.update', ['supplement' => $supplementId]) }}">
                                            @csrf
                                            @method('PATCH')
                                            <div class="flex items-center gap-3">
                                                <label class="text-lg font-semibold">{{ trans('Quantity') }}:</label>
                                                <input name="quantity" type="number" min="1" max="99"
                                                    class="input input-bordered input-lg w-24 text-center text-lg font-semibold"
                                                    value="{{ $quantity }}">
                                                <button type="submit" class="btn btn-primary btn-lg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                    </svg>
                                                    {{ trans('Update') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="divider divider-horizontal lg:block hidden"></div>

                                    <div class="flex flex-col items-center gap-4">
                                        <div class="text-xl font-semibold text-base-content/60">{{ trans('Subtotal') }}</div>
                                        <div class="text-3xl font-bold text-primary">
                                            ${{ number_format($subtotal, 0) }}
                                        </div>
                                    </div>

                                    <div class="divider divider-horizontal lg:block hidden"></div>

                                    <div>
                                        <form method="POST"
                                            action="{{ route('cart.items.destroy', ['supplement' => $supplementId]) }}"
                                            onsubmit="return confirm('{{ trans('Are you sure you want to remove this item?') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-error btn-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                {{ trans('Remove') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex flex-col lg:flex-row gap-6 mt-8">
                <div class="flex-1">
                    <form method="POST" action="{{ route('cart.clear') }}"
                        onsubmit="return confirm('{{ trans('Are you sure you want to empty your cart?') }}');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline btn-error btn-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            {{ trans('Empty cart') }}
                        </button>
                    </form>
                </div>

                <div class="card bg-base-200 shadow-xl lg:w-[400px]">
                    <div class="card-body p-8">
                        <h2 class="card-title text-3xl mb-6">{{ trans('Total') }}</h2>
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between text-xl text-base-content/70">
                                <span>{{ trans('Subtotal') }}</span>
                                <span class="font-semibold">${{ number_format($viewData['total'], 0) }}</span>
                            </div>
                            <div class="divider my-4"></div>
                            <div class="flex justify-between text-3xl font-bold">
                                <span>{{ trans('Total') }}</span>
                                <span class="text-primary">${{ number_format($viewData['total'], 0) }}</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            @auth
                                <form method="POST" action="{{ route('cart.checkout') }}" class="w-full">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-lg btn-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        {{ trans('Buy now') }}
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-success btn-lg btn-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                    </svg>
                                    {{ trans('auth/auth.login') }} {{ trans('to checkout') }}
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
