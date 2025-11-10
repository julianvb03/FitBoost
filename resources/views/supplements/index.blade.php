@extends('layouts.app')

@section('title', 'Suplementos')

@section('content')

    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-primary/10 rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    class="w-8 h-8 text-primary" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-glass-water-icon lucide-glass-water">
                    <path
                        d="M5.116 4.104A1 1 0 0 1 6.11 3h11.78a1 1 0 0 1 .994 1.105L17.19 20.21A2 2 0 0 1 15.2 22H8.8a2 2 0 0 1-2-1.79z" />
                    <path d="M6 12a5 5 0 0 1 6 0 5 5 0 0 0 6 0" />
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-base-content mb-2">Catálogo de Suplementos</h1>
            <p class="text-base-content/70 text-lg">Encuentra los mejores suplementos para tu entrenamiento</p>
        </div>

        <!-- Filters and Search -->
        <form id="filterForm" method="GET" action="{{ route('supplements.index') }}"
            class="card bg-base-100 border border-neutral/20 rounded-xl p-6 mb-6 shadow">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                <!-- Search -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Buscar</span>
                    </label>
                    <input name="search" value="{{ request('search') }}" placeholder="Buscar suplementos..."
                        class="input input-bordered w-full focus:input-primary" />
                </div>

                <!-- Category -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Categoría</span>
                    </label>
                    <select name="category_id" class="select select-bordered w-full focus:select-primary">
                        <option value="">Todas las categorías</option>
                        @foreach ($viewData['categories'] as $category)
                            <option value="{{ $category->getId() }}"
                                {{ request('category_id') == $category->getId() ? 'selected' : '' }}>
                                {{ $category->getName() }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Minimum Price -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Precio Mínimo</span>
                    </label>
                    <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="0" min="0"
                        class="input input-bordered w-full focus:input-primary" />
                </div>

                <!-- Maximum Price -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Precio Máximo</span>
                    </label>
                    <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="100000"
                        min="0" class="input input-bordered w-full focus:input-primary" />
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <!-- Additional Options -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <!-- Only in stock -->
                    <div class="form-control">
                        <label class="cursor-pointer label">
                            <span class="label-text font-medium mr-3">Solo productos disponibles</span>
                            <input type="checkbox" name="in_stock" value="1" {{ request('in_stock') ? 'checked' : '' }}
                                class="checkbox checkbox-primary" />
                        </label>
                    </div>

                    <!-- Order by -->
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

                    <!-- Products per page -->
                    <div class="form-control min-w-[150px]">
                        <select name="per_page" class="select select-bordered select-sm focus:select-primary">
                            <option value="8" {{ request('per_page', 8) == 8 ? 'selected' : '' }}>8 por página
                            </option>
                            <option value="16" {{ request('per_page') == 16 ? 'selected' : '' }}>16 por página</option>
                            <option value="32" {{ request('per_page') == 32 ? 'selected' : '' }}>32 por página</option>
                        </select>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3">
                    <button type="submit" class="btn btn-primary px-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Buscar
                    </button>
                    <a href="{{ route('supplements.index') }}" class="btn btn-ghost px-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Limpiar
                    </a>
                </div>
            </div>
        </form>

        <!-- Active filters -->
        @if (! empty($viewData['has_filters']))
            <div class="flex flex-wrap items-center gap-2 mb-6">
                <span class="text-sm text-base-content/70 mr-1">Filtros activos:</span>
                @if (request('search'))
                    <a href="{{ route('supplements.index', request()->except('search')) }}" class="chip">Buscar:
                        "{{ request('search') }}" <span>&times;</span></a>
                @endif
                @if (request('category_id'))
                    <a href="{{ route('supplements.index', request()->except('category_id')) }}" class="chip">Categoría
                        <span>&times;</span></a>
                @endif
                @if (request('min_price'))
                    <a href="{{ route('supplements.index', request()->except('min_price')) }}" class="chip">Min:
                        ${{ number_format(request('min_price'), 0, ',', '.') }} <span>&times;</span></a>
                @endif
                @if (request('max_price'))
                    <a href="{{ route('supplements.index', request()->except('max_price')) }}" class="chip">Max:
                        ${{ number_format(request('max_price'), 0, ',', '.') }} <span>&times;</span></a>
                @endif
                @if (request('in_stock'))
                    <a href="{{ route('supplements.index', request()->except('in_stock')) }}" class="chip">En stock
                        <span>&times;</span></a>
                @endif
                @if (request('order_by'))
                    <a href="{{ route('supplements.index', request()->except('order_by')) }}" class="chip">Orden:
                        {{ ucfirst(request('order_by')) }} <span>&times;</span></a>
                @endif
                @if (request('per_page'))
                    <a href="{{ route('supplements.index', request()->except('per_page')) }}" class="chip">Por página:
                        {{ request('per_page') }} <span>&times;</span></a>
                @endif
                <a href="{{ route('supplements.index') }}" class="btn btn-ghost btn-xs ml-1">Quitar todos</a>
            </div>
        @endif

        <!-- Grid of Products -->
        @if (count($viewData['supplements']) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                @foreach ($viewData['supplements'] as $supplement)
                    <div
                        class="card bg-base-100 shadow-lg hover:shadow-2xl transition-all duration-300 border border-neutral/20 group">
                        <!-- Product Image -->
                        <figure class="px-4 pt-4 relative">
                            <div class="aspect-square w-full bg-base-200 rounded-lg overflow-hidden relative">
                                @if ($supplement->getImagePath())
                                    <img src="{{ asset('storage/' . $supplement->getImagePath()) }}"
                                        alt="{{ $supplement->getName() }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                        loading="lazy" />
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-base-content/40">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif

                                <!-- Availability Badge -->
                                <div class="absolute top-2 right-2">
                                    @if ($supplement->getStock() > 0)
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
                            <!-- Header of the card -->
                            <div class="mb-3">
                                <h2 class="card-title text-lg font-bold text-base-content line-clamp-2 leading-tight">
                                    {{ $supplement->getName() }}
                                </h2>
                                <p class="text-sm text-base-content/70 mt-1">
                                    <span class="font-medium">{{ $supplement->getLaboratory() }}</span>
                                </p>
                            </div>

                            <!-- Product Information -->
                            <div class="space-y-3 mb-4">
                                @if ($supplement->getFlavour())
                                    <p class="text-sm text-base-content/70">
                                        <span class="font-medium">Sabor:</span> {{ $supplement->getFlavour() }}
                                    </p>
                                @endif

                                <!-- Rating -->
                                <div class="flex items-center gap-2">
                                    <div class="rating rating-sm">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <input type="radio" class="mask mask-star-2 bg-warning pointer-events-none"
                                                {{ $i <= $supplement->getAverageRating() ? 'checked' : '' }} />
                                        @endfor
                                    </div>
                                    <span class="text-sm text-base-content/70 font-medium">
                                        {{ number_format($supplement->getAverageRating(), 1) }}
                                    </span>
                                </div>

                                <!-- Price -->
                                <div class="flex items-center justify-between">
                                    <p class="text-2xl font-bold text-primary">
                                        ${{ number_format($supplement->getPrice(), 0, ',', '.') }}
                                    </p>
                                </div>

                                <!-- Truncated Description -->
                                <p class="text-sm text-base-content/60 line-clamp-3 leading-relaxed">
                                    {{ $supplement->getDescription() }}
                                </p>
                            </div>

                            <!-- Action -->
                            <!-- {{ route('supplements.show', ['id' => $supplement->getId(), 'page' => 1]) }} -->
                            <div class="card-actions pt-4 border-t border-neutral/20 grid grid-cols-2 gap-2">
                                <a href="{{ route('supplements.show', ['id' => $supplement->getId(), 'page' => 1]) }}"
                                    class="btn btn-ghost">
                                    Ver
                                </a>
                                <form method="POST" action="{{ route('cart.items.store') }}">
                                    @csrf
                                    <input type="hidden" name="supplement_id" value="{{ $supplement->getId() }}" />
                                    <input type="hidden" name="quantity" value="1" />
                                    <button class="btn btn-primary w-full"
                                        @if ($supplement->getStock() <= 0) disabled @endif>
                                        Agregar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Results Information -->
            <div class="text-center mb-6">
                <p class="text-base-content/70">
                    Mostrando {{ $viewData['current_items_count'] }} de
                    {{ $viewData['total_results'] }} productos
                </p>
            </div>

            <!-- Pagination -->
            @if ($viewData['total_pages'] > 1)
                <div class="flex justify-center mt-8">
                    <div class="join shadow-lg">
                        <!-- First page -->
                        @if ($viewData['current_page'] > 1)
                            <a href="{{ request()->fullUrlWithQuery(['page' => 1]) }}"
                                class="join-item btn btn-sm hover:btn-primary">
                                Primera
                            </a>
                        @else
                            <button class="join-item btn btn-sm btn-disabled">Primera</button>
                        @endif

                        <!-- Previous page -->
                        @if ($viewData['current_page'] > 1)
                            <a href="{{ request()->fullUrlWithQuery(['page' => $viewData['current_page'] - 1]) }}"
                                class="join-item btn btn-sm hover:btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>
                        @else
                            <button class="join-item btn btn-sm btn-disabled">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                        @endif

                        <!-- Page numbers -->
                        @for ($i = max(1, $viewData['current_page'] - 2); $i <= min($viewData['total_pages'], $viewData['current_page'] + 2); $i++)
                            <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}"
                                class="join-item btn btn-sm {{ $i == $viewData['current_page'] ? 'btn-active btn-primary' : 'hover:btn-primary' }}">
                                {{ $i }}
                            </a>
                        @endfor

                        <!-- Next page -->
                        @if ($viewData['current_page'] < $viewData['total_pages'])
                            <a href="{{ request()->fullUrlWithQuery(['page' => $viewData['current_page'] + 1]) }}"
                                class="join-item btn btn-sm hover:btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @else
                            <button class="join-item btn btn-sm btn-disabled">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        @endif

                        <!-- Last page -->
                        @if ($viewData['current_page'] < $viewData['total_pages'])
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
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <div class="mb-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 mx-auto text-base-content/20"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-base-content mb-4">No se encontraron productos</h3>
                    <p class="text-base-content/70 mb-8 leading-relaxed">
                        No encontramos suplementos que coincidan con los filtros seleccionados.
                        Intenta ajustar los criterios de búsqueda.
                    </p>
                    <div class="flex gap-3 justify-center">
                        <a href="{{ route('supplements.index') }}" class="btn btn-primary px-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Ver todos los productos
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
