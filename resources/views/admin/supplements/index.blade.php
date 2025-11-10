@extends('layouts.admin')

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


    <div class="container mx-auto px-4 py-10">
        <div class="flex flex-col gap-8 pb-16">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
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

            <form id="filterForm" method="GET" action="{{ route('admin.supplements.index') }}"
                class="card bg-base-100 border border-neutral/20 rounded-xl p-6 shadow space-y-4">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Buscar</span>
                        </label>
                        <input name="search" value="{{ request('search') }}" placeholder="Buscar suplementos..."
                            class="input input-bordered w-full focus:input-primary" />
                    </div>

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

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Precio Mínimo</span>
                        </label>
                        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="0" min="0"
                            class="input input-bordered w-full focus:input-primary" />
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Precio Máximo</span>
                        </label>
                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="100000"
                            min="0" class="input input-bordered w-full focus:input-primary" />
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="flex w-full flex-col gap-4 sm:flex-row">
                        <div class="form-control">
                            <label class="cursor-pointer label">
                                <span class="label-text mr-2">Solo en stock</span>
                                <input type="checkbox" name="in_stock" value="1"
                                    {{ request('in_stock') ? 'checked' : '' }} class="checkbox checkbox-primary" />
                            </label>
                        </div>

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

                        <div class="form-control min-w-[120px]">
                            <select name="per_page" class="select select-bordered select-sm">
                                <option value="4" {{ request('per_page', 4) == 4 ? 'selected' : '' }}>4 por página
                                </option>
                                <option value="8" {{ request('per_page') == 8 ? 'selected' : '' }}>8 por página</option>
                                <option value="32" {{ request('per_page') == 32 ? 'selected' : '' }}>32 por página</option>
                            </select>
                        </div>
                    </div>

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

            @if (! empty($viewData['has_filters']))
                <div class="flex flex-wrap items-center gap-2">
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

            @if (count($viewData['supplements']) > 0)
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body space-y-6">
                        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                            <h2 class="card-title text-base-content text-2xl">Listado de suplementos</h2>
                            <span class="text-sm text-base-content/60">Resultados: {{ count($viewData['supplements']) }}</span>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="table table-zebra w-full">
                                <thead>
                                <tr>
                                    <th class="text-base-content/70">ID</th>
                                    <th class="text-base-content/70">Producto</th>
                                    <th class="text-base-content/70">Categorías</th>
                                    <th class="text-base-content/70">Precio</th>
                                    <th class="text-base-content/70">Stock</th>
                                    <th class="text-base-content/70">Calificación</th>
                                    <th class="text-base-content/70 text-center">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($viewData['supplements'] as $supplement)
                                    <tr class="hover">
                                        <td class="whitespace-nowrap font-semibold">#{{ $supplement->getId() }}</td>
                                        <td>
                                            <div class="flex items-center gap-3">
                                                <div class="h-14 w-14 overflow-hidden rounded-lg bg-base-200">
                                                    @if ($supplement->getImagePath())
                                                        <img src="{{ asset('storage/' . $supplement->getImagePath()) }}"
                                                            alt="{{ $supplement->getName() }}"
                                                            class="h-full w-full object-cover" loading="lazy" />
                                                    @else
                                                        <div class="flex h-full w-full items-center justify-center text-base-content/40">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-base-content">{{ $supplement->getName() }}</p>
                                                    <p class="text-sm text-base-content/60">{{ $supplement->getLaboratory() }}</p>
                                                    @if ($supplement->getFlavour())
                                                        <p class="text-xs text-base-content/50">Sabor: {{ $supplement->getFlavour() }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="max-w-xs">
                                            <span class="text-sm text-base-content/70">
                                                {{ $supplement->getCategoryNamesList() ?: 'Sin asignar' }}
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap font-semibold text-primary">
                                            ${{ number_format($supplement->getPrice(), 0, ',', '.') }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            @if ($supplement->getStock() > 0)
                                                <span class="badge badge-success badge-sm">{{ $supplement->getStock() }} en stock</span>
                                            @else
                                                <span class="badge badge-error badge-sm">Agotado</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-warning"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                                <span class="text-sm text-base-content/70">
                                                    {{ number_format($supplement->getAverageRating(), 1) }} / 5
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('supplements.show', ['id' => $supplement->getId(), 'page' => 1]) }}"
                                                    class="btn btn-ghost btn-sm" title="Ver detalle" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>

                                                <a href="{{ route('admin.supplements.edit', ['id' => $supplement->getId()]) }}"
                                                    class="btn btn-secondary btn-sm" title="Editar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>

                                                <button type="button"
                                                    onclick="confirmDelete({{ $supplement->getId() }}, '{{ $supplement->getName() }}')"
                                                    class="btn btn-error btn-sm" title="Eliminar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            @if ($viewData['total_pages'] > 1)
                <div class="flex justify-center mt-8">
                    <div class="join shadow-lg">
                        @if ($viewData['current_page'] > 1)
                            <a href="{{ request()->fullUrlWithQuery(['page' => 1]) }}"
                                class="join-item btn btn-sm hover:btn-primary">
                                Primera
                            </a>
                        @else
                            <button class="join-item btn btn-sm btn-disabled">Primera</button>
                        @endif

                        @if ($viewData['current_page'] > 1)
                            <a href="{{ request()->fullUrlWithQuery(['page' => $viewData['current_page'] - 1]) }}"
                                class="join-item btn btn-sm hover:btn-primary">
                                «
                            </a>
                        @else
                            <button class="join-item btn btn-sm btn-disabled">«</button>
                        @endif

                        @for ($i = max(1, $viewData['current_page'] - 2); $i <= min($viewData['total_pages'], $viewData['current_page'] + 2); $i++)
                            <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}"
                                class="join-item btn btn-sm {{ $i == $viewData['current_page'] ? 'btn-active btn-primary' : 'hover:btn-primary' }}">
                                {{ $i }}
                            </a>
                        @endfor

                        @if ($viewData['current_page'] < $viewData['total_pages'])
                            <a href="{{ request()->fullUrlWithQuery(['page' => $viewData['current_page'] + 1]) }}"
                                class="join-item btn btn-sm hover:btn-primary">
                                »
                            </a>
                        @else
                            <button class="join-item btn btn-sm btn-disabled">»</button>
                        @endif

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
    </div>

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
