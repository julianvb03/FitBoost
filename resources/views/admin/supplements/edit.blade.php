@extends('layouts.app')

@section('title', trans('admin/admin.edit_supplement'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-base-content mb-2">
                {{ trans('admin/admin.edit_supplement') }}
            </h1>
            <div class="breadcrumbs text-sm">
                <ul>
                    <li><a href="{{ route('admin.supplements.index') }}" class="text-primary hover:text-primary-content">{{ trans('admin/admin.supplements') }}</a></li>
                    <li class="text-base-content opacity-60">{{ trans('admin/admin.edit') }}</li>
                </ul>
            </div>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
        <div class="alert alert-error mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <h3 class="font-bold">{{ trans('admin/admin.validation_errors') }}</h3>
                <ul class="list-disc list-inside mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <!-- Form Card -->
        <div class="card bg-base-200 shadow-xl">
            <div class="card-body">
                <form action="{{ route('admin.supplements.update', $viewData['supplement']->getId()) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <!-- Basic Information Section -->
                    <div class="divider divider-start">
                        <span class="text-lg font-semibold text-primary">{{ trans('admin/admin.basic_information') }}</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div class="form-control w-full">
                            <label class="label" for="name">
                                <span class="label-text text-base-content font-medium">
                                    {{ trans('admin/admin.name') }} <span class="text-error">*</span>
                                </span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name"
                                   placeholder="{{ trans('admin/admin.enter_supplement_name') }}"
                                   class="input input-bordered w-full @error('name') input-error @enderror"
                                   value="{{ old('name', $viewData['supplement']->getName()) }}"
                                   required>
                            @error('name')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- Laboratory -->
                        <div class="form-control w-full">
                            <label class="label" for="laboratory">
                                <span class="label-text text-base-content font-medium">
                                    {{ trans('admin/admin.laboratory') }} <span class="text-error">*</span>
                                </span>
                            </label>
                            <input type="text" 
                                   name="laboratory" 
                                   id="laboratory"
                                   placeholder="{{ trans('admin/admin.enter_laboratory') }}"
                                   class="input input-bordered w-full @error('laboratory') input-error @enderror"
                                   value="{{ old('laboratory', $viewData['supplement']->getLaboratory()) }}">
                            @error('laboratory')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="form-control w-full">
                            <label class="label" for="price">
                                <span class="label-text text-base-content font-medium">
                                    {{ trans('admin/admin.price') }} <span class="text-error">*</span>
                                </span>
                            </label>
                            <div class="relative">
                                <input type="number" 
                                       name="price" 
                                       id="price"
                                       placeholder="0"
                                       class="input input-bordered w-full pl-8 @error('price') input-error @enderror"
                                       value="{{ old('price', $viewData['supplement']->getPrice()) }}"
                                       min="0">
                                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-base-content opacity-60">$</span>
                            </div>
                            @error('price')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- Stock -->
                        <div class="form-control w-full">
                            <label class="label" for="stock">
                                <span class="label-text text-base-content font-medium">
                                    {{ trans('admin/admin.stock') }} <span class="text-error">*</span>
                                </span>
                            </label>
                            <input type="number" 
                                   name="stock" 
                                   id="stock"
                                   placeholder="0"
                                   class="input input-bordered w-full @error('stock') input-error @enderror"
                                   value="{{ old('stock', $viewData['supplement']->getStock()) }}"
                                   min="0">
                            @error('stock')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- Flavour -->
                        <div class="form-control w-full">
                            <label class="label" for="flavour">
                                <span class="label-text text-base-content font-medium">
                                    {{ trans('admin/admin.flavour') }} <span class="text-error">*</span>
                                </span>
                            </label>
                            <input type="text" 
                                   name="flavour" 
                                   id="flavour"
                                   placeholder="{{ trans('admin/admin.enter_flavour') }}"
                                   class="input input-bordered w-full @error('flavour') input-error @enderror"
                                   value="{{ old('flavour', $viewData['supplement']->getFlavour()) }}">
                            @error('flavour')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <!-- Expiration Date -->
                        <div class="form-control w-full">
                            <label class="label" for="expiration_date">
                                <span class="label-text text-base-content font-medium">
                                    {{ trans('admin/admin.expiration_date') }} <span class="text-error">*</span>
                                </span>
                            </label>
                            <input type="date" 
                                   name="expiration_date" 
                                   id="expiration_date"
                                   class="input input-bordered w-full @error('expiration_date') input-error @enderror"
                                   value="{{ old('expiration_date', $viewData['supplement']->getExpirationDate()->format('Y-m-d')) }}">
                            @error('expiration_date')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="form-control w-full">
                        <label class="label" for="description">
                            <span class="label-text text-base-content font-medium">
                                {{ trans('admin/admin.description') }} <span class="text-error">*</span>
                            </span>
                        </label>
                        <textarea name="description" 
                                  id="description"
                                  rows="4"
                                  placeholder="{{ trans('admin/admin.enter_description') }}"
                                  class="textarea textarea-bordered w-full @error('description') textarea-error @enderror">{{ old('description', $viewData['supplement']->getDescription()) }}</textarea>
                        @error('description')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Categories Section -->
                    <div class="divider divider-start">
                        <span class="text-lg font-semibold text-primary">{{ trans('admin/admin.categories') }}</span>
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-base-content font-medium">
                                {{ trans('admin/admin.select_categories') }} <span class="text-error">*</span>
                            </span>
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                            @php
                                $selectedCategories = old('categories', $viewData['supplement']->getCategories()->pluck('id')->toArray());
                            @endphp
                            @foreach($viewData['categories'] as $category)
                            <label class="label cursor-pointer justify-start gap-3 p-3 rounded-lg border border-neutral hover:bg-base-300 transition-colors">
                                <input type="checkbox" 
                                       name="categories[]" 
                                       value="{{ $category->getId() }}"
                                       class="checkbox checkbox-primary checkbox-sm"
                                       {{ in_array($category->getId(), $selectedCategories) ? 'checked' : '' }}>
                                <span class="label-text text-base-content text-sm">{{ $category->getName() }}</span>
                            </label>
                            @endforeach
                        </div>
                        @error('categories')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Images Section -->
                    <div class="divider divider-start">
                        <span class="text-lg font-semibold text-primary">{{ trans('admin/admin.images') }}</span>
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-base-content font-medium">{{ trans('admin/admin.image_urls') }}</span>
                            <span class="label-text-alt text-base-content opacity-60">{{ trans('admin/admin.optional') }}</span>
                        </label>
                        <div id="images-container" class="space-y-3">
                            @php
                                $images = old('images', $viewData['supplement']->getImages());
                                $images = is_array($images) ? $images : [];
                            @endphp
                            @if(count($images) > 0)
                                @foreach($images as $index => $image)
                                <div class="image-input-group flex gap-2">
                                    <input type="url" 
                                           name="images[]" 
                                           placeholder="{{ trans('admin/admin.enter_image_url') }}"
                                           class="input input-bordered flex-1"
                                           value="{{ $image }}">
                                    <button type="button" class="btn btn-error btn-sm remove-image-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                                @endforeach
                            @else
                                <div class="image-input-group flex gap-2">
                                    <input type="url" 
                                           name="images[]" 
                                           placeholder="{{ trans('admin/admin.enter_image_url') }}"
                                           class="input input-bordered flex-1">
                                    <button type="button" class="btn btn-error btn-sm remove-image-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="mt-3">
                            <button type="button" id="add-image-btn" class="btn btn-outline btn-primary btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                {{ trans('admin/admin.add_image') }}
                            </button>
                        </div>
                        @error('images')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Ingredients -->
                    <div class="divider divider-start">
                        <span class="text-lg font-semibold text-primary">{{ trans('admin/admin.ingredients') }}</span>
                    </div>

                    <div class="form-control w-full">
                        <label class="label" for="ingredients">
                            <span class="label-text text-base-content font-medium">
                                {{ trans('admin/admin.ingredients_description') }} <span class="text-error">*</span>
                            </span>
                        </label>
                        <textarea name="ingredients" 
                                  id="ingredients"
                                  rows="4"
                                  placeholder="{{ trans('admin/admin.enter_ingredients') }}"
                                  class="textarea textarea-bordered w-full @error('ingredients') textarea-error @enderror">{{ old('ingredients', $viewData['supplement']->getIngredients()) }}</textarea>
                        @error('ingredients')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="divider"></div>
                    <div class="flex flex-col sm:flex-row gap-4 justify-end">
                        <a href="{{ route('admin.supplements.index') }}" class="btn btn-ghost">
                            {{ trans('admin/admin.cancel') }}
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            {{ trans('admin/admin.update_supplement') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const addImageBtn = document.getElementById('add-image-btn');
    const imagesContainer = document.getElementById('images-container');

    // Add new image input
    addImageBtn.addEventListener('click', function() {
        const newImageGroup = document.createElement('div');
        newImageGroup.className = 'image-input-group flex gap-2';
        newImageGroup.innerHTML = `
            <input type="url" 
                   name="images[]" 
                   placeholder="{{ trans('admin/admin.enter_image_url') }}"
                   class="input input-bordered flex-1">
            <button type="button" class="btn btn-error btn-sm remove-image-btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>
        `;
        imagesContainer.appendChild(newImageGroup);
        attachRemoveHandler(newImageGroup.querySelector('.remove-image-btn'));
    });

    // Remove image input
    function attachRemoveHandler(button) {
        button.addEventListener('click', function() {
            const imageGroups = imagesContainer.querySelectorAll('.image-input-group');
            if (imageGroups.length > 1) {
                this.closest('.image-input-group').remove();
            }
        });
    }

    // Attach remove handlers to existing buttons
    document.querySelectorAll('.remove-image-btn').forEach(attachRemoveHandler);
});
</script>
@endsection