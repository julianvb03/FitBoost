<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fitboost | @yield('title', 'FitBoost')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body>
    <main>
        <div class="drawer xl:drawer-open">
            <input id="left-sidebar" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content">
                {{-- Navbar --}}
                <div class="navbar bg-base-100 shadow-sm px-6">
                    <div class="navbar-start">
                        @auth
                            <label for="left-sidebar" class="btn btn-ghost xl:hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h8m-8 6h16" />
                                </svg>
                            </label>
                        @endauth
                        <div class="flex items-center gap-3">
                            <a href="/" class="">
                                {{-- Logo --}}
                                <img src="{{ asset('assets/logo.png') }}" alt="FitBoost" class="size-12">
                            </a>
                            <div class="hidden xl:block">
                                <span class="bg-accent text-accent-content px-3 py-1 rounded-full text-sm font-medium">
                                    {{ trans('layout/app.health_wellness') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="navbar-center hidden xl:flex">
                        <ul class="menu menu-horizontal px-1">
                            <li><a href="{{ route('home.index') }}" class="text-base-content hover:text-primary">
                                    {{ trans('layout/app.home') }} </a>
                            </li>
                            <li><a href="#" class="text-base-content hover:text-primary">
                                    {{ trans('layout/app.contact') }} </a>
                            </li>
                            @auth
                                @if (auth()->user()->hasRole('admin'))
                                    <li><a href="#" class="text-base-content hover:text-primary">
                                            {{ trans('layout/app.admin_dashboard') }} </a>
                                    </li>
                                @endif
                                @if (auth()->user()->hasRole('user'))
                                    <li><a href="#" class="text-base-content hover:text-primary">
                                            {{ trans('layout/app.car_shop') }} </a>
                                    </li>
                                @endif

                            @endauth
                            </li>
                        </ul>
                    </div>
                    <div class="navbar-end">
                        <div class="flex items-center gap-3">
                            <!-- Language Selector -->
                            <form id="language-form-sidebar" action="{{ route('language.change') }}" method="POST"
                                class="hidden xl:block">
                                @csrf
                                <select name="lang"
                                    class="select select-bordered cursor-pointer select-sm w-auto max-w-xs border-neutral text-base-content bg-base-100 hover:bg-base-200"
                                    onchange="document.getElementById('language-form-sidebar').submit();">

                                    <option disabled selected>
                                        {{ trans('layout/app.choose_language') }}
                                    </option>

                                    <option value="es" @selected(session('lang', 'es') === 'es')>Español</option>
                                    <option value="en" @selected(session('lang', 'es') === 'en')>English</option>
                                </select>
                            </form>

                            <a href="#"
                                class="btn btn-outline btn-sm border-neutral text-base-content hover:bg-base-200 hidden xl:flex">
                                {{ trans('layout/app.free_evaluation') }}
                            </a>
                            <a href="#"
                                class="btn btn-outline btn-sm border-neutral text-base-content hover:bg-base-200 hidden xl:flex">
                                {{ trans('layout/app.products') }}
                            </a>
                            @guest
                                <a href="{{ route('login') }}" class="btn btn-primary btn-sm text-primary-content">
                                    {{ trans('layout/app.register') }}
                                </a>
                            @endguest
                            @auth
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        {{ trans('layout/app.logout') }}
                                    </button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>

                {{-- <!-- Page content here --> --}}
                <div class="h-[calc(100dvh-65px)] overflow-hidden overflow-y-auto bg-base-200 my-side-container"
                    id="main-content">
                    <div class="container mx-auto py-10 px-4 xl:px-8">
                        @yield('content')
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            @auth
                <div class="drawer-side">
                    <label for="left-sidebar" aria-label="close sidebar" class="drawer-overlay"></label>
                    <div class="bg-base-100 text-base-content min-h-full w-80 p-6">
                        {{-- Logo and branding on sidebar --}}
                        <div class="flex flex-col items-center mb-8">
                            <a href="/">
                                <img src="{{ asset('assets/logo.png') }}" alt="FitBoost" class="size-24">
                            </a>
                            <span class="bg-accent text-accent-content px-3 py-1 rounded-full text-sm font-medium mt-2">
                                {{ trans('layout/app.health_wellness') }}
                            </span>
                        </div>

                        {{-- Navigation Menu --}}
                        <ul class="menu w-full space-y-2">
                            @if (auth()->user()->hasRole('admin'))
                                <li>
                                    <a class="flex items-center gap-3 p-3 rounded-lg hover:bg-base-200 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                            </path>
                                        </svg>
                                        <span> {{ trans('layout/app.dashboard') }} </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="flex items-center gap-3 p-3 rounded-lg hover:bg-base-200 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                            </path>
                                        </svg>
                                        <span> {{ trans('layout/app.statistics') }} </span>
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a class="flex items-center gap-3 p-3 rounded-lg hover:bg-base-200 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span> {{ trans('layout/app.profile') }} </span>
                                </a>
                            </li>
                            <li>
                                <a class="flex items-center gap-3 p-3 rounded-lg hover:bg-base-200 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span> {{ trans('layout/app.recommendations') }} </span>
                                </a>
                            </li>
                            {{-- <li>
                                <a class="flex items-center gap-3 p-3 rounded-lg hover:bg-base-200 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                        </path>
                                    </svg>
                                    <span> {{ trans('layout/app.routines') }} </span>
                                </a>
                            </li> --}}
                        </ul>

                        {{-- Language Selector on sidebar --}}
                        <div class="mt-8 space-y-3">
                            {{-- <form id="language-form-sidebar" action="{{ route('language.change') }}" method="POST">
                                @csrf
                                <select name="lang" class="select select-bordered w-full max-w-xs"
                                    onchange="document.getElementById('language-form-sidebar').submit();">

                                    <option disabled selected>
                                        {{ __('Choose your language') }}
                                    </option>

                                    <option value="es" @selected(session('lang') === 'es')>Español</option>
                                    <option value="en" @selected(session('lang') === 'en')>English</option>
                                </select>
                            </form> --}}

                            <button class="btn btn-outline w-full border-neutral text-base-content hover:bg-base-200">
                                {{ trans('layout/app.products') }}
                            </button>
                            <button class="btn btn-primary w-full text-primary-content">
                                {{ trans('layout/app.free_evaluation') }}
                            </button>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
    </main>
    @stack('scripts')
</body>

</html>
