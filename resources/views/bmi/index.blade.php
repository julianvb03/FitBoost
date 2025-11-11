@extends('layouts.app')

@section('title', trans('bmi.title'))

@section('content')

    <div class="mx-auto max-w-5xl">
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-primary/10 rounded-full mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="text-primary">
                    <path d="M20 21.004h-4" />
                    <path d="M4 21.004h4" />
                    <path d="M7 9.004v12" />
                    <path d="M17 9.004v12" />
                    <path d="M4 9.004h16l-2-5c-.4-1-1.3-2-2.5-2h-7c-1.2 0-2.1 1-2.5 2z" />
                    <path d="M12 3v2" />
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-base-content mb-3">{{ trans('bmi.title') }}</h1>
            <p class="text-base-content/70 text-lg leading-relaxed max-w-3xl mx-auto">
                {{ trans('bmi.subtitle') }}
            </p>
        </div>

        @if (!empty($viewData['message']))
            <div class="alert {{ $viewData['alert_class'] }} mb-6 shadow-lg">
                <span>{{ $viewData['message'] }}</span>
            </div>
        @endif

        <div class="grid gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <div class="card bg-base-100 border border-neutral/20 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title text-2xl font-semibold mb-3">{{ trans('bmi.form_title') }}</h2>
                        <p class="text-base-content/60 mb-6">{{ trans('bmi.form_description') }}</p>

                        <form method="POST" action="{{ route('bmi.calculate') }}" class="space-y-6">
                            @csrf

                            <div class="grid gap-6 md:grid-cols-2">
                                <div class="form-control">
                                    <label class="label" for="system">
                                        <span class="label-text font-medium">{{ trans('bmi.form_system_label') }}</span>
                                    </label>
                                    <select name="system" id="system" class="select select-bordered"
                                        aria-describedby="system-help">
                                        <option value="metric" @selected(($viewData['selected_system'] ?? 'metric') === 'metric')>
                                            {{ trans('bmi.metric_option') }}
                                        </option>
                                        <option value="imperial" @selected(($viewData['selected_system'] ?? 'metric') === 'imperial')>
                                            {{ trans('bmi.imperial_option') }}
                                        </option>
                                    </select>
                                    <label id="system-help" class="label-text-alt mt-2 text-base-content/60">
                                        {{ trans('bmi.form_system_help') }}
                                    </label>
                                    @error('system')
                                        <span class="text-error text-sm mt-2">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-control">
                                    <label class="label" for="weight">
                                        <span class="label-text font-medium">{{ trans('bmi.form_weight_label', ['unit' => (($viewData['selected_system'] ?? 'metric') === 'imperial') ? 'lb' : 'kg']) }}</span>
                                    </label>
                                    <input type="number" name="weight" id="weight" step="0.1" min="1"
                                        value="{{ $viewData['weight_value'] ?? '' }}" class="input input-bordered"
                                        placeholder="{{ ($viewData['selected_system'] ?? 'metric') === 'imperial' ? '160' : '70' }}" />
                                    <span class="label-text-alt mt-2 text-base-content/60">
                                        {{ trans('bmi.form_weight_help', ['unit' => (($viewData['selected_system'] ?? 'metric') === 'imperial') ? 'lb' : 'kg']) }}
                                    </span>
                                    @error('weight')
                                        <span class="text-error text-sm mt-2">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-control">
                                    <label class="label" for="height">
                                        <span class="label-text font-medium">{{ trans('bmi.form_height_label', ['unit' => (($viewData['selected_system'] ?? 'metric') === 'imperial') ? 'in' : 'cm']) }}</span>
                                    </label>
                                    <input type="number" name="height" id="height" step="0.1" min="1"
                                        value="{{ $viewData['height_value'] ?? '' }}" class="input input-bordered"
                                        placeholder="{{ ($viewData['selected_system'] ?? 'metric') === 'imperial' ? '68' : '170' }}" />
                                    <span class="label-text-alt mt-2 text-base-content/60">
                                        {{ trans('bmi.form_height_help', ['unit' => (($viewData['selected_system'] ?? 'metric') === 'imperial') ? 'in' : 'cm']) }}
                                    </span>
                                    @error('height')
                                        <span class="text-error text-sm mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-actions justify-end">
                                <button type="submit" class="btn btn-primary px-8">
                                    {{ trans('bmi.form_submit') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="card bg-base-100 border border-neutral/20 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title text-2xl font-semibold mb-4">{{ trans('bmi.result_title') }}</h2>

                        @if (!empty($viewData['result']))
                            <div class="space-y-4">
                                <div class="rounded-lg bg-primary/10 p-4 text-primary">
                                    <p class="text-sm font-medium uppercase tracking-wide">
                                        {{ trans('bmi.result_bmi') }}
                                    </p>
                                    <p class="text-4xl font-bold">
                                        {{ number_format((float) ($viewData['result']['bmi'] ?? 0), 1) }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm text-base-content/60 uppercase tracking-wide">
                                        {{ trans('bmi.result_health') }}
                                    </p>
                                    <p class="text-lg font-semibold text-base-content">
                                        {{ $viewData['result']['category'] ?? '' }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-sm text-base-content/60 uppercase tracking-wide">
                                        {{ trans('bmi.result_range') }}
                                    </p>
                                    <p class="text-lg font-medium text-base-content">
                                        {{ $viewData['result']['healthy_range'] ?? '' }}
                                    </p>
                                </div>

                                <div class="alert alert-neutral">
                                    <span>{{ trans('bmi.result_source.' . ($viewData['result_source_key'] ?? 'local')) }}</span>
                                </div>
                            </div>
                        @else
                            <p class="text-base-content/60 leading-relaxed">
                                {{ trans('bmi.result_placeholder') }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 border border-neutral/20 shadow-xl mt-10">
            <div class="card-body">
                <h2 class="card-title text-2xl font-semibold mb-4">{{ trans('bmi.table_title') }}</h2>
                <p class="text-base-content/60 mb-6">{{ trans('bmi.table_description') }}</p>

                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr class="text-base-content/70">
                                <th>{{ trans('bmi.table_category') }}</th>
                                <th>{{ trans('bmi.table_range') }}</th>
                                <th>{{ trans('bmi.table_notes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ trans('bmi.categories.underweight') }}</td>
                                <td>&lt; 18.5</td>
                                <td>{{ trans('bmi.notes.underweight') }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('bmi.categories.normal') }}</td>
                                <td>18.5 - 24.9</td>
                                <td>{{ trans('bmi.notes.normal') }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('bmi.categories.overweight') }}</td>
                                <td>25 - 29.9</td>
                                <td>{{ trans('bmi.notes.overweight') }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('bmi.categories.obesity_class_1') }}</td>
                                <td>30 - 34.9</td>
                                <td>{{ trans('bmi.notes.obesity_class_1') }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('bmi.categories.obesity_class_2') }}</td>
                                <td>35 - 39.9</td>
                                <td>{{ trans('bmi.notes.obesity_class_2') }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('bmi.categories.obesity_class_3') }}</td>
                                <td>&ge; 40</td>
                                <td>{{ trans('bmi.notes.obesity_class_3') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
