@extends('layouts.app')

@section('title', 'Recomendaciones con IA')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-primary/5 via-base-100 to-secondary/5 py-8 rounded-lg">
        <div class="container mx-auto px-4 max-w-4xl">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-primary/10 rounded-full mb-4">
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-primary" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <path d="M9 12l2 2 4-4" />
                        <path d="M21 12c-1 0-3-1-3-3s2-3 3-3 3 1 3 3-2 3-3 3" />
                        <path d="M3 12c1 0 3-1 3-3s-2-3-3-3-3 1-3 3 2 3 3 3" />
                        <path d="M13 12h3a2 2 0 0 1 2 2v1" />
                        <path d="M6 12H3a2 2 0 0 0-2 2v1" />
                    </svg> --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" class="w-8 h-8 text-primary" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-dna-icon lucide-dna">
                        <path d="m10 16 1.5 1.5" />
                        <path d="m14 8-1.5-1.5" />
                        <path d="M15 2c-1.798 1.998-2.518 3.995-2.807 5.993" />
                        <path d="m16.5 10.5 1 1" />
                        <path d="m17 6-2.891-2.891" />
                        <path d="M2 15c6.667-6 13.333 0 20-6" />
                        <path d="m20 9 .891.891" />
                        <path d="M3.109 14.109 4 15" />
                        <path d="m6.5 12.5 1 1" />
                        <path d="m7 18 2.891 2.891" />
                        <path d="M9 22c1.798-1.998 2.518-3.995 2.807-5.993" />
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-base-content mb-3">Test de Recomendaciones IA</h1>
                <p class="text-lg text-base-content/70 max-w-2xl mx-auto">
                    Cuéntanos sobre tu estilo de vida y objetivos para obtener recomendaciones personalizadas de suplementos
                </p>
            </div>

            <!-- Main Form Card -->
            <div class="card bg-base-100 shadow-2xl border border-base-300/50 backdrop-blur-sm">
                <div class="card-body p-8">
                    <form id="test-form" method="POST" action="{{ route('tests.recommendations.store') }}"
                        class="space-y-8">
                        @csrf

                        <!-- Personal Information Section -->
                        <div class="space-y-6">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-1 h-8 bg-primary rounded-full"></div>
                                <h2 class="text-2xl font-semibold text-base-content">Información Personal</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="form-control group">
                                    <label class="label flex items-center gap-2 mb-2">
                                        <span class="font-medium text-base-content">Contexto</span>
                                        <span class="tooltip tooltip-right"
                                            data-tip="Área principal de interés (p. ej., Fitness, Nutrición, Rendimiento)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                class="w-4 h-4 text-base-content/60 hover:text-primary transition-colors"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-circle-question-mark-icon lucide-circle-question-mark">
                                                <circle cx="12" cy="12" r="10" />
                                                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                                                <path d="M12 17h.01" />
                                            </svg>
                                        </span>
                                    </label>
                                    <input name="context"
                                        class="input input-bordered w-full transition-all duration-200 focus:input-primary focus:shadow-lg focus:scale-[1.02] group-hover:border-primary/50"
                                        value="{{ old('context') }}" placeholder="Ej: Fitness, Nutrición, Rendimiento"
                                        required>
                                    @error('context')
                                        <div class="flex items-center gap-2 mt-2 text-error">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor">
                                                <circle cx="12" cy="12" r="10" />
                                                <path d="M15 9l-6 6" />
                                                <path d="M9 9l6 6" />
                                            </svg>
                                            <span class="text-sm">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-control group">
                                    <label class="label flex items-center gap-2 mb-2">
                                        <span class="font-medium text-base-content">Rutina</span>
                                        <span class="tooltip tooltip-right"
                                            data-tip="Frecuencia o tipo de entrenamiento (p. ej., 3x full-body, cardio 2x)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                class="w-4 h-4 text-base-content/60 hover:text-primary transition-colors"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-circle-question-mark-icon lucide-circle-question-mark">
                                                <circle cx="12" cy="12" r="10" />
                                                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                                                <path d="M12 17h.01" />
                                            </svg>
                                        </span>
                                    </label>
                                    <input name="routine"
                                        class="input input-bordered w-full transition-all duration-200 focus:input-primary focus:shadow-lg focus:scale-[1.02] group-hover:border-primary/50"
                                        value="{{ old('routine') }}" placeholder="Ej: 3x full-body, cardio 2x" required>
                                    @error('routine')
                                        <div class="flex items-center gap-2 mt-2 text-error">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor">
                                                <circle cx="12" cy="12" r="10" />
                                                <path d="M15 9l-6 6" />
                                                <path d="M9 9l6 6" />
                                            </svg>
                                            <span class="text-sm">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-control group">
                                    <label class="label flex items-center gap-2 mb-2">
                                        <span class="font-medium text-base-content">Dieta</span>
                                        <span class="tooltip tooltip-right"
                                            data-tip="Tipo de alimentación (p. ej., Balanceada, Keto, Vegetariana)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                class="w-4 h-4 text-base-content/60 hover:text-primary transition-colors"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-circle-question-mark-icon lucide-circle-question-mark">
                                                <circle cx="12" cy="12" r="10" />
                                                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                                                <path d="M12 17h.01" />
                                            </svg>
                                        </span>
                                    </label>
                                    <input name="diet"
                                        class="input input-bordered w-full transition-all duration-200 focus:input-primary focus:shadow-lg focus:scale-[1.02] group-hover:border-primary/50"
                                        value="{{ old('diet') }}" placeholder="Ej: Balanceada, Keto, Vegetariana"
                                        required>
                                    @error('diet')
                                        <div class="flex items-center gap-2 mt-2 text-error">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor">
                                                <circle cx="12" cy="12" r="10" />
                                                <path d="M15 9l-6 6" />
                                                <path d="M9 9l6 6" />
                                            </svg>
                                            <span class="text-sm">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-control group">
                                    <label class="label flex items-center gap-2 mb-2">
                                        <span class="font-medium text-base-content">Peso (kg)</span>
                                        <span class="tooltip tooltip-right"
                                            data-tip="Escribe tu peso actual en kilogramos">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                class="w-4 h-4 text-base-content/60 hover:text-primary transition-colors"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-circle-question-mark-icon lucide-circle-question-mark">
                                                <circle cx="12" cy="12" r="10" />
                                                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                                                <path d="M12 17h.01" />
                                            </svg>
                                        </span>
                                    </label>
                                    <input name="weight" type="number"
                                        class="input input-bordered w-full transition-all duration-200 focus:input-primary focus:shadow-lg focus:scale-[1.02] group-hover:border-primary/50"
                                        value="{{ old('weight') }}" min="1" max="500" placeholder="Ej: 70"
                                        required>
                                    @error('weight')
                                        <div class="flex items-center gap-2 mt-2 text-error">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor">
                                                <circle cx="12" cy="12" r="10" />
                                                <path d="M15 9l-6 6" />
                                                <path d="M9 9l6 6" />
                                            </svg>
                                            <span class="text-sm">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-control group">
                                    <label class="label flex items-center gap-2 mb-2">
                                        <span class="font-medium text-base-content">Altura (cm)</span>
                                        <span class="tooltip tooltip-right"
                                            data-tip="Escribe tu altura en centímetros (ej: 175)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                class="w-4 h-4 text-base-content/60 hover:text-primary transition-colors"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-circle-question-mark-icon lucide-circle-question-mark">
                                                <circle cx="12" cy="12" r="10" />
                                                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                                                <path d="M12 17h.01" />
                                            </svg>
                                        </span>
                                    </label>
                                    <input name="height" type="number"
                                        class="input input-bordered w-full transition-all duration-200 focus:input-primary focus:shadow-lg focus:scale-[1.02] group-hover:border-primary/50"
                                        value="{{ old('height') }}" min="30" max="300" placeholder="Ej: 175"
                                        required>
                                    @error('height')
                                        <div class="flex items-center gap-2 mt-2 text-error">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor">
                                                <circle cx="12" cy="12" r="10" />
                                                <path d="M15 9l-6 6" />
                                                <path d="M9 9l6 6" />
                                            </svg>
                                            <span class="text-sm">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Goals Section -->
                        <div class="space-y-6">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-1 h-8 bg-secondary rounded-full"></div>
                                <h2 class="text-2xl font-semibold text-base-content">Objetivos</h2>
                            </div>

                            <div class="form-control group">
                                <label class="label flex items-center gap-2 mb-2">
                                    <span class="font-medium text-base-content">¿Cuáles son tus objetivos?</span>
                                    <span class="tooltip tooltip-right"
                                        data-tip="Escribe un objetivo por línea (ej.: Ganar masa, Perder grasa)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            class="w-4 h-4 text-base-content/60 hover:text-primary transition-colors"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-circle-question-mark-icon lucide-circle-question-mark">
                                            <circle cx="12" cy="12" r="10" />
                                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                                            <path d="M12 17h.01" />
                                        </svg>
                                    </span>
                                </label>
                                <textarea name="goals[]"
                                    class="textarea textarea-bordered w-full transition-all duration-200 focus:textarea-secondary focus:shadow-lg focus:scale-[1.01] group-hover:border-secondary/50 resize-none"
                                    rows="4"
                                    placeholder="Ej.:&#10;Ganar masa muscular&#10;Perder grasa&#10;Mejorar resistencia&#10;Aumentar fuerza">{{ old('goals.0') }}</textarea>
                                @error('goals')
                                    <div class="flex items-center gap-2 mt-2 text-error">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor">
                                            <circle cx="12" cy="12" r="10" />
                                            <path d="M15 9l-6 6" />
                                            <path d="M9 9l6 6" />
                                        </svg>
                                        <span class="text-sm">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Additional Details Section -->
                        <div class="space-y-6">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-1 h-8 bg-accent rounded-full"></div>
                                <h2 class="text-2xl font-semibold text-base-content">Detalles Adicionales</h2>
                            </div>

                            <div class="form-control group">
                                <label class="label flex items-center gap-2 mb-2">
                                    <span class="font-medium text-base-content">Información adicional</span>
                                    <span class="tooltip tooltip-right"
                                        data-tip="Añade información útil: restricciones, lesiones, horarios. Un dato por línea.">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            class="w-4 h-4 text-base-content/60 hover:text-primary transition-colors"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-circle-question-mark-icon lucide-circle-question-mark">
                                            <circle cx="12" cy="12" r="10" />
                                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                                            <path d="M12 17h.01" />
                                        </svg>
                                    </span>
                                </label>
                                <textarea name="responses[]"
                                    class="textarea textarea-bordered w-full transition-all duration-200 focus:textarea-accent focus:shadow-lg focus:scale-[1.01] group-hover:border-accent/50 resize-none"
                                    rows="4"
                                    placeholder="Ej.:&#10;Entreno 3 veces a la semana&#10;Lesión de rodilla pasada&#10;No consumo lactosa&#10;Horario de trabajo nocturno">{{ old('responses.0') }}</textarea>
                                @error('responses')
                                    <div class="flex items-center gap-2 mt-2 text-error">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor">
                                            <circle cx="12" cy="12" r="10" />
                                            <path d="M15 9l-6 6" />
                                            <path d="M9 9l6 6" />
                                        </svg>
                                        <span class="text-sm">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-8 border-t border-base-300/50">
                            <button id="submit-btn" type="submit"
                                class="btn btn-primary btn-lg w-full group relative overflow-hidden">
                                <span
                                    class="absolute inset-0 bg-gradient-to-r from-primary to-primary/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                                <span class="relative z-10 flex items-center justify-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-send-icon lucide-send">
                                        <path
                                            d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z" />
                                        <path d="m21.854 2.147-10.94 10.939" />
                                    </svg>
                                    <span id="btn-text" class="font-semibold">Obtener Recomendaciones IA</span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const form = document.getElementById('test-form');
        const btn = document.getElementById('submit-btn');
        const spinner = document.getElementById('spinner');
        const btnText = document.getElementById('btn-text');
        const aiIcon = document.getElementById('ai-icon');

        // Enhanced form submission with better UX
        form?.addEventListener('submit', function(e) {
            // Prevent double submission
            if (btn.hasAttribute('disabled')) {
                e.preventDefault();
                return;
            }

            // Disable button and show loading state
            btn.setAttribute('disabled', 'disabled');
            btn.classList.add('loading');
            spinner.classList.remove('hidden');
            aiIcon.classList.add('hidden');
            btnText.textContent = 'Generando recomendaciones...';

            // Add a subtle pulse animation to the form
            form.classList.add('animate-pulse');
        });

        // Add character count for textareas
        document.querySelectorAll('textarea').forEach(textarea => {
            const maxLength = 500;
            const counter = document.createElement('div');
            counter.className = 'text-xs text-base-content/60 mt-1 text-right';
            counter.textContent = `0/${maxLength}`;
            textarea.parentElement.appendChild(counter);

            textarea.addEventListener('input', function() {
                const length = this.value.length;
                counter.textContent = `${length}/${maxLength}`;

                if (length > maxLength * 0.9) {
                    counter.classList.add('text-warning');
                } else {
                    counter.classList.remove('text-warning');
                }
            });
        });
    </script>
@endpush
