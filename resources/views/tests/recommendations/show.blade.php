@extends('layouts.app')

@section('title', 'Resultados de Recomendación')

@section('content')
    <div class="space-y-6">
        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <h2 class="card-title">Tus recomendaciones</h2>
                @if ($explanation)
                    <p class="text-base-content/80">{{ $explanation }}</p>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            @forelse ($supplements as $s)
                <div class="card bg-base-100 shadow">
                    <div class="card-body">
                        <h3 class="card-title">{{ $s->getName() }}</h3>
                        <p class="text-base-content/80">Sabor: {{ $s->getFlavour() }}</p>
                        <p class="text-base-content/80">Precio: {{ $s->getPrice() }}</p>
                        <p class="text-base-content/80">Stock: {{ $s->getStock() }}</p>
                    </div>
                </div>
            @empty
                <p>No hay recomendaciones disponibles.</p>
            @endforelse
        </div>

        <div>
            <a href="{{ route('tests.recommendations.create') }}" class="btn">Nueva evaluación</a>
        </div>
    </div>
@endsection


