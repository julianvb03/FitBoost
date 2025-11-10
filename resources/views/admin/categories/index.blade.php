@extends('layouts.admin')

@section('title', 'Administrar Categorías')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-base-content">Administrar Categorías</h1>
            <p class="text-base-content/70 mt-2">Gestiona las categorías de tu sistema</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-lg gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Nueva Categoría
        </a>
    </div>

    <!-- Alert Messages -->
    @if(isset($viewData['success']))
    <div class="alert alert-success shadow-lg mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ $viewData['success'] }}</span>
    </div>
    @endif

    @if(isset($viewData['error']))
    <div class="alert alert-error shadow-lg mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ $viewData['error'] }}</span>
    </div>
    @endif

    <!-- Stats Cards -->
    <div class="stats shadow mb-8 w-full">
        <div class="stat">
            <div class="stat-figure text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
            </div>
            <div class="stat-title">Total de Categorías</div>
            <div class="stat-value text-primary">{{ count($viewData['categories']) }}</div>
            <div class="stat-desc">Categorías registradas en el sistema</div>
        </div>
    </div>

    <!-- Categories Table -->
    @if(count($viewData['categories']) > 0)
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                Lista de Categorías
            </h2>

            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr>
                            <th class="text-base-content/80">ID</th>
                            <th class="text-base-content/80">Nombre</th>
                            <th class="text-base-content/80">Descripción</th>
                            <th class="text-center text-base-content/80">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($viewData['categories'] as $category)
                        <tr class="hover">
                            <td class="font-semibold"># {{ $category->getId() }}</td>
                            <td>
                                <div class="font-medium text-base-content">{{ $category->getName() }}</div>
                            </td>
                            <td>
                                <div class="text-base-content/70 max-w-xs truncate">
                                    {{ $category->getDescription() ?: 'Sin descripción' }}
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="inline-flex justify-center gap-2">
                                    <a href="{{ route('admin.categories.edit', $category->getId()) }}"
                                        class="btn btn-sm btn-secondary tooltip"
                                        data-tip="Editar categoría">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    <button type="button"
                                        class="btn btn-sm btn-error tooltip"
                                        data-tip="Eliminar categoría"
                                        data-category-delete
                                        data-category-id="{{ $category->getId() }}"
                                        data-category-name="{{ e($category->getName()) }}"
                                        data-category-url="{{ route('admin.categories.destroy', $category->getId()) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
    @else
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body text-center py-16">
            <div class="text-base-content/40 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-base-content mb-2">No hay categorías registradas</h3>
            <p class="text-base-content/70 mb-6">Comienza creando tu primera categoría para organizar tu contenido</p>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-wide">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Crear Primera Categoría
            </a>
        </div>
    </div>
    @endif
</div>

<dialog id="delete_modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline mr-2 text-error" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.268 15.5c-.77.833.192 2.5 1.732 2.5z" />
            </svg>
            Confirmar Eliminación
        </h3>
        <p class="py-4">¿Estás seguro de que deseas eliminar la categoría <span id="category-name" class="font-semibold text-primary"></span>?</p>
        <p class="text-sm text-base-content/70 mb-4">Esta acción no se puede deshacer.</p>
        <div class="modal-action">
            <form id="delete-form" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
            <button type="button" class="btn btn-ghost" data-modal-close="delete_modal">Cancelar</button>
            <button type="button" class="btn btn-error" data-category-confirm-delete>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Eliminar
            </button>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
@push('scripts')
    @vite(entrypoints: ['resources/js/admin/categories/index.js'])
@endpush
@endsection