@extends('layouts.app')
@section('title', 'Inicio')

@section('content')
    <div class="space-y-16">
        {{-- Sección 1: Bienestar real con recomendaciones de IA --}}
        <section class="relative">
            <div class="flex flex-col lg:flex-row lg:items-start gap-8">
                {{-- Contenido principal --}}
                <div class="flex-1">
                    <h1 class="text-4xl lg:text-5xl font-bold text-base-content mb-6">
                        Bienestar real con recomendaciones de IA
                    </h1>
                    <p class="text-lg text-base-content/70 mb-8 max-w-2xl">
                        Cuéntanos tu objetivo y condición: nuestra IA sugiere suplementos y hábitos con planes de consumo,
                        recetas y recordatorios.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button class="btn btn-primary btn-lg text-primary-content">
                            Hacer evaluación
                        </button>
                        <button class="btn btn-outline btn-lg border-neutral text-base-content hover:bg-base-200">
                            Ver catálogo
                        </button>
                    </div>
                </div>

                {{-- Panel "Tu snapshot" --}}
                <div class="lg:w-80 space-y-4">
                    <h3 class="text-xl font-semibold text-base-content mb-4">Tu snapshot</h3>

                    {{-- Card Meta --}}
                    <div class="bg-base-300 rounded-lg p-4">
                        <div class="text-sm text-base-content/70 mb-2">Meta</div>
                        <div class="text-lg font-bold text-base-content mb-2">Energía diaria</div>
                        <div class="text-sm text-base-content/70">Plan IA: Omega 3 + Vitaminas + Greens</div>
                    </div>

                    {{-- Card Hábitos --}}
                    <div class="bg-base-300 rounded-lg p-4">
                        <div class="text-sm text-base-content/70 mb-2">Hábitos</div>
                        <div class="text-lg font-bold text-base-content mb-2">Agua 2.3 L</div>
                        <div class="text-sm text-base-content/70">Sueño objetivo 8 h</div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Sección 2: Recomendador con IA --}}
        <section class="relative">
            <div class="flex flex-col lg:flex-row lg:items-start gap-8">
                {{-- Contenido principal --}}
                <div class="flex-1">
                    <h2 class="text-4xl lg:text-5xl font-bold text-base-content mb-6">
                        Recomendador con IA
                    </h2>
                    <p class="text-lg text-base-content/70 mb-6 max-w-2xl">
                        Evaluamos objetivo, historial, alergias, preferencias (vegano, sin lactosa) y presupuesto. Te
                        entregamos un plan claro y flexible.
                    </p>

                    {{-- Lista de características --}}
                    <ul class="space-y-2 mb-8 text-base-content/70">
                        <li class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-primary rounded-full"></div>
                            Metas: pérdida de grasa, bienestar, energía, fuerza
                        </li>
                        <li class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-primary rounded-full"></div>
                            Plan de consumo + calendario
                        </li>
                        <li class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-primary rounded-full"></div>
                            Ajustes automáticos con tu progreso
                        </li>
                    </ul>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <button class="btn btn-primary btn-lg text-primary-content">
                            Generar recomendaciones
                        </button>
                        <button class="btn btn-outline btn-lg border-neutral text-base-content hover:bg-base-200">
                            Ver planes
                        </button>
                    </div>
                </div>

                {{-- Panel "Pack ejemplo" --}}
                <div class="lg:w-80">
                    <div class="bg-base-300 rounded-lg p-6">
                        <h3 class="text-lg font-bold text-base-content mb-4">Pack ejemplo (Bienestar)</h3>
                        <ul class="space-y-3 text-base-content/70">
                            <li class="flex items-center gap-2">
                                <div class="w-2 h-2 bg-primary rounded-full"></div>
                                Omega 3 — 2 cáps./día
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-2 h-2 bg-primary rounded-full"></div>
                                Multivitamínico — 1 al día
                            </li>
                            <li class="flex items-center gap-2">
                                <div class="w-2 h-2 bg-primary rounded-full"></div>
                                Greens — 1 scoop en la mañana
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- Sección 3: Recomendados por IA para ti --}}
        <section id="products">
            <h2 class="text-4xl lg:text-5xl font-bold text-base-content mb-8">
                Recomendados por IA para ti
            </h2>

            {{-- Grid de productos --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Producto 1: Omega 3 Ultra --}}
                <div class="bg-base-300 rounded-lg p-6">
                    <div class="text-sm text-base-content/70 mb-2">Bienestar</div>
                    <h3 class="text-xl font-bold text-base-content mb-2">Omega 3 Ultra</h3>
                    <p class="text-base-content/70 mb-4">EPA/DHA alta pureza.</p>
                    <div class="text-2xl font-bold text-base-content mb-4">$ 69.900</div>
                    <div class="flex gap-3">
                        <button class="btn btn-primary flex-1 text-primary-content">
                            Agregar
                        </button>
                        <button class="btn btn-outline border-neutral text-base-content hover:bg-base-200">
                            Detalles
                        </button>
                    </div>
                </div>

                {{-- Producto 2: Multivitamínico Daily --}}
                <div class="bg-base-300 rounded-lg p-6">
                    <div class="text-sm text-base-content/70 mb-2">Vitaminas</div>
                    <h3 class="text-xl font-bold text-base-content mb-2">Multivitamínico Daily</h3>
                    <p class="text-base-content/70 mb-4">Micronutrientes esenciales.</p>
                    <div class="text-2xl font-bold text-base-content mb-4">$ 59.900</div>
                    <div class="flex gap-3">
                        <button class="btn btn-primary flex-1 text-primary-content">
                            Agregar
                        </button>
                        <button class="btn btn-outline border-neutral text-base-content hover:bg-base-200">
                            Detalles
                        </button>
                    </div>
                </div>

                {{-- Producto 3: Green Superfoods --}}
                <div class="bg-base-300 rounded-lg p-6">
                    <div class="text-sm text-base-content/70 mb-2">Greens</div>
                    <h3 class="text-xl font-bold text-base-content mb-2">Green Superfoods</h3>
                    <p class="text-base-content/70 mb-4">Mezcla de vegetales y probióticos.</p>
                    <div class="text-2xl font-bold text-base-content mb-4">$ 89.900</div>
                    <div class="flex gap-3">
                        <button class="btn btn-primary flex-1 text-primary-content">
                            Agregar
                        </button>
                        <button class="btn btn-outline border-neutral text-base-content hover:bg-base-200">
                            Detalles
                        </button>
                    </div>
                </div>
            </div>

            {{-- Botón para ver más --}}
            <div class="text-center mt-8">
                <button class="btn btn-outline border-neutral text-base-content hover:bg-base-200">
                    Ver más productos
                </button>
            </div>
        </section>
    </div>
@endsection
