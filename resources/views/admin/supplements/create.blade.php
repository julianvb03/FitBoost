@extends('layouts.app')

@section('title', 'Crear Suplemento')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-base-content">Crear Suplemento</h1>
                    <p class="text-base-content/70 mt-2">Ingresa la información del nuevo suplemento</p>
                </div>
                <a href="{{ route('admin.supplements.index') }}" 
                   class="btn btn-ghost btn-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver
                </a>
            </div>
        </div>

        <!-- Form ('admin.supplements.store') -->
        <form action="{{ route('admin.supplements.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            
            <!-- Basic Information Card -->
            <div class="card bg-base-300 shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-primary mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Información Básica
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div class="form-control">
                            <label class="label" for="name">
                                <span class="label-text">Nombre *</span>
                            </label>
                            <input type="text" 
                                   id="name"
                                   name="name" 
                                   value="{{ old('name') }}"
                                   class="input input-bordered w-full @error('name') input-error @enderror" 
                                   placeholder="Ej: Proteína Whey Chocolate"
                                   required>
                            @error('name')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- Laboratory -->
                        <div class="form-control">
                            <label class="label" for="laboratory">
                                <span class="label-text">Laboratorio *</span>
                            </label>
                            <input type="text" 
                                   id="laboratory"
                                   name="laboratory" 
                                   value="{{ old('laboratory') }}"
                                   class="input input-bordered w-full @error('laboratory') input-error @enderror" 
                                   placeholder="Ej: OptimumNutrition"
                                   required>
                            @error('laboratory')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="form-control">
                            <label class="label" for="price">
                                <span class="label-text">Precio *</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-base-content/60">$</span>
                                <input type="number" 
                                       id="price"
                                       name="price" 
                                       value="{{ old('price') }}"
                                       class="input input-bordered w-full pl-8 @error('price') input-error @enderror" 
                                       placeholder="0"
                                       min="1"
                                       required>
                            </div>
                            @error('price')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- Stock -->
                        <div class="form-control">
                            <label class="label" for="stock">
                                <span class="label-text">Stock *</span>
                            </label>
                            <input type="number" 
                                   id="stock"
                                   name="stock" 
                                   value="{{ old('stock') }}"
                                   class="input input-bordered w-full @error('stock') input-error @enderror" 
                                   placeholder="0"
                                   min="0"
                                   required>
                            @error('stock')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- Flavour -->
                        <div class="form-control">
                            <label class="label" for="flavour">
                                <span class="label-text">Sabor *</span>
                            </label>
                            <input type="text" 
                                   id="flavour"
                                   name="flavour" 
                                   value="{{ old('flavour') }}"
                                   class="input input-bordered w-full @error('flavour') input-error @enderror" 
                                   placeholder="Ej: Chocolate, Vainilla, Sin sabor"
                                   required>
                            @error('flavour')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- Expiration Date -->
                        <div class="form-control">
                            <label class="label" for="expiration_date">
                                <span class="label-text">Fecha de Vencimiento *</span>
                            </label>
                            <input type="date" 
                                   id="expiration_date"
                                   name="expiration_date" 
                                   value="{{ old('expiration_date') }}"
                                   class="input input-bordered w-full @error('expiration_date') input-error @enderror"
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                   required>
                            @error('expiration_date')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="form-control mt-6">
                        <label class="label" for="description">
                            <span class="label-text">Descripción *</span>
                        </label>
                        <textarea id="description"
                                  name="description" 
                                  class="textarea textarea-bordered h-32 @error('description') textarea-error @enderror" 
                                  placeholder="Describe las características, beneficios y uso recomendado del suplemento..."
                                  required>{{ old('description') }}</textarea>
                        @error('description')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Categories Card -->
            <div class="card bg-base-300 shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-primary mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        Categorías *
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @if(isset($viewData['categories']) && count($viewData['categories']) > 0)
                            @foreach($viewData['categories'] as $category)
                                <div class="form-control">
                                    <label class="cursor-pointer label justify-start">
                                        <input type="checkbox" 
                                               name="categories[]" 
                                               value="{{ $category->getId() }}"
                                               class="checkbox checkbox-primary mr-3"
                                               {{ in_array($category->getId(), old('categories', [])) ? 'checked' : '' }}>
                                        <span class="label-text">{{ $category->getName() }}</span>
                                    </label>
                                </div>
                            @endforeach
                        @else
                            <div class="col-span-full">
                                <div class="alert alert-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-9 2a9 9 0 1118 0 9 9 0 01-18 0z" />
                                    </svg>
                                    <span>No hay categorías disponibles. <a href="#" class="link">Crear categorías</a> primero.</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    @error('categories')
                        <div class="text-error text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Image Card -->
            <div class="card bg-base-300 shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-primary mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Imagen
                        <span class="text-sm font-normal text-base-content/60">(Opcional)</span>
                    </h2>
                    
                    <div class="form-control">
                        <label class="label" for="image">
                            <span class="label-text">Imagen del producto</span>
                        </label>
                        <input type="file" 
                               id="image"
                               name="image" 
                               accept="image/*"
                               class="file-input file-input-bordered w-full @error('image') file-input-error @enderror">
                        <p class="text-xs text-base-content/60 mt-2">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB.</p>
                        @error('image')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Ingredients Card -->
            <div class="card bg-base-300 shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-primary mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Ingredientes *
                    </h2>
                    
                    <div class="form-control">
                        <textarea id="ingredients"
                            name="ingredients" 
                            class="textarea textarea-bordered h-24 @error('ingredients') textarea-error @enderror" 
                            placeholder="Ingresa los ingredientes separados por comas (Ej: Proteína de suero, creatina, taurina)"
                            required>{{ old('ingredients') }}</textarea>
                        @error('ingredients')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Actions -->
            <div class="flex justify-end gap-4 pt-4">
                <a href="{{ route('admin.supplements.index') }}" 
                   class="btn btn-ghost">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Crear Suplemento
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview image functionality
    const imageInput = document.getElementById('image');
    
    if (imageInput) {
        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    // Si ya existe una vista previa, la eliminamos
                    let existingPreview = document.querySelector('.image-preview');
                    if (existingPreview) {
                        existingPreview.remove();
                    }
                    
                    // Crear elemento para la vista previa
                    const preview = document.createElement('div');
                    preview.className = 'image-preview mt-4';
                    preview.innerHTML = `
                        <div class="flex items-center gap-4">
                            <img src="${e.target.result}" class="h-24 w-auto object-contain border rounded" alt="Vista previa">
                            <div class="text-sm">
                                <p class="font-medium">Vista previa de la imagen</p>
                                <p class="text-base-content/70">${imageInput.files[0].name}</p>
                            </div>
                        </div>
                    `;
                    
                    // Insertar después del input
                    imageInput.parentNode.appendChild(preview);
                };
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    }
});
</script>
@endsection