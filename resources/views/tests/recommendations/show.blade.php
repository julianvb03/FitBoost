@extends('layouts.app')

@section('title', trans('tests/recommendations/show.title'))

@section('content')
    <div class="space-y-6">
        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <h2 class="card-title">{{ trans('tests/recommendations/show.your_recommendations') }}</h2>
                @if (isset($viewData['explanation']))
                    <p class="text-base-content/80">{{ $viewData['explanation'] }}</p>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            @forelse ($viewData['supplements'] as $s)
                <div class="card bg-base-100 shadow">
                    <div class="card-body">
                        <h3 class="card-title">{{ $s->getName() }}</h3>
                        <p class="text-base-content/80">{{ trans('tests/recommendations/show.flavor') }}: {{ $s->getFlavour() }}</p>
                        <p class="text-base-content/80">{{ trans('tests/recommendations/show.price') }}: {{ $s->getPrice() }}</p>
                        <p class="text-base-content/80">{{ trans('tests/recommendations/show.stock') }}: {{ $s->getStock() }}</p>
                    </div>
                </div>
            @empty
                <p>{{ trans('tests/recommendations/show.no_recommendations') }}</p>
            @endforelse
        </div>

        <div>
            <a href="{{ route('tests.recommendations.create') }}" class="btn">{{ trans('tests/recommendations/show.new_evaluation') }}</a>
        </div>
    </div>
@endsection


