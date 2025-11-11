@extends('layouts.admin')

@section('title', trans('admin/categories/create.title'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <div class="breadcrumbs text-sm text-base-content/70 mb-2">
                <ul>
                    <li><a href="{{ route('admin.categories.index') }}" class="hover:text-primary">{{ trans('admin/categories/create.categories') }}</a></li>
                    <li class="text-base-content">{{ trans('admin/categories/create.new_category') }}</li>
                </ul>
            </div>
            <h1 class="text-3xl font-bold text-base-content">{{ trans('admin/categories/create.heading') }}</h1>
            <p class="text-base-content/70 mt-2">{{ trans('admin/categories/create.description') }}</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-ghost btn-lg gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            {{ trans('admin/categories/create.back_to_list') }}
        </a>
    </div>

    @if(isset($viewData['error']))
    <div class="alert alert-error shadow-lg mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ $viewData['error'] }}</span>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        {{ trans('admin/categories/create.category_information') }}
                    </h2>

                    <form action="{{ route('admin.categories.store') }}" method="POST" id="categoryForm" data-category-form>
                        @csrf

                        <div class="form-control w-full mb-6">
                            <label class="label" for="name">
                                <span class="label-text font-semibold">{{ trans('admin/categories/create.category_name') }}</span>
                                <span class="label-text-alt text-error">*</span>
                            </label>
                            <input type="text"
                                id="name"
                                name="name"
                                class="input input-bordered w-full @error('name') input-error @enderror"
                                placeholder="{{ trans('admin/categories/create.name_placeholder') }}"
                                value="{{ old('name') }}"
                                data-max-length="255"
                                data-counter-id="nameCounter"
                                data-error-class="input-error"
                                required>
                            @error('name')
                            <label class="label">
                                <span class="label-text-alt text-error">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </span>
                            </label>
                            @enderror
                            <label class="label">
                                <span class="label-text-alt text-base-content/50">{{ trans('admin/categories/create.name_hint') }}</span>
                                <span class="label-text-alt text-base-content/50" id="nameCounter">0/255</span>
                            </label>
                        </div>

                        <div class="form-control w-full mb-8">
                            <label class="label" for="description">
                                <span class="label-text font-semibold">{{ trans('admin/categories/create.description') }}</span>
                                <span class="label-text-alt text-base-content/50">({{ trans('admin/categories/create.optional') }})</span>
                            </label>
                            <textarea id="description"
                                name="description"
                                class="textarea textarea-bordered h-32 resize-none @error('description') textarea-error @enderror"
                                placeholder="{{ trans('admin/categories/create.description_placeholder') }}"
                                data-max-length="500"
                                data-counter-id="descCounter"
                                data-error-class="textarea-error">{{ old('description') }}</textarea>
                            @error('description')
                            <label class="label">
                                <span class="label-text-alt text-error">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </span>
                            </label>
                            @enderror
                            <label class="label">
                                <span class="label-text-alt text-base-content/50">{{ trans('admin/categories/create.description_hint') }}</span>
                                <span class="label-text-alt text-base-content/50" id="descCounter">0/500</span>
                            </label>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 justify-end">
                            <button type="button"
                                class="btn btn-ghost btn-lg order-2 sm:order-1"
                                data-category-reset="clear"
                                data-reset-focus="#name">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                {{ trans('admin/categories/create.clear') }}
                            </button>
                            <button type="submit"
                                class="btn btn-primary btn-lg order-1 sm:order-2"
                                id="submitBtn"
                                data-loading-text="{{ trans('admin/categories/create.creating') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ trans('admin/categories/create.create_category') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="space-y-6">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h3 class="card-title text-info">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ trans('admin/categories/create.tips') }}
                        </h3>
                        <div class="space-y-4 text-sm text-base-content/70">
                            <div class="flex items-start gap-3">
                                <div class="w-2 h-2 bg-primary rounded-full mt-2 flex-shrink-0"></div>
                                <div>
                                    <strong class="text-base-content">{{ trans('admin/categories/create.tip_unique_name') }}:</strong> {{ trans('admin/categories/create.tip_unique_name_description') }}
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-2 h-2 bg-primary rounded-full mt-2 flex-shrink-0"></div>
                                <div>
                                    <strong class="text-base-content">{{ trans('admin/categories/create.tip_clear_description') }}:</strong> {{ trans('admin/categories/create.tip_clear_description_description') }}
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-2 h-2 bg-primary rounded-full mt-2 flex-shrink-0"></div>
                                <div>
                                    <strong class="text-base-content">{{ trans('admin/categories/create.tip_seo_friendly') }}:</strong> {{ trans('admin/categories/create.tip_seo_friendly_description') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h3 class="card-title text-success">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                            {{ trans('admin/categories/create.examples') }}
                        </h3>
                        <div class="space-y-3 text-sm">
                            <div class="p-3 bg-base-200 rounded-lg">
                                <div class="font-semibold text-base-content">{{ trans('admin/categories/create.example_vitamins') }}</div>
                                <div class="text-base-content/60 text-xs mt-1">{{ trans('admin/categories/create.example_vitamins_description') }}</div>
                            </div>
                            <div class="p-3 bg-base-200 rounded-lg">
                                <div class="font-semibold text-base-content">{{ trans('admin/categories/create.example_proteins') }}</div>
                                <div class="text-base-content/60 text-xs mt-1">{{ trans('admin/categories/create.example_proteins_description') }}</div>
                            </div>
                            <div class="p-3 bg-base-200 rounded-lg">
                                <div class="font-semibold text-base-content">{{ trans('admin/categories/create.example_weight_control') }}</div>
                                <div class="text-base-content/60 text-xs mt-1">{{ trans('admin/categories/create.example_weight_control_description') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    @vite(entrypoints: ['resources/js/admin/categories/form.js'])
@endpush
@endsection