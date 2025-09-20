@extends('layouts.app')

@section('title', 'Suplementos')

@section('content')

<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-base-content mb-2">Catálogo de Suplementos</h1>
        <p class="text-base-content/70 text-lg">Encuentra los mejores suplementos para tu entrenamiento</p>
    </div>

    <!-- Filtros y Búsqueda -->
    <form id="filterForm" method="GET" action="{{ route('supplements.index') }}" class="bg-base-200 rounded-lg p-6 mb-8 shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
            <!-- Búsqueda -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium">Buscar</span>
                </label>
                <input 
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Buscar suplementos..."
                    class="input input-bordered w-full focus:input-primary"
                />
            </div>

            <!-- Categoría -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium">Categoría</span>
                </label>
                <select name="category_id" class="select select-bordered w-full focus:select-primary">
                    <option value="">Todas las categorías</option>
                    @foreach($viewData['categories'] as $category)
                        <option value="{{ $category->getId() }}" {{ request('category_id') == $category->getId() ? 'selected' : '' }}>
                            {{ $category->getName() }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Precio Mínimo -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium">Precio Mínimo</span>
                </label>
                <input 
                    type="number" 
                    name="min_price"
                    value="{{ request('min_price') }}"
                    placeholder="0" 
                    min="0"
                    class="input input-bordered w-full focus:input-primary"
                />
            </div>

            <!-- Precio Máximo -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium">Precio Máximo</span>
                </label>
                <input 
                    type="number" 
                    name="max_price"
                    value="{{ request('max_price') }}"
                    placeholder="100000" 
                    min="0"
                    class="input input-bordered w-full focus:input-primary"
                />
            </div>
        </div>

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <!-- Opciones adicionales -->
            <div class="flex flex-col sm:flex-row gap-4">
                <!-- Solo en stock -->
                <div class="form-control">
                    <label class="cursor-pointer label">
                        <span class="label-text font-medium mr-3">Solo productos disponibles</span>
                        <input 
                            type="checkbox" 
                            name="in_stock" 
                            value="1"
                            {{ request('in_stock') ? 'checked' : '' }}
                            class="checkbox checkbox-primary" 
                        />
                    </label>
                </div>

                <!-- Ordenar por -->
                <div class="form-control min-w-[200px]">
                    <select name="order_by" class="select select-bordered select-sm focus:select-primary">
                        <option value="">Ordenar por</option>
                        <option value="name" {{ request('order_by') == 'name' ? 'selected' : '' }}>
                            Nombre A-Z
                        </option>
                        <option value="price" {{ request('order_by') == 'price' ? 'selected' : '' }}>
                            Precio (menor a mayor)
                        </option>
                        <option value="rating" {{ request('order_by') == 'rating' ? 'selected' : '' }}>
                            Mejor calificados
                        </option>
                    </select>
                </div>

                <!-- Productos por página -->
                <div class="form-control min-w-[150px]">
                    <select name="per_page" class="select select-bordered select-sm focus:select-primary">
                        <option value="8" {{ request('per_page', 8) == 8 ? 'selected' : '' }}>8 por página</option>
                        <option value="16" {{ request('per_page') == 16 ? 'selected' : '' }}>16 por página</option>
                        <option value="32" {{ request('per_page') == 32 ? 'selected' : '' }}>32 por página</option>
                    </select>
                </div>
            </div>

            <!-- Botones -->
            <div class="flex gap-3">
                <button type="submit" class="btn btn-primary px-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Buscar
                </button>
                <a href="{{ route('supplements.index') }}" class="btn btn-ghost px-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Limpiar
                </a>
            </div>
        </div>
    </form>

    <!-- Grid de Productos -->
    @if(count($viewData['supplements']) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            @foreach($viewData['supplements'] as $supplement)
                <div class="card bg-base-100 shadow-lg hover:shadow-xl transition-all duration-300 border border-neutral/20 group">
                    <!-- Imagen del producto -->
                    <figure class="px-4 pt-4 relative">
                        <div class="aspect-square w-full bg-base-200 rounded-lg overflow-hidden relative">
                            @if($supplement->getImagePath())
                                <img 
                                    src="{{ asset('storage/'.$supplement->getImagePath()) }}" 
                                    alt="{{ $supplement->getName() }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                    loading="lazy"
                                />
                            @else
                                <div class="w-full h-full flex items-center justify-center text-base-content/40">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            
                            <!-- Badge de disponibilidad -->
                            <div class="absolute top-2 right-2">
                                @if($supplement->getStock() > 0)
                                    <div class="badge badge-success badge-sm font-medium">
                                        Stock: {{ $supplement->getStock() }}
                                    </div>
                                @else
                                    <div class="badge badge-error badge-sm font-medium">
                                        Agotado
                                    </div>
                                @endif
                            </div>
                        </div>
                    </figure>

                    <div class="card-body p-4">
                        <!-- Header del card -->
                        <div class="mb-3">
                            <h2 class="card-title text-lg font-bold text-base-content line-clamp-2 leading-tight">
                                {{ $supplement->getName() }}
                            </h2>
                            <p class="text-sm text-base-content/70 mt-1">
                                <span class="font-medium">{{ $supplement->getLaboratory() }}</span>
                            </p>
                        </div>

                        <!-- Información del producto -->
                        <div class="space-y-3 mb-4">
                            @if($supplement->getFlavour())
                                <p class="text-sm text-base-content/70">
                                    <span class="font-medium">Sabor:</span> {{ $supplement->getFlavour() }}
                                </p>
                            @endif
                            
                            <!-- Rating -->
                            <div class="flex items-center gap-2">
                                <div class="rating rating-sm">
                                    @for($i = 1; $i <= 5; $i++)
                                        <input type="radio" class="mask mask-star-2 bg-warning pointer-events-none" 
                                               {{ $i <= $supplement->getAverageRating() ? 'checked' : '' }} />
                                    @endfor
                                </div>
                                <span class="text-sm text-base-content/70 font-medium">
                                    {{ number_format($supplement->getAverageRating(), 1) }}
                                </span>
                            </div>

                            <!-- Precio -->
                            <div class="flex items-center justify-between">
                                <p class="text-2xl font-bold text-primary">
                                    ${{ number_format($supplement->getPrice(), 0, ',', '.') }}
                                </p>
                            </div>

                            <!-- Descripción truncada -->
                            <p class="text-sm text-base-content/60 line-clamp-3 leading-relaxed">
                                {{ $supplement->getDescription() }}
                            </p>
                        </div>

                        <!-- Acción -->
                         <!-- {{ route('supplements.show', ['id' => $supplement->getId(), 'page' => 1]) }} -->
                        <div class="card-actions pt-4 border-t border-neutral/20">
                            <a href="{{ route('supplements.show', ['id' => $supplement->getId(), 'page' => 1]) }}" 
                               class="btn btn-primary w-full group-hover:btn-accent transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Ver Detalles
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Información de resultados -->
        <div class="text-center mb-6">
            <p class="text-base-content/70">
                Mostrando {{ count($viewData['supplements']) }} de {{ $viewData['current_page'] * $viewData['per_page'] }} productos
            </p>
        </div>

        <!-- Paginación -->
        @if($viewData['total_pages'] > 1)
            <div class="flex justify-center mt-8">
                <div class="join shadow-lg">
                    <!-- Primera página -->
                    @if($viewData['current_page'] > 1)
                        <a href="{{ request()->fullUrlWithQuery(['page' => 1]) }}" 
                           class="join-item btn btn-sm hover:btn-primary">
                            Primera
                        </a>
                    @else
                        <button class="join-item btn btn-sm btn-disabled">Primera</button>
                    @endif
                    
                    <!-- Página anterior -->
                    @if($viewData['current_page'] > 1)
                        <a href="{{ request()->fullUrlWithQuery(['page' => $viewData['current_page'] - 1]) }}" 
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
                        <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}" 
                           class="join-item btn btn-sm {{ $i == $viewData['current_page'] ? 'btn-active btn-primary' : 'hover:btn-primary' }}">
                            {{ $i }}
                        </a>
                    @endfor

                    <!-- Página siguiente -->
                    @if($viewData['current_page'] < $viewData['total_pages'])
                        <a href="{{ request()->fullUrlWithQuery(['page' => $viewData['current_page'] + 1]) }}" 
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
                        <a href="{{ request()->fullUrlWithQuery(['page' => $viewData['total_pages']]) }}" 
                           class="join-item btn btn-sm hover:btn-primary">
                            Última
                        </a>
                    @else
                        <button class="join-item btn btn-sm btn-disabled">Última</button>
                    @endif
                </div>
            </div>
            
            <div class="text-center mt-4 text-sm text-base-content/60">
                Página {{ $viewData['current_page'] }} de {{ $viewData['total_pages'] }}
            </div>
        @endif
    @else
        <!-- Estado vacío -->
        <div class="text-center py-16">
            <div class="max-w-md mx-auto">
                <div class="mb-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 mx-auto text-base-content/20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-semibold text-base-content mb-4">No se encontraron productos</h3>
                <p class="text-base-content/70 mb-8 leading-relaxed">
                    No encontramos suplementos que coincidan con los filtros seleccionados. 
                    Intenta ajustar los criterios de búsqueda.
                </p>
                <div class="flex gap-3 justify-center">
                    <a href="{{ route('supplements.index') }}" class="btn btn-primary px-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Ver todos los productos
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Animación suave para los hover effects */
.group:hover .group-hover\:scale-105 {
    transform: scale(1.05);
}

.group:hover .group-hover\:btn-accent {
    @apply btn-accent;
}

/* Mejoras visuales para el focus */
.focus\:input-primary:focus {
    @apply input-primary;
}

.focus\:select-primary:focus {
    @apply select-primary;
}
</style>

@endsection