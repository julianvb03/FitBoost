@extends('layouts.app')

@section('title', 'Suplementos')

@section('content')

    @if (isset($viewData['success']))
        <div class="alert alert-success">
            {{ $viewData['success'] }}
        </div>
    @endif
    @if (isset($viewData['error']))
        <div class="alert alert-error">
            {{ $viewData['error'] }}
        </div>
    @endif


    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <div class="inline-flex items-center gap-3 mb-2">
                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="text-primary">
                            <path d="M12 2v20" />
                            <path d="M7 7h10" />
                            <path d="M7 12h10" />
                            <path d="M7 17h10" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-base-content">Suplementos</h1>
                </div>
                <p class="text-base-content/70 mt-1">Gestiona el catálogo de suplementos</p>
            </div>
            <a href="{{ route('admin.supplements.create') }}" class="btn btn-primary btn-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Crear Suplemento
            </a>
        </div>

        <!-- Filters and Search -->
        <form id="filterForm" method="GET" action="{{ route('admin.supplements.index') }}"
            class="card bg-base-100 border border-neutral/20 rounded-xl p-6 mb-6 shadow space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Search -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Buscar</span>
                    </label>
                    <input name="search" value="{{ request('search') }}" placeholder="Buscar suplementos..."
                        class="input input-bordered w-full focus:input-primary" />
                </div>

                <!-- Category -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Categoría</span>
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
                        <span class="label-text">Precio Mínimo</span>
                    </label>
                    <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="0" min="0"
                        class="input input-bordered w-full focus:input-primary" />
                </div>

                <!-- Maximum Price -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Precio Máximo</span>
                    </label>
                    <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="100000"
                        min="0" class="input input-bordered w-full focus:input-primary" />
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <!-- Stock and Order -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <!-- Stock -->
                    <div class="form-control">
                        <label class="cursor-pointer label">
                            <span class="label-text mr-2">Solo en stock</span>
                            <input type="checkbox" name="in_stock" value="1"
                                {{ request('in_stock') ? 'checked' : '' }} class="checkbox checkbox-primary" />
                        </label>
                    </div>

                    <!-- Order By (Sort By) -->
                    <div class="form-control min-w-[200px]">
                        <select name="order_by" class="select select-bordered select-sm">
                            <option value="">Ordenar por</option>
                            <option value="name" {{ request('order_by') == 'name' ? 'selected' : '' }}>
                                Nombre
                            </option>
                            <option value="price" {{ request('order_by') == 'price' ? 'selected' : '' }}>
                                Precio
                            </option>
                            <option value="rating" {{ request('order_by') == 'rating' ? 'selected' : '' }}>
                                Calificación
                            </option>
                        </select>
                    </div>

                    <!-- Per Page (Items per page) -->
                    <div class="form-control min-w-[120px]">
                        <select name="per_page" class="select select-bordered select-sm">
                            <option value="4" {{ request('per_page', 4) == 4 ? 'selected' : '' }}>4 por página
                            </option>
                            <option value="8" {{ request('per_page') == 8 ? 'selected' : '' }}>8 por página</option>
                            <option value="32" {{ request('per_page') == 32 ? 'selected' : '' }}>32 por página</option>
                        </select>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Filtrar
                    </button>
                    <a href="{{ route('admin.supplements.index') }}" class="btn btn-ghost">
                        Limpiar
                    </a>
                </div>
            </div>
        </form>

        @php
            $hasFilters =
                request('search') ||
                request('category_id') ||
                request('min_price') ||
                request('max_price') ||
                request('in_stock') ||
                request('order_by') ||
                request('per_page');
        @endphp
        @if ($hasFilters)
            <div class="flex flex-wrap items-center gap-2 mb-6">
                <span class="text-sm text-base-content/70 mr-1">Filtros activos:</span>
                @if (request('search'))
                    <a href="{{ route('admin.supplements.index', request()->except('search')) }}" class="chip">Buscar:
                        "{{ request('search') }}" <span>&times;</span></a>
                @endif
                @if (request('category_id'))
                    <a href="{{ route('admin.supplements.index', request()->except('category_id')) }}"
                        class="chip">Categoría <span>&times;</span></a>
                @endif
                @if (request('min_price'))
                    <a href="{{ route('admin.supplements.index', request()->except('min_price')) }}" class="chip">Min:
                        ${{ number_format(request('min_price'), 0, ',', '.') }} <span>&times;</span></a>
                @endif
                @if (request('max_price'))
                    <a href="{{ route('admin.supplements.index', request()->except('max_price')) }}" class="chip">Max:
                        ${{ number_format(request('max_price'), 0, ',', '.') }} <span>&times;</span></a>
                @endif
                @if (request('in_stock'))
                    <a href="{{ route('admin.supplements.index', request()->except('in_stock')) }}" class="chip">En
                        stock <span>&times;</span></a>
                @endif
                @if (request('order_by'))
                    <a href="{{ route('admin.supplements.index', request()->except('order_by')) }}" class="chip">Orden:
                        {{ ucfirst(request('order_by')) }} <span>&times;</span></a>
                @endif
                @if (request('per_page'))
                    <a href="{{ route('admin.supplements.index', request()->except('per_page')) }}" class="chip">Por
                        página: {{ request('per_page') }} <span>&times;</span></a>
                @endif
                <a href="{{ route('admin.supplements.index') }}" class="btn btn-ghost btn-xs ml-1">Quitar todos</a>
            </div>
        @endif

        <!-- Grid of Products -->
        @if (count($viewData['supplements']) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                @foreach ($viewData['supplements'] as $supplement)
                    <div
                        class="card bg-base-100 shadow-lg hover:shadow-2xl transition-all duration-300 border border-neutral/20">
                        <!-- Product Image -->
                        <figure class="px-4 pt-4">
                            <div class="aspect-square w-full bg-base-200 rounded-lg overflow-hidden">
                                @if ($supplement->getImagePath())
                                    <img src="{{ asset('storage/' . $supplement->getImagePath()) }}"
                                        alt="{{ $supplement->getName() }}"
                                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                                        loading="lazy" />
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-base-content/40">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </figure>

                        <div class="card-body p-4 flex flex-grow">
                            <!-- Header of the card -->
                            <div class="flex justify-between items-start mb-2">
                                <h2 class="card-title text-lg font-bold text-base-content line-clamp-2">
                                    {{ $supplement->getName() }}
                                </h2>
                                @if ($supplement->getStock() > 0)
                                    <div class="badge badge-success badge-sm text-nowrap">Stock:
                                        {{ $supplement->getStock() }}</div>
                                @else
                                    <div class="badge badge-error badge-sm">Agotado</div>
                                @endif
                            </div>

                            <!-- Product Information -->
                            <div class="space-y-2 mb-4">
                                <p class="text-sm text-base-content/70">
                                    <span class="font-medium">Laboratorio:</span> {{ $supplement->getLaboratory() }}
                                </p>
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
                                    <span
                                        class="text-sm text-base-content/70">({{ $supplement->getAverageRating() }})</span>
                                </div>

                                <!-- Price -->
                                <p class="text-2xl font-bold text-primary">
                                    ${{ number_format($supplement->getPrice(), 0, ',', '.') }}
                                </p>

                                <!-- Truncated Description -->
                                <p class="text-sm text-base-content/60 line-clamp-2">
                                    {{ $supplement->getDescription() }}
                                </p>
                            </div>

                            <!-- Actions -->
                            <div class="card-actions justify-between items-center pt-4 border-t border-neutral/20 mt-auto">
                                <a href="{{ route('supplements.show', ['id' => $supplement->getId(), 'page' => 1]) }}"
                                    class="btn btn-primary btn-sm flex-1 mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Ver
                                </a>

                                <div class="dropdown dropdown-end">
                                    <div tabindex="0" role="button" class="btn btn-ghost btn-sm btn-square">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 5v.01M12 12v.01M12 19v.01" />
                                        </svg>
                                    </div>
                                    <ul tabindex="0"
                                        class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow-lg border border-neutral/20">
                                        <li>
                                            <a href="{{ route('admin.supplements.edit', ['id' => $supplement->getId()]) }}"
                                                class="text-base-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Editar
                                            </a>
                                        </li>
                                        <li>
                                            <button
                                                onclick="confirmDelete({{ $supplement->getId() }}, '{{ $supplement->getName() }}')"
                                                class="text-error">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Eliminar
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
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
                                «
                            </a>
                        @else
                            <button class="join-item btn btn-sm btn-disabled">«</button>
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
                                »
                            </a>
                        @else
                            <button class="join-item btn btn-sm btn-disabled">»</button>
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
                    Mostrando página {{ $viewData['current_page'] }} de {{ $viewData['total_pages'] }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="max-w-sm mx-auto">
                    <div class="mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto text-base-content/30"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-base-content mb-2">No hay suplementos</h3>
                    <p class="text-base-content/70 mb-6">No se encontraron suplementos que coincidan con los filtros
                        seleccionados.</p>
                    <div class="flex gap-2 justify-center">
                        <a href="{{ route('admin.supplements.index') }}" class="btn btn-ghost">
                            Limpiar filtros
                        </a>
                        <a href="{{ route('admin.supplements.create') }}" class="btn btn-primary">
                            Crear primer suplemento
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Modal of confirmation of deletion -->
    <dialog id="delete_modal" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold text-base-content">Confirmar eliminación</h3>
            <p class="py-4 text-base-content/80">
                ¿Estás seguro de que deseas eliminar el suplemento
                <span id="supplement_name" class="font-semibold text-primary"></span>?
                Esta acción no se puede deshacer.
            </p>
            <div class="modal-action">
                <form id="delete_form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-ghost" onclick="delete_modal.close()">Cancelar</button>
                    <button type="submit" class="btn btn-error ml-2">Eliminar</button>
                </form>
            </div>
        </div>
    </dialog>
    @push('scripts')
        @vite(entrypoints: ['resources/js/admin/supplements/home.js'])
    @endpush
@endsection
