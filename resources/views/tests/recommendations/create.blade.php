@extends('layouts.app')

@section('title', 'Recomendaciones con IA')

@section('content')
    <div class="card bg-base-100 shadow">
        <div class="card-body">
            <h2 class="card-title">Completa tu Test</h2>
            <p class="text-base-content/70 mb-2">Cuéntanos sobre ti para recomendarte suplementos adecuados.</p>

            <form id="test-form" method="POST" action="{{ route('tests.recommendations.store') }}" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="label flex items-center gap-2">Contexto
                            <span class="tooltip" data-tip="Área principal de interés (p. ej., Fitness, Nutrición, Rendimiento)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-base-content/70" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 1 1 5.82 1c0 2-3 2-3 4"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                            </span>
                        </label>
                        <input name="context" class="input input-bordered w-full" value="{{ old('context') }}" required>
                        @error('context')<p class="text-error text-sm">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="label flex items-center gap-2">Rutina
                            <span class="tooltip" data-tip="Frecuencia o tipo de entrenamiento (p. ej., 3x full-body, cardio 2x)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-base-content/70" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 1 1 5.82 1c0 2-3 2-3 4"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                            </span>
                        </label>
                        <input name="routine" class="input input-bordered w-full" value="{{ old('routine') }}" required>
                        @error('routine')<p class="text-error text-sm">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="label flex items-center gap-2">Dieta
                            <span class="tooltip" data-tip="Tipo de alimentación (p. ej., Balanceada, Keto, Vegetariana)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-base-content/70" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 1 1 5.82 1c0 2-3 2-3 4"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                            </span>
                        </label>
                        <input name="diet" class="input input-bordered w-full" value="{{ old('diet') }}" required>
                        @error('diet')<p class="text-error text-sm">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="label flex items-center gap-2">Peso (kg)
                            <span class="tooltip" data-tip="Escribe tu peso actual en kilogramos">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-base-content/70" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 1 1 5.82 1c0 2-3 2-3 4"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                            </span>
                        </label>
                        <input name="weight" type="number" class="input input-bordered w-full" value="{{ old('weight') }}" min="1" max="500" required>
                        @error('weight')<p class="text-error text-sm">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="label flex items-center gap-2">Altura (cm)
                            <span class="tooltip" data-tip="Escribe tu altura en centímetros (ej: 175)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-base-content/70" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 1 1 5.82 1c0 2-3 2-3 4"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                            </span>
                        </label>
                        <input name="height" type="number" class="input input-bordered w-full" value="{{ old('height') }}" min="30" max="300" required>
                        @error('height')<p class="text-error text-sm">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div>
                    <label class="label flex items-center gap-2">Objetivos
                        <span class="tooltip" data-tip="Escribe un objetivo por línea (ej.: Ganar masa, Perder grasa)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-base-content/70" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 1 1 5.82 1c0 2-3 2-3 4"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                        </span>
                    </label>
                    <textarea name="goals[]" class="textarea textarea-bordered w-full" rows="3" placeholder="Ej.:&#10;Ganar masa&#10;Perder grasa">{{ old('goals.0') }}</textarea>
                    @error('goals')<p class="text-error text-sm">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="label flex items-center gap-2">Detalles adicionales
                        <span class="tooltip" data-tip="Añade información útil: restricciones, lesiones, horarios. Un dato por línea.">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-base-content/70" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 1 1 5.82 1c0 2-3 2-3 4"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                        </span>
                    </label>
                    <textarea name="responses[]" class="textarea textarea-bordered w-full" rows="3" placeholder="Ej.:&#10;Entreno 3 veces a la semana&#10;Lesión de rodilla pasada&#10;No consumo lactosa">{{ old('responses.0') }}</textarea>
                    @error('responses')<p class="text-error text-sm">{{ $message }}</p>@enderror
                </div>

                <div class="pt-4">
                    <button id="submit-btn" type="submit" class="btn btn-primary">
                        <span class="inline-flex items-center gap-2">
                            <svg id="spinner" class="hidden w-4 h-4 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10" class="opacity-25"/><path d="M4 12a8 8 0 018-8" class="opacity-75"/></svg>
                            <span id="btn-text">Obtener recomendaciones</span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const form = document.getElementById('test-form');
        const btn = document.getElementById('submit-btn');
        const spinner = document.getElementById('spinner');
        const btnText = document.getElementById('btn-text');

        form?.addEventListener('submit', function () {
            btn.setAttribute('disabled', 'disabled');
            spinner.classList.remove('hidden');
            btnText.textContent = 'Generando recomendaciones...';
        });
    </script>
@endpush


