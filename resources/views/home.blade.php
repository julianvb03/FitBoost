@extends('layouts.app')
@section('title', trans('home.page_title'))

@section('content')
    <div class="space-y-16">
        <section class="relative">
            <div class="flex flex-col lg:flex-row lg:items-center gap-8">
                <div class="flex-1">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-primary/10 rounded-full mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="w-8 h-8 text-primary">
                            <path d="M6.5 6.5h11v11h-11z" />
                            <path d="M6.5 6.5L12 12l5.5-5.5" />
                            <path d="M12 12l5.5 5.5" />
                            <path d="M12 12L6.5 17.5" />
                        </svg>
                    </div>
                    <h1 class="text-4xl lg:text-6xl font-bold text-base-content mb-6">
                        {{ trans('home.hero_title_start') }} <span class="text-primary">FitBoost</span>
                    </h1>
                    <p class="text-xl text-base-content/70 mb-8 max-w-2xl">
                        {{ trans('home.hero_description') }}
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('tests.recommendations.create') }}"
                            class="btn btn-primary btn-lg text-primary-content">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                            {{ trans('home.get_recommendations') }}
                        </a>
                        <a href="{{ route('supplements.index') }}"
                            class="btn btn-outline btn-lg border-neutral text-base-content hover:bg-base-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            {{ trans('home.view_catalog') }}
                        </a>
                    </div>
                </div>

                <div class="lg:w-80 space-y-4">
                    <div class="bg-base-100 border border-neutral/20 rounded-xl p-6 shadow-lg">
                        <h3 class="text-xl font-semibold text-base-content mb-4">{{ trans('home.why_fitboost') }}</h3>
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-base-content">{{ trans('home.premium_quality') }}</div>
                                    <div class="text-sm text-base-content/70">{{ trans('home.certified_products') }}</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-base-content">{{ trans('home.fast_shipping') }}</div>
                                    <div class="text-sm text-base-content/70">{{ trans('home.delivery_time') }}</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-base-content">{{ trans('home.personal_advice') }}</div>
                                    <div class="text-sm text-base-content/70">{{ trans('home.nutrition_experts') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="relative">
            <div class="text-center mb-12">
                <h2 class="text-4xl lg:text-5xl font-bold text-base-content mb-6">
                    {{ trans('home.why_choose_fitboost') }}
                </h2>
                <p class="text-xl text-base-content/70 max-w-3xl mx-auto">
                    {{ trans('home.complete_experience') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div
                    class="bg-base-100 border border-neutral/20 rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-base-content mb-3">{{ trans('home.intelligent_recommendations') }}</h3>
                    <p class="text-base-content/70 mb-4">
                        {{ trans('home.ai_system_description') }}
                    </p>
                    <a href="{{ route('tests.recommendations.create') }}"
                        class="text-primary hover:text-primary/80 font-medium">
                        {{ trans('home.get_recommendations_link') }}
                    </a>
                </div>

                <div
                    class="bg-base-100 border border-neutral/20 rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-base-content mb-3">{{ trans('home.certified_products_title') }}</h3>
                    <p class="text-base-content/70 mb-4">
                        {{ trans('home.brands_description') }}
                    </p>
                    <a href="{{ route('supplements.index') }}" class="text-primary hover:text-primary/80 font-medium">
                        {{ trans('home.view_catalog_link') }}
                    </a>
                </div>

                <div
                    class="bg-base-100 border border-neutral/20 rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-base-content mb-3">{{ trans('home.personalized_advice_title') }}</h3>
                    <p class="text-base-content/70 mb-4">
                        {{ trans('home.experts_description') }}
                    </p>
                    <a href="{{ route('users.show', auth()->id()) }}"
                        class="text-primary hover:text-primary/80 font-medium">
                        {{ trans('home.my_profile_link') }}
                    </a>
                </div>
            </div>
        </section>

        <section class="relative bg-base-200/50 rounded-2xl p-8 lg:p-12">
            <div class="flex flex-col lg:flex-row lg:items-center gap-8">
                <div class="flex-1">
                    <h2 class="text-4xl lg:text-5xl font-bold text-base-content mb-6">
                        {{ trans('home.who_we_are') }}
                    </h2>
                    <p class="text-lg text-base-content/70 mb-6">
                        {{ trans('home.mission_statement') }}
                    </p>
                    <p class="text-base-content/70 mb-8">
                        {{ trans('home.experience_description') }}
                    </p>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary mb-2">500+</div>
                            <div class="text-sm text-base-content/70">{{ trans('home.premium_products_stat') }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary mb-2">10K+</div>
                            <div class="text-sm text-base-content/70">{{ trans('home.satisfied_clients_stat') }}</div>
                        </div>
                    </div>
                </div>
                <div class="lg:w-80">
                    <div class="bg-base-100 border border-neutral/20 rounded-xl p-6 shadow-lg">
                        <h3 class="text-xl font-bold text-base-content mb-4">{{ trans('home.our_values') }}</h3>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3">
                                <div class="w-2 h-2 bg-primary rounded-full"></div>
                                <span class="text-base-content/70">{{ trans('home.value_certified_quality') }}</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <div class="w-2 h-2 bg-primary rounded-full"></div>
                                <span class="text-base-content/70">{{ trans('home.value_constant_innovation') }}</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <div class="w-2 h-2 bg-primary rounded-full"></div>
                                <span class="text-base-content/70">{{ trans('home.value_total_transparency') }}</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <div class="w-2 h-2 bg-primary rounded-full"></div>
                                <span class="text-base-content/70">{{ trans('home.value_expert_support') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
