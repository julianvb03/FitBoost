@extends('layouts.app')

@section('title', $viewData['supplement']->getName())

@section('content')

<div class="container mx-auto px-4 py-6">
    <!-- Breadcrumb -->
    <div class="breadcrumbs text-sm mb-6">
        <ul>
            <li><a href="#" class="text-primary hover:text-primary-focus">Inicio</a></li>
            <li><a href="{{ route('supplements.index') }}" class="text-primary hover:text-primary-focus">Suplementos</a></li>
            <li class="text-base-content/70">{{ $viewData['supplement']->getName() }}</li>
        </ul>
    </div>

    <!-- Producto Principal -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
        <!-- Imagen del Producto -->
        <div class="space-y-4">
            <div class="aspect-square w-full bg-base-200 rounded-lg overflow-hidden shadow-lg">
                @if($viewData['supplement']->getImagePath())
                    <img 
                        src="{{ asset('storage/'.$viewData['supplement']->getImagePath()) }}" 
                        alt="{{ $viewData['supplement']->getName() }}"
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                    />
                @else
                    <div class="w-full h-full flex items-center justify-center text-base-content/40">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Badge de Disponibilidad -->
            <div class="flex justify-center">
                @if($viewData['supplement']->getStock() > 0)
                    <div class="badge badge-success badge-lg font-medium px-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Disponible - Stock: {{ $viewData['supplement']->getStock() }}
                    </div>
                @else
                    <div class="badge badge-error badge-lg font-medium px-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Producto Agotado
                    </div>
                @endif
            </div>
        </div>

        <!-- Información del Producto -->
        <div class="space-y-6">
            <!-- Header -->
            <div>
                <h1 class="text-4xl font-bold text-base-content mb-2">{{ $viewData['supplement']->getName() }}</h1>
                <p class="text-lg text-base-content/70">{{ $viewData['supplement']->getLaboratory() }}</p>
            </div>

            <!-- Rating -->
            <div class="flex items-center gap-4">
                <div class="rating rating-lg">
                    @for($i = 1; $i <= 5; $i++)
                        <input type="radio" class="mask mask-star-2 bg-warning pointer-events-none" 
                               {{ $i <= $viewData['averageRating'] ? 'checked' : '' }} />
                    @endfor
                </div>
                <span class="text-lg font-semibold text-base-content">
                    {{ number_format($viewData['averageRating'], 1) }} 
                </span>
                <span class="text-base-content/70">
                    ({{ $viewData['total_reviews'] ?? 0 }} reseñas)
                </span>
            </div>

            <!-- Precio -->
            <div class="bg-base-200 rounded-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-base-content/70 mb-1">Precio</p>
                        <p class="text-4xl font-bold text-primary">
                            ${{ number_format($viewData['supplement']->getPrice(), 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-base-content/70">Por unidad</p>
                        <div class="badge badge-neutral">IVA incluido</div>
                    </div>
                </div>
            </div>

            <!-- Información Adicional -->
            <div class="space-y-4">
                @if($viewData['supplement']->getFlavour())
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                        </svg>
                        <span class="font-medium text-base-content">Sabor:</span>
                        <span class="text-base-content/80">{{ $viewData['supplement']->getFlavour() }}</span>
                    </div>
                @endif

                <!-- Categorías -->
                @if(count($viewData['categories']) > 0)
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/60 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <div>
                            <span class="font-medium text-base-content">Categorías:</span>
                            <div class="flex flex-wrap gap-2 mt-1">
                                @foreach($viewData['categories'] as $category)
                                    <div class="badge badge-primary badge-outline">{{ $category->getName() }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Botón de Acción -->
            <div class="pt-4">
                @if($viewData['supplement']->getStock() > 0)
                    <button class="btn btn-primary btn-lg w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0H17M9 19.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM20.5 19.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                        </svg>
                        Agregar al Carrito
                    </button>
                @else
                    <button class="btn btn-disabled btn-lg w-full" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728" />
                        </svg>
                        Producto No Disponible
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Descripción del Producto -->
    <div class="bg-base-100 rounded-lg shadow-lg p-8 mb-8">
        <h2 class="text-2xl font-bold text-base-content mb-6">Descripción del Producto</h2>
        <div class="prose max-w-none">
            <p class="text-base-content/80 leading-relaxed text-lg">
                {{ $viewData['supplement']->getDescription() }}
            </p>
        </div>
    </div>

    <!-- Sección de Reseñas -->
    <div class="bg-base-100 rounded-lg shadow-lg p-8">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-base-content">
                Reseñas de Clientes
                <span class="text-base-content/60 font-normal text-lg ml-2">
                    ({{ count($viewData['supplement']->reviews) }})
                </span>
            </h2>
            
            <!-- Resumen de Rating -->
            <div class="text-center">
                <div class="text-3xl font-bold text-primary mb-1">
                    {{ number_format($viewData['averageRating'], 1) }}
                </div>
                <div class="rating rating-sm">
                    @for($i = 1; $i <= 5; $i++)
                        <input type="radio" class="mask mask-star-2 bg-warning pointer-events-none" 
                               {{ $i <= $viewData['averageRating'] ? 'checked' : '' }} />
                    @endfor
                </div>
                <div class="text-xs text-base-content/60 mt-1">Promedio</div>
            </div>
        </div>

        @if(count($viewData['reviews']) > 0)
            <!-- Lista de Reseñas -->
            <div class="space-y-6 mb-8">
                @foreach($viewData['reviews'] as $review)
                    <div class="border-b border-neutral/20 pb-6 last:border-b-0 last:pb-0">
                        <div class="flex items-start gap-4">
                            <!-- Avatar -->
                            <div class="avatar placeholder">
                                <div class="bg-neutral text-neutral-content rounded-full w-12 h-12">
                                    <span class="text-sm font-medium">
                                        {{ strtoupper(substr($review->getUserName(), 0, 2)) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Contenido de la reseña -->
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h4 class="font-semibold text-base-content">{{ $review->getUserName() }}</h4>
                                    <div class="rating rating-sm">
                                        @for($i = 1; $i <= 5; $i++)
                                            <input type="radio" class="mask mask-star-2 bg-warning pointer-events-none" 
                                                   {{ $i <= $review->getRating() ? 'checked' : '' }} />
                                        @endfor
                                    </div>
                                    <span class="text-sm text-base-content/60">
                                        {{ $review->getCreatedAt()->diffForHumans() }}
                                    </span>
                                </div>
                                
                                <p class="text-base-content/80 leading-relaxed">
                                    {{ $review->getComment() }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginación de Reseñas -->
            @if($viewData['total_pages'] > 1)
                <div class="flex justify-center pt-6 border-t border-neutral/20">
                    <div class="join shadow">
                        <!-- Primera página -->
                        @if($viewData['current_page'] > 1)
                            <a href="{{ route('supplements.show', ['id' => $viewData['supplement']->getId(), 'page' => 1]) }}" 
                               class="join-item btn btn-sm hover:btn-primary">
                                Primera
                            </a>
                        @else
                            <button class="join-item btn btn-sm btn-disabled">Primera</button>
                        @endif
                        
                        <!-- Página anterior -->
                        @if($viewData['current_page'] > 1)
                            <a href="{{ route('supplements.show', ['id' => $viewData['supplement']->getId(), 'page' => $viewData['current_page'] - 1]) }}" 
                               class="join-item btn btn-sm hover:btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>
                        @else
                            <button class="join-item btn btn-sm btn-disabled">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                        @endif

                        <!-- Números de página -->
                        @for($i = max(1, $viewData['current_page'] - 2); $i <= min($viewData['total_pages'], $viewData['current_page'] + 2); $i++)
                            <a href="{{ route('supplements.show', ['id' => $viewData['supplement']->getId(), 'page' => $i]) }}" 
                               class="join-item btn btn-sm {{ $i == $viewData['current_page'] ? 'btn-active btn-primary' : 'hover:btn-primary' }}">
                                {{ $i }}
                            </a>
                        @endfor

                        <!-- Página siguiente -->
                        @if($viewData['current_page'] < $viewData['total_pages'])
                            <a href="{{ route('supplements.show', ['id' => $viewData['supplement']->getId(), 'page' => $viewData['current_page'] + 1]) }}" 
                               class="join-item btn btn-sm hover:btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @else
                            <button class="join-item btn btn-sm btn-disabled">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        @endif
                        
                        <!-- Última página -->
                        @if($viewData['current_page'] < $viewData['total_pages'])
                            <a href="{{ route('supplements.show', ['id' => $viewData['supplement']->getId(), 'page' => $viewData['total_pages']]) }}" 
                               class="join-item btn btn-sm hover:btn-primary">
                                Última
                            </a>
                        @else
                            <button class="join-item btn btn-sm btn-disabled">Última</button>
                        @endif
                    </div>
                </div>
                
                <div class="text-center mt-4 text-sm text-base-content/60">
                    Mostrando página {{ $viewData['current_page'] }} de {{ $viewData['total_pages'] }} de reseñas
                </div>
            @endif
        @else
            <!-- Estado sin reseñas -->
            <div class="text-center py-12">
                <div class="max-w-sm mx-auto">
                    <div class="mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-base-content/30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-base-content mb-2">Sin reseñas aún</h3>
                    <p class="text-base-content/70 mb-6">
                        Este producto aún no tiene reseñas. ¡Sé el primero en compartir tu experiencia!
                    </p>
                    <button class="btn btn-primary btn-outline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                        Escribir Reseña
                    </button>
                </div>
            </div>
        @endif
    </div>

    <!-- Botón Volver -->
    <div class="flex justify-center mt-8">
        <a href="{{ route('supplements.index') }}" class="btn btn-ghost btn-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Volver al Catálogo
        </a>
    </div>
</div>

<style>
.prose {
    color: inherit;
}

.prose p {
    color: inherit;
}

/* Animaciones suaves */
.hover\:scale-105:hover {
    transform: scale(1.05);
}

/* Mejoras para el rating */
.rating input:checked ~ input,
.rating input[checked="checked"] ~ input {
    --tw-bg-opacity: 0.25;
}
</style>

@endsection