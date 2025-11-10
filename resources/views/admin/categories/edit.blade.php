@extends('layouts.admin')

@section('title', 'Editar Categoría')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <div class="breadcrumbs text-sm text-base-content/70 mb-2">
                <ul>
                    <li><a href="{{ route('admin.categories.index') }}" class="hover:text-primary">Categorías</a></li>
                    <li class="text-base-content">Editar Categoría</li>
                </ul>
            </div>
            <h1 class="text-3xl font-bold text-base-content">Editar Categoría</h1>
            <p class="text-base-content/70 mt-2">Modifica la información de la categoría <span class="text-primary font-semibold">{{ $viewData['category']->name }}</span></p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-ghost btn-lg gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Volver a la Lista
            </a>
        </div>
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Form Card -->
        <div class="lg:col-span-2">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Información de la Categoría
                    </h2>

                    <form action="{{ route('admin.categories.update', $viewData['category']->id) }}" method="POST" id="categoryForm" data-category-form>
                        @csrf
                        @method('PATCH')

                        <!-- Name Field -->
                        <div class="form-control w-full mb-6">
                            <label class="label" for="name">
                                <span class="label-text font-semibold">Nombre de la Categoría</span>
                                <span class="label-text-alt text-error">*</span>
                            </label>
                            <input type="text"
                                id="name"
                                name="name"
                                class="input input-bordered w-full @error('name') input-error @enderror"
                                placeholder="Ej: Suplementos Deportivos"
                                value="{{ old('name', $viewData['category']->name) }}"
                                data-max-length="255"
                                data-counter-id="nameCounter"
                                data-error-class="input-error"
                                required>
                            @error('name')
                            <label class="label">
                                <span class="label-text-alt text-error">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </span>
                            </label>
                            @enderror
                            <label class="label">
                                <span class="label-text-alt text-base-content/50">El nombre debe ser único y descriptivo</span>
                                <span class="label-text-alt text-base-content/50" id="nameCounter">0/255</span>
                            </label>
                        </div>

                        <!-- Description Field -->
                        <div class="form-control w-full mb-8">
                            <label class="label" for="description">
                                <span class="label-text font-semibold">Descripción</span>
                                <span class="label-text-alt text-base-content/50">(Opcional)</span>
                            </label>
                            <textarea id="description"
                                name="description"
                                class="textarea textarea-bordered h-32 resize-none @error('description') textarea-error @enderror"
                                placeholder="Describe brevemente esta categoría y qué tipos de productos incluye..."
                                data-max-length="500"
                                data-counter-id="descCounter"
                                data-error-class="textarea-error">{{ old('description', $viewData['category']->description) }}</textarea>
                            @error('description')
                            <label class="label">
                                <span class="label-text-alt text-error">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </span>
                            </label>
                            @enderror
                            <label class="label">
                                <span class="label-text-alt text-base-content/50">Una buena descripción ayuda a los usuarios a entender la categoría</span>
                                <span class="label-text-alt text-base-content/50" id="descCounter">0/500</span>
                            </label>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-end">
                            <button type="button"
                                class="btn btn-ghost btn-lg order-2 sm:order-1"
                                data-category-reset="restore"
                                data-original-name="{{ e($viewData['category']->name) }}"
                                data-original-description="{{ e($viewData['category']->description ?? '') }}"
                                data-reset-focus="#name">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Restaurar
                            </button>
                            <button type="submit"
                                class="btn btn-primary btn-lg order-1 sm:order-2"
                                id="submitBtn"
                                data-loading-text="Actualizando...">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Actualizar Categoría
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Info Sidebar -->
        <div class="lg:col-span-1">
            <div class="space-y-6">
                <!-- Category Info Card -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h3 class="card-title text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Información Actual
                        </h3>
                        <div class="space-y-4 text-sm">
                            <div class="flex justify-between items-start">
                                <span class="text-base-content/60">ID:</span>
                                <span class="font-mono text-primary"># {{ $viewData['category']->id }}</span>
                            </div>
                            <div class="flex justify-between items-start">
                                <span class="text-base-content/60">Creada:</span>
                                <span class="text-base-content">{{ $viewData['category']->created_at ? $viewData['category']->created_at->format('d/m/Y H:i') : 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-start">
                                <span class="text-base-content/60">Última actualización:</span>
                                <span class="text-base-content">{{ $viewData['category']->updated_at ? $viewData['category']->updated_at->format('d/m/Y H:i') : 'N/A' }}</span>
                            </div>
                            @if(method_exists($viewData['category'], 'products'))
                            <div class="flex justify-between items-start">
                                <span class="text-base-content/60">Productos:</span>
                                <span class="badge badge-secondary">{{ $viewData['category']->products()->count() }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Help Card -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h3 class="card-title text-info">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Consejos de Edición
                        </h3>
                        <div class="space-y-4 text-sm text-base-content/70">
                            <div class="flex items-start gap-3">
                                <div class="w-2 h-2 bg-warning rounded-full mt-2 flex-shrink-0"></div>
                                <div>
                                    <strong class="text-base-content">Cuidado con el nombre:</strong> Cambiar el nombre puede afectar la URL y SEO de los productos asociados.
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-2 h-2 bg-info rounded-full mt-2 flex-shrink-0"></div>
                                <div>
                                    <strong class="text-base-content">Productos existentes:</strong> Los cambios se aplicarán a todos los productos de esta categoría.
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-2 h-2 bg-success rounded-full mt-2 flex-shrink-0"></div>
                                <div>
                                    <strong class="text-base-content">Botón restaurar:</strong> Regresa los valores a su estado original si has hecho cambios por error.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions Card -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h3 class="card-title text-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.268 15.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                            Acciones Peligrosas
                        </h3>
                        <p class="text-sm text-base-content/70 mb-4">
                            Estas acciones son irreversibles. Úsalas con precaución.
                        </p>
                        <button type="button"
                            class="btn btn-error btn-outline w-full gap-2"
                            data-category-delete
                            data-category-id="{{ $viewData['category']->id }}"
                            data-category-name="{{ e($viewData['category']->name) }}"
                            data-category-url="{{ route('admin.categories.destroy', $viewData['category']->id) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Eliminar Categoría
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<dialog id="delete_modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline mr-2 text-error" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.268 15.5c-.77.833.192 2.5 1.732 2.5z" />
            </svg>
            Confirmar Eliminación
        </h3>
        <p class="py-4">¿Estás seguro de que deseas eliminar la categoría <span id="category-name" class="font-semibold text-primary"></span>?</p>
        <div class="alert alert-warning mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 w-6 h-6" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.268 15.5c-.77.833.192 2.5 1.732 2.5z" />
            </svg>
            <span>Esta acción no se puede deshacer y podría afectar productos asociados.</span>
        </div>
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
                Eliminar Permanentemente
            </button>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
@push('scripts')
    @vite(entrypoints: ['resources/js/admin/categories/form.js'])
    @vite(entrypoints: ['resources/js/admin/categories/index.js'])
@endpush
@endsection