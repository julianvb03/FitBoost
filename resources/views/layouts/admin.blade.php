<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} · @yield('title', 'Admin') </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @stack('head')
</head>

<body class="bg-base-200 text-base-content min-h-screen antialiased">
    <div class="flex min-h-screen flex-col">
        <header class="border-b border-base-300 bg-base-100">
            <div class="mx-auto flex h-20 w-full max-w-[1200px] items-center justify-between px-4 sm:px-6 lg:px-8">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <img src="{{ asset('assets/logo.png') }}" alt="{{ config('app.name') }}" class="h-10 w-10">
                    <div class="flex flex-col">
                        <span class="text-lg font-bold text-primary">{{ trans('layout/admin.admin') }}</span>
                        <span class="text-xs font-semibold uppercase tracking-wide text-base-content/60">{{ trans('layout/admin.control_panel') }}</span>
                    </div>
                </a>

                <nav class="flex items-center gap-6 text-sm font-medium">
                    <a href="{{ route('admin.dashboard') }}" class="transition {{ request()->routeIs('admin.dashboard') ? 'text-primary font-semibold' : 'text-base-content/70 hover:text-primary' }}">
                        {{ trans('layout/admin.panel') }}
                    </a>
                    <a href="{{ route('admin.supplements.index') }}" class="transition {{ request()->routeIs('admin.supplements.*') ? 'text-primary font-semibold' : 'text-base-content/70 hover:text-primary' }}">
                        {{ trans('layout/admin.supplements') }}
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="transition {{ request()->routeIs('admin.categories.*') ? 'text-primary font-semibold' : 'text-base-content/70 hover:text-primary' }}">
                        {{ trans('layout/admin.categories') }}
                    </a>
                </nav>

                <div class="flex items-center gap-3">
                    <form action="{{ route('language.change') }}" method="POST" class="hidden sm:block">
                        @csrf
                        <select name="lang" class="select select-sm select-bordered w-32 border-base-300 bg-base-100"
                            onchange="this.form.submit()">
                            <option value="es" @selected(session('lang', 'es') === 'es')>{{ trans('layout/app.spanish') }}</option>
                            <option value="en" @selected(session('lang', 'es') === 'en')>{{ trans('layout/app.english') }}</option>
                        </select>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-primary text-primary-content">
                            {{ trans('layout/app.logout') }}
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-x-hidden">
            <div class="mx-auto w-full max-w-[1200px] px-4 py-10 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>

        @stack('scripts')
    </div>
</body>

</html>