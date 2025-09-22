@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ trans('cart.added') }}</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($count === 0)
            <p>{{ __('Your cart is empty.') }}</p>
            <a class="btn btn-primary" href="{{ route('supplements.index') }}">{{ __('Continue shopping') }}</a>
        @else
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __('Product') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th style="width:160px">{{ __('Quantity') }}</th>
                            <th>{{ __('Subtotal') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $row)
                            @php
                                $supplement = is_array($row) ? $row['supplement'] : $row->getSupplement();
                                $quantity = is_array($row) ? $row['quantity'] : $row->getQuantity();
                                $subtotal = is_array($row) ? $row['subtotal'] : $row->getTotalPrice();
                            @endphp
                            <tr>
                                <td>{{ $supplement->getName() }}</td>
                                <td>${{ number_format($supplement->getPrice(), 0) }}</td>
                                <td>
                                    <form class="d-inline" method="POST"
                                        action="{{ route('cart.items.update', ['supplement' => $supplement->getId()]) }}">
                                        @csrf
                                        @method('PATCH')
                                        <div class="input-group">
                                            <input name="quantity" type="number" min="1" max="99"
                                                class="form-control" value="{{ $quantity }}">
                                            <button type="submit"
                                                class="btn btn-outline-secondary">{{ __('Update') }}</button>
                                        </div>
                                    </form>
                                </td>
                                <td>${{ number_format($subtotal, 0) }}</td>
                                <td>
                                    <form class="d-inline" method="POST"
                                        action="{{ route('cart.items.destroy', ['supplement' => $supplement->getId()]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-link text-danger">{{ __('Remove') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <form method="POST" action="{{ route('cart.clear') }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger">{{ __('Empty cart') }}</button>
                </form>

                <div>
                    <h4 class="mb-3">{{ __('Total') }}: ${{ number_format($total, 0) }}</h4>
                    <form method="POST" action="{{ route('cart.checkout') }}">
                        @csrf
                        <button class="btn btn-success">{{ __('Buy now') }}</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection
