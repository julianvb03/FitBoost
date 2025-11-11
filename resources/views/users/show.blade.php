@extends('layouts.app')

@section('title', trans('users/show.title'))

@section('content')

    <div class="container mx-auto px-4 py-6 max-w-4xl">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-primary/10 rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="w-8 h-8 text-primary">
                    <path d="M16 7a4 4 0 1 1-8 0 4 4 0 0 1 8 0" />
                    <path d="M12 14a7 7 0 0 0-7 7h14a7 7 0 0 0-7-7" />
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-base-content mb-2">{{ trans('users/show.my_profile') }}</h1>
            <p class="text-base-content/70 text-lg">{{ trans('users/show.description') }}</p>
        </div>

        <!-- Error/Success Messages -->
        @if (isset($viewData['success']))
            <div class="alert alert-success shadow-lg mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ $viewData['success'] }}</span>
            </div>
        @endif

        @if (isset($viewData['error']))
            <div class="alert alert-error shadow-lg mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ $viewData['error'] }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Information of the User -->
            <div class="lg:col-span-2">
                <div class="card bg-base-100 shadow-lg border border-neutral/20 overflow-hidden">
                    <div class="card-header bg-gradient-to-r from-primary to-accent text-primary-content p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="placeholder">
                                    <div
                                        class="bg-neutral text-neutral-content rounded-full w-16 h-16 flex items-center justify-center">
                                        <span class="text-2xl font-bold">
                                            {{ substr($viewData['user']->getName(), 0, 1) }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold">{{ $viewData['user']->getName() }}</h2>
                                    <p class="text-primary-content/80">{{ trans('users/show.user_since', ['date' => $viewData['user']->getCreatedAt()->format('d/m/Y')]) }}</p>
                                </div>
                            </div>
                            <a href="{{ route('users.edit') }}"
                                class="btn btn-ghost btn-sm text-primary-content hover:bg-white/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                {{ trans('users/show.edit_profile') }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-6">
                        <!-- Personal Information -->
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg font-semibold text-base-content mb-4 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ trans('users/show.personal_information') }}
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Name -->
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text font-medium">{{ trans('users/show.full_name') }}</span>
                                        </label>
                                        <div class="input input-bordered flex items-center bg-base-200">
                                            <span class="text-base-content">{{ $viewData['user']->getName() }}</span>
                                        </div>
                                    </div>

                                    <!-- Email Address -->
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text font-medium">{{ trans('users/show.email') }}</span>
                                        </label>
                                        <div class="input input-bordered flex items-center bg-base-200">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 mr-2 text-base-content/60" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                            </svg>
                                            <span class="text-base-content">{{ $viewData['user']->getEmail() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div>
                                <h3 class="text-lg font-semibold text-base-content mb-4 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ trans('users/show.contact_information') }}
                                </h3>

                                <!-- Address -->
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-medium">{{ trans('users/show.address') }}</span>
                                    </label>
                                    <div class="textarea textarea-bordered bg-base-200 min-h-[4rem] flex items-start p-3">
                                        @if ($viewData['user']->getAddress())
                                            <span class="text-base-content">{{ $viewData['user']->getAddress() }}</span>
                                        @else
                                            <span class="text-base-content/40 italic">{{ trans('users/show.no_address_registered') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Information -->
                            <div>
                                <h3 class="text-lg font-semibold text-base-content mb-4 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                    {{ trans('users/show.payment_information') }}
                                </h3>

                                <!-- Card Data -->
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-medium">{{ trans('users/show.card_data') }}</span>
                                    </label>
                                    <div class="input input-bordered bg-base-200 flex items-center">
                                        @if ($viewData['user']->getCardData())
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-success"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-base-content">•••• •••• •••• ••••</span>
                                            <span class="badge badge-success badge-sm ml-auto">{{ trans('users/show.verified') }}</span>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-warning"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                            </svg>
                                            <span class="text-base-content/40 italic">{{ trans('users/show.no_payment_data_registered') }}</span>
                                            <span class="badge badge-warning badge-sm ml-auto">{{ trans('users/show.pending') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Update Button using PATCH -->
                            <div class="card-actions pt-6 border-t border-neutral/20">
                                <form action="{{ route('users.update') }}" method="POST" class="w-full">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-primary w-full lg:w-auto px-8"
                                        onclick="return confirm('{{ trans('users/show.confirm_update') }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        {{ trans('users/show.update_profile') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar with Statistics and Quick Actions -->
            <div class="space-y-6">
                <!-- Statistics -->
                <div class="card bg-base-100 shadow-lg border border-neutral/20">
                    <div class="card-body p-6">
                        <h3 class="text-lg font-semibold text-base-content mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            {{ trans('users/show.statistics') }}
                        </h3>

                        <div class="space-y-4">
                            <!-- Total Orders -->
                            <div class="stat bg-primary/10 rounded-lg p-4">
                                <div class="stat-figure text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14a1 1 0 011 1v9a1 1 0 01-1 1H5a1 1 0 01-1-1v-9a1 1 0 011-1z" />
                                    </svg>
                                </div>
                                <div class="stat-title text-base-content/70">{{ trans('users/show.total_orders') }}</div>
                                <div class="stat-value text-primary">{{ count($viewData['orders']) }}</div>
                            </div>

                            <!-- Total Spent -->
                            <div class="stat bg-success/10 rounded-lg p-4">
                                <div class="stat-figure text-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                    </svg>
                                </div>
                                <div class="stat-title text-base-content/70">{{ trans('users/show.total_spent') }}</div>
                                <div class="stat-value text-success">
                                    ${{ number_format($viewData['orders']->sum(fn($order) => $order->getTotalAmount()), 0, ',', '.') }}
                                </div>
                            </div>

                            <!-- Account Status -->
                            <div class="stat bg-info/10 rounded-lg p-4">
                                <div class="stat-figure text-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div class="stat-title text-base-content/70">{{ trans('users/show.status') }}</div>
                                <div class="stat-value text-info">{{ trans('users/show.active') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card bg-base-100 shadow-lg border border-neutral/20">
                    <div class="card-body p-6">
                        <h3 class="text-lg font-semibold text-base-content mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            {{ trans('users/show.quick_actions') }}
                        </h3>

                        <div class="space-y-3">
                            <a href="{{ route('users.edit') }}" class="btn btn-outline btn-sm w-full justify-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                {{ trans('users/show.edit_information') }}
                            </a>

                            <a href="{{ route('supplements.index') }}"
                                class="btn btn-outline btn-sm w-full justify-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14a1 1 0 011 1v9a1 1 0 01-1 1H5a1 1 0 01-1-1v-9a1 1 0 011-1z" />
                                </svg>
                                {{ trans('users/show.view_supplements') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders History -->
        @if (count($viewData['orders']) > 0)
            <div class="mt-8">
                <div class="card bg-base-100 shadow-lg border border-neutral/20">
                    <div class="card-body p-6">
                        <h3 class="text-xl font-semibold text-base-content mb-6 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            {{ trans('users/show.recent_orders') }}
                        </h3>

                        <div class="overflow-x-auto">
                            <table class="table table-zebra w-full">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>{{ trans('users/show.status') }}</th>
                                        <th>{{ trans('users/show.total') }}</th>
                                        <th>{{ trans('users/show.date') }}</th>
                                        <th>{{ trans('users/show.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($viewData['orders']->take(5) as $order)
                                        <tr>
                                            <td class="font-mono">#{{ str_pad($order->getId(), 4, '0', STR_PAD_LEFT) }}
                                            </td>
                                            <td>
                                                <span
                                                    class="badge 
                                                @if ($order->getStatus() == 'completed') badge-success 
                                                @elseif($order->getStatus() == 'pending') badge-warning
                                                @else badge-error @endif">
                                                    {{ ucfirst($order->getStatus()) }}
                                                </span>
                                            </td>
                                            <td class="font-semibold">
                                                ${{ number_format($order->getTotalAmount(), 0, ',', '.') }}</td>
                                            <td>{{ $order->getCreatedAt()->format('d/m/Y') }}</td>
                                            <td>
                                                <button class="btn btn-ghost btn-sm"
                                                    onclick="alert('{{ trans('users/show.view_details', ['id' => $order->getId()]) }}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if (count($viewData['orders']) > 5)
                            <div class="text-center mt-4">
                                <button class="btn btn-ghost btn-sm" onclick="alert('{{ trans('users/show.view_all_orders') }}')">
                                    {{ trans('users/show.view_all_orders_count', ['count' => count($viewData['orders'])]) }}
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
