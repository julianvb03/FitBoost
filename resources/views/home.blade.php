@extends('layouts.app')
@section('title', 'FitBoost - Tu aliado en suplementos deportivos')

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
                        Potencia tu rendimiento con <span class="text-primary">FitBoost</span>
                    </h1>
                    <p class="text-xl text-base-content/70 mb-8 max-w-2xl">
                        Descubre los mejores suplementos deportivos, recibe recomendaciones personalizadas y alcanza tus
                        objetivos fitness con productos de calidad premium.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('tests.recommendations.create') }}"
                            class="btn btn-primary btn-lg text-primary-content">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                            Obtener recomendaciones
                        </a>
                        <a href="{{ route('supplements.index') }}"
                            class="btn btn-outline btn-lg border-neutral text-base-content hover:bg-base-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Ver catálogo
                        </a>
                    </div>
                </div>

                <div class="lg:w-80 space-y-4">
                    <div class="bg-base-100 border border-neutral/20 rounded-xl p-6 shadow-lg">
                        <h3 class="text-xl font-semibold text-base-content mb-4">¿Por qué FitBoost?</h3>
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
                                    <div class="font-semibold text-base-content">Calidad Premium</div>
                                    <div class="text-sm text-base-content/70">Productos certificados</div>
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
                                    <div class="font-semibold text-base-content">Envío Rápido</div>
                                    <div class="text-sm text-base-content/70">Entrega en 24-48h</div>
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
                                    <div class="font-semibold text-base-content">Asesoría Personal</div>
                                    <div class="text-sm text-base-content/70">Expertos en nutrición</div>
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
                    ¿Por qué elegir FitBoost?
                </h2>
                <p class="text-xl text-base-content/70 max-w-3xl mx-auto">
                    Ofrecemos una experiencia completa en suplementos deportivos con tecnología avanzada y productos de la
                    más alta calidad.
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
                    <h3 class="text-xl font-bold text-base-content mb-3">Recomendaciones Inteligentes</h3>
                    <p class="text-base-content/70 mb-4">
                        Nuestro sistema de IA analiza tus objetivos, historial y preferencias para sugerirte los suplementos
                        más adecuados.
                    </p>
                    <a href="{{ route('tests.recommendations.create') }}"
                        class="text-primary hover:text-primary/80 font-medium">
                        Obtener recomendaciones →
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
                    <h3 class="text-xl font-bold text-base-content mb-3">Productos Certificados</h3>
                    <p class="text-base-content/70 mb-4">
                        Trabajamos con las mejores marcas y laboratorios para garantizar la calidad y pureza de cada
                        producto.
                    </p>
                    <a href="{{ route('supplements.index') }}" class="text-primary hover:text-primary/80 font-medium">
                        Ver catálogo →
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
                    <h3 class="text-xl font-bold text-base-content mb-3">Asesoría Personalizada</h3>
                    <p class="text-base-content/70 mb-4">
                        Nuestros expertos en nutrición deportiva te acompañan en tu proceso para maximizar tus resultados.
                    </p>
                    <a href="{{ route('users.show', auth()->id()) }}"
                        class="text-primary hover:text-primary/80 font-medium">
                        Mi perfil →
                    </a>
                </div>
            </div>
        </section>

        <section class="relative bg-base-200/50 rounded-2xl p-8 lg:p-12">
            <div class="flex flex-col lg:flex-row lg:items-center gap-8">
                <div class="flex-1">
                    <h2 class="text-4xl lg:text-5xl font-bold text-base-content mb-6">
                        Quiénes somos
                    </h2>
                    <p class="text-lg text-base-content/70 mb-6">
                        En FitBoost, somos apasionados del fitness y la nutrición deportiva. Nuestra misión es ayudarte a
                        alcanzar tus objetivos de manera inteligente y eficiente.
                    </p>
                    <p class="text-base-content/70 mb-8">
                        Con años de experiencia en el sector y un equipo de expertos en nutrición, hemos desarrollado una
                        plataforma que combina tecnología de vanguardia con productos de la más alta calidad para ofrecerte
                        una experiencia única en suplementos deportivos.
                    </p>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary mb-2">500+</div>
                            <div class="text-sm text-base-content/70">Productos Premium</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary mb-2">10K+</div>
                            <div class="text-sm text-base-content/70">Clientes Satisfechos</div>
                        </div>
                    </div>
                </div>
                <div class="lg:w-80">
                    <div class="bg-base-100 border border-neutral/20 rounded-xl p-6 shadow-lg">
                        <h3 class="text-xl font-bold text-base-content mb-4">Nuestros Valores</h3>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3">
                                <div class="w-2 h-2 bg-primary rounded-full"></div>
                                <span class="text-base-content/70">Calidad certificada</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <div class="w-2 h-2 bg-primary rounded-full"></div>
                                <span class="text-base-content/70">Innovación constante</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <div class="w-2 h-2 bg-primary rounded-full"></div>
                                <span class="text-base-content/70">Transparencia total</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <div class="w-2 h-2 bg-primary rounded-full"></div>
                                <span class="text-base-content/70">Soporte experto</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
