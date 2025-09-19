@extends('layouts.app')

@section('title', 'Recomendaciones con IA')

@section('content')
    <div class="card bg-base-100 shadow">
        <div class="card-body">
            <h2 class="card-title">Completa tu Test</h2>
            <form method="POST" action="{{ route('tests.recommendations.store') }}" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="label">Contexto</label>
                        <input name="context" class="input input-bordered w-full" value="{{ old('context') }}">
                        @error('context')<p class="text-error text-sm">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="label">Rutina</label>
                        <input name="routine" class="input input-bordered w-full" value="{{ old('routine') }}">
                        @error('routine')<p class="text-error text-sm">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="label">Dieta</label>
                        <input name="diet" class="input input-bordered w-full" value="{{ old('diet') }}">
                        @error('diet')<p class="text-error text-sm">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="label">Peso (kg)</label>
                        <input name="weight" type="number" class="input input-bordered w-full" value="{{ old('weight') }}">
                        @error('weight')<p class="text-error text-sm">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="label">Altura (cm)</label>
                        <input name="height" type="number" class="input input-bordered w-full" value="{{ old('height') }}">
                        @error('height')<p class="text-error text-sm">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div>
                    <label class="label">Objetivos (uno por línea)</label>
                    <textarea name="goals[]" class="textarea textarea-bordered w-full" rows="3" placeholder="Ganancia muscular, Pérdida de grasa">{{ old('goals.0') }}</textarea>
                    @error('goals')<p class="text-error text-sm">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="label">Respuestas (uno por línea)</label>
                    <textarea name="responses[]" class="textarea textarea-bordered w-full" rows="3">{{ old('responses.0') }}</textarea>
                    @error('responses')<p class="text-error text-sm">{{ $message }}</p>@enderror
                </div>

                <div class="pt-4">
                    <button type="submit" class="btn btn-primary">Obtener recomendaciones</button>
                </div>
            </form>
        </div>
    </div>
@endsection


