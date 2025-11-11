@extends('layouts.admin')

@section('title', trans('admin/admin.edit_supplement'))

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-8">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-primary/10 rounded-full mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="text-primary">
                        <path d="M12 2v20" />
                        <path d="M7 7h10" />
                        <path d="M7 12h10" />
                        <path d="M7 17h10" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-base-content mb-2">
                    {{ trans('admin/admin.edit_supplement') }}
                </h1>
                <div class="breadcrumbs text-sm">
                    <ul>
                        <li><a href="{{ route('admin.supplements.index') }}"
                                class="text-primary hover:text-primary-content">{{ trans('admin/admin.supplements') }}</a>
                        </li>
                        <li class="text-base-content opacity-60">{{ trans('admin/admin.edit') }}</li>
                    </ul>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-error mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
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

            <div class="card bg-base-100 shadow-xl border border-neutral/20">
                <div class="card-body">
                    <form action="{{ route('admin.supplements.update', $viewData['supplement']->getId()) }}" method="POST"
                        enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <div class="divider divider-start">
                            <span
                                class="text-lg font-semibold text-primary">{{ trans('admin/admin.basic_information') }}</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-control w-full">
                                <label class="label" for="name">
                                    <span class="label-text text-base-content font-medium">
                                        {{ trans('admin/admin.name') }} <span class="text-error">*</span>
                                    </span>
                                </label>
                                <input type="text" name="name" id="name"
                                    placeholder="{{ trans('admin/admin.enter_supplement_name') }}"
                                    class="input input-bordered w-full focus:input-primary @error('name') input-error @enderror"
                                    value="{{ old('name', $viewData['supplement']->getName()) }}" required>
                                @error('name')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control w-full">
                                <label class="label" for="laboratory">
                                    <span class="label-text text-base-content font-medium">
                                        {{ trans('admin/admin.laboratory') }} <span class="text-error">*</span>
                                    </span>
                                </label>
                                <input type="text" name="laboratory" id="laboratory"
                                    placeholder="{{ trans('admin/admin.enter_laboratory') }}"
                                    class="input input-bordered w-full focus:input-primary @error('laboratory') input-error @enderror"
                                    value="{{ old('laboratory', $viewData['supplement']->getLaboratory()) }}">
                                @error('laboratory')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control w-full">
                                <label class="label" for="price">
                                    <span class="label-text text-base-content font-medium">
                                        {{ trans('admin/admin.price') }} <span class="text-error">*</span>
                                    </span>
                                </label>
                                <div class="relative">
                                    <input type="number" name="price" id="price" placeholder="0"
                                        class="input input-bordered w-full pl-8 focus:input-primary @error('price') input-error @enderror"
                                        value="{{ old('price', $viewData['supplement']->getPrice()) }}" min="0">
                                    <span
                                        class="absolute left-3 top-1/2 transform -translate-y-1/2 text-base-content opacity-60">$</span>
                                </div>
                                @error('price')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control w-full">
                                <label class="label" for="stock">
                                    <span class="label-text text-base-content font-medium">
                                        {{ trans('admin/admin.stock') }} <span class="text-error">*</span>
                                    </span>
                                </label>
                                <input type="number" name="stock" id="stock" placeholder="0"
                                    class="input input-bordered w-full focus:input-primary @error('stock') input-error @enderror"
                                    value="{{ old('stock', $viewData['supplement']->getStock()) }}" min="0">
                                @error('stock')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control w-full">
                                <label class="label" for="flavour">
                                    <span class="label-text text-base-content font-medium">
                                        {{ trans('admin/admin.flavour') }} <span class="text-error">*</span>
                                    </span>
                                </label>
                                <input type="text" name="flavour" id="flavour"
                                    placeholder="{{ trans('admin/admin.enter_flavour') }}"
                                    class="input input-bordered w-full focus:input-primary @error('flavour') input-error @enderror"
                                    value="{{ old('flavour', $viewData['supplement']->getFlavour()) }}">
                                @error('flavour')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control w-full">
                                <label class="label" for="expiration_date">
                                    <span class="label-text text-base-content font-medium">
                                        {{ trans('admin/admin.expiration_date') }} <span class="text-error">*</span>
                                    </span>
                                </label>
                                <input type="date" name="expiration_date" id="expiration_date"
                                    class="input input-bordered w-full focus:input-primary @error('expiration_date') input-error @enderror"
                                    value="{{ old('expiration_date', $viewData['supplement']->getExpirationDate()->format('Y-m-d')) }}">
                                @error('expiration_date')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>
                        </div>

                        <div class="form-control w-full">
                            <label class="label" for="description">
                                <span class="label-text text-base-content font-medium">
                                    {{ trans('admin/admin.description') }} <span class="text-error">*</span>
                                </span>
                            </label>
                            <textarea name="description" id="description" rows="4"
                                placeholder="{{ trans('admin/admin.enter_description') }}"
                                class="textarea textarea-bordered w-full focus:textarea-primary @error('description') textarea-error @enderror">{{ old('description', $viewData['supplement']->getDescription()) }}</textarea>
                            @error('description')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

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
                                @foreach ($viewData['categories'] as $category)
                                    <label
                                        class="label cursor-pointer justify-start gap-3 p-3 rounded-lg border border-neutral/40 hover:bg-base-200 transition-colors">
                                        <input type="checkbox" name="categories[]" value="{{ $category->getId() }}"
                                            class="checkbox checkbox-primary checkbox-sm"
                                            {{ in_array($category->getId(), old('categories', $viewData['selectedCategories'])) ? 'checked' : '' }}>
                                        <span
                                            class="label-text text-base-content text-sm">{{ $category->getName() }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('categories')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="divider divider-start">
                            <span class="text-lg font-semibold text-primary">{{ trans('admin/admin.image') }}</span>
                        </div>

                        <div class="form-control w-full">
                            <label class="label">
                                <span
                                    class="label-text text-base-content font-medium">{{ trans('admin/admin.product_image') }}</span>
                                <span
                                    class="label-text-alt text-base-content opacity-60">{{ trans('admin/admin.optional') }}</span>
                            </label>

                            @if ($viewData['supplement']->getImagePath())
                                <div class="mb-4">
                                    <div class="flex flex-col md:flex-row items-start gap-4">
                                        <img src="{{ asset('storage/' . $viewData['supplement']->getImagePath()) }}"
                                            alt="{{ $viewData['supplement']->getName() }}"
                                            class="h-32 w-auto object-contain border rounded">
                                        <div>
                                            <p class="font-medium">{{ trans('admin/admin.current_image') }}</p>
                                            <div class="flex items-center mt-2">
                                                <label class="flex items-center space-x-2 cursor-pointer">
                                                    <input type="checkbox" name="remove_image" value="1"
                                                        class="checkbox checkbox-error checkbox-sm">
                                                    <span class="label-text">Eliminar imagen</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div>
                                <label class="label" for="image">
                                    <span
                                        class="label-text">{{ $viewData['supplement']->getImagePath() ? 'Reemplazar imagen' : 'Subir imagen' }}</span>
                                </label>
                                <input type="file" id="image" name="image" accept="image/*"
                                    class="file-input file-input-bordered w-full @error('image') file-input-error @enderror">
                                <p class="text-xs text-base-content/60 mt-2">Formatos: JPG, PNG, GIF. Tamaño máximo: 2MB.
                                </p>
                            </div>

                            @error('image')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="divider divider-start">
                            <span class="text-lg font-semibold text-primary">{{ trans('admin/admin.ingredients') }}</span>
                        </div>

                        <div class="form-control w-full">
                            <label class="label" for="ingredients">
                                <span class="label-text text-base-content font-medium">
                                    {{ trans('admin/admin.ingredients_description') }} <span class="text-error">*</span>
                                </span>
                            </label>
                            <textarea name="ingredients" id="ingredients" rows="4"
                                placeholder="{{ trans('admin/admin.enter_ingredients') }}"
                                class="textarea textarea-bordered w-full focus:textarea-primary @error('ingredients') textarea-error @enderror">{{ old('ingredients', $viewData['supplement']->getIngredients()) }}</textarea>
                            @error('ingredients')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>

                        <div class="divider"></div>
                        <div
                            class="sticky bottom-4 bg-base-100/80 backdrop-blur rounded-xl border border-neutral/20 p-4 flex flex-col sm:flex-row gap-4 justify-end shadow">
                            <a href="{{ route('admin.supplements.index') }}"
                                class="btn btn-ghost">{{ trans('admin/admin.cancel') }}</a>
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                {{ trans('admin/admin.update_supplement') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        @vite(entrypoints: ['resources/js/admin/supplements/edit.js'])
    @endpush
@endsection
