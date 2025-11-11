<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fitboost | @yield('title', 'FitBoost')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="bg-base-200 text-base-content antialiased">
    <div class="flex min-h-screen flex-col">
        <header class="border-b border-base-300 bg-base-100">
            <div class="mx-auto flex h-20 w-full max-w-[1200px] items-center justify-between px-4 sm:px-6 lg:px-8">
                <a href="{{ route('home.index') }}" class="flex items-center gap-3">
                    <img src="{{ asset('assets/logo.png') }}" alt="FitBoost" class="h-12 w-12">
                    <div class="hidden sm:flex flex-col">
                        <span class="text-lg font-bold text-primary">FitBoost</span>
                        <span class="text-xs font-semibold uppercase tracking-wide text-base-content/60">
                            {{ trans('layout/app.health_wellness') }}
                        </span>
                    </div>
                </a>

                <nav class="hidden items-center gap-6 text-sm font-medium md:flex">
                    <a href="{{ route('home.index') }}" class="transition {{ request()->routeIs('home.index') ? 'text-primary font-semibold' : 'text-base-content/70 hover:text-primary' }}">
                        {{ trans('layout/app.home') }}
                    </a>
                    <a href="{{ route('supplements.index') }}" class="transition {{ request()->routeIs('supplements.*') ? 'text-primary font-semibold' : 'text-base-content/70 hover:text-primary' }}">
                        {{ trans('layout/app.products') }}
                    </a>
                    <a href="{{ route('bmi.index') }}" class="transition {{ request()->routeIs('bmi.*') ? 'text-primary font-semibold' : 'text-base-content/70 hover:text-primary' }}">
                        {{ trans('layout/app.bmi_calculator') }}
                    </a>
                    @auth
                        <a href="{{ route('users.show') }}" class="transition {{ request()->routeIs('users.*') ? 'text-primary font-semibold' : 'text-base-content/70 hover:text-primary' }}">
                            {{ trans('layout/app.profile') }}
                        </a>
                            @if (auth()->user()->hasRole('user'))
                            <a href="{{ route('tests.recommendations.create') }}" class="transition {{ request()->routeIs('tests.recommendations.*') ? 'text-primary font-semibold' : 'text-base-content/70 hover:text-primary' }}">
                                {{ trans('layout/app.ai_recommendations') }}
                            </a>
                        @endif
                        @if (auth()->user()->hasRole('admin'))
                            <a href="{{ route('admin.dashboard') }}" class="transition {{ request()->routeIs('admin.*') ? 'text-primary font-semibold' : 'text-base-content/70 hover:text-primary' }}">
                                {{ trans('layout/app.admin_dashboard') }}
                            </a>
                        @endif
                    @endauth
                </nav>

                <div class="dropdown dropdown-end md:hidden">
                    <label tabindex="0" class="btn btn-ghost btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </label>
                    <ul tabindex="0" class="menu dropdown-content rounded-box bg-base-100 p-3 shadow">
                        <li><a href="{{ route('home.index') }}">{{ trans('layout/app.home') }}</a></li>
                        <li><a href="{{ route('supplements.index') }}">{{ trans('layout/app.products') }}</a></li>
                        <li><a href="{{ route('bmi.index') }}">{{ trans('layout/app.bmi_calculator') }}</a></li>
                        <li><a href="{{ route('cart.index') }}">{{ trans('layout/app.car_shop') }}</a></li>
                        @auth
                            <li><a href="{{ route('users.show') }}">{{ trans('layout/app.profile') }}</a></li>
                            @if (auth()->user()->hasRole('user'))
                                <li><a href="{{ route('tests.recommendations.create') }}">{{ trans('layout/app.ai_recommendations') }}</a></li>
                            @endif
                            @if (auth()->user()->hasRole('admin'))
                                <li><a href="{{ route('admin.dashboard') }}">{{ trans('layout/app.admin_dashboard') }}</a></li>
                            @endif
                        @endauth
                    </ul>
                </div>

                <div class="flex items-center gap-3">
                    <form action="{{ route('language.change') }}" method="POST" class="hidden sm:block">
                        @csrf
                        <select name="lang" class="select select-sm select-bordered w-32 border-base-300 bg-base-100"
                            onchange="this.form.submit()">
                            <option value="es" @selected(session('lang', 'es') === 'es')>{{ trans('layout/app.spanish') }}</option>
                            <option value="en" @selected(session('lang', 'es') === 'en')>{{ trans('layout/app.english') }}</option>
                        </select>
                    </form>

                    <a href="{{ route('cart.index') }}" class="btn btn-ghost btn-sm relative">
                        {{ trans('layout/app.car_shop') }}
                        @if (($cartItemCount ?? 0) > 0)
                            <span class="badge badge-primary badge-sm absolute -top-2 -right-2">{{ $cartItemCount }}</span>
                        @endif
                    </a>

                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary text-primary-content">
                                {{ trans('layout/app.logout') }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-sm btn-primary text-primary-content">
                            {{ trans('auth/auth.login') }}
                        </a>
                    @endauth
                </div>
            </div>
        </header>

        <main class="flex-1" id="main-content">
            <div class="mx-auto w-full max-w-[1200px] px-4 py-10 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>

        @stack('scripts')
    </div>
</body>

</html>
