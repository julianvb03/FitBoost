@extends('layouts.app')

@section('title', $viewData['supplement']->getName())

@section('content')

    <div class="container mx-auto px-4 py-6">
        <div class="breadcrumbs text-sm mb-6">
            <ul>
                <li><a href="#" class="text-primary hover:text-primary-focus">Inicio</a></li>
                <li><a href="{{ route('supplements.index') }}" class="text-primary hover:text-primary-focus">Suplementos</a>
                </li>
                <li class="text-base-content/70">{{ $viewData['supplement']->getName() }}</li>
            </ul>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <div class="space-y-4">
                <div class="aspect-square w-full bg-base-200 rounded-lg overflow-hidden shadow-lg">
                    @if ($viewData['supplement']->getImagePath())
                        <img src="{{ asset('storage/' . $viewData['supplement']->getImagePath()) }}"
                            alt="{{ $viewData['supplement']->getName() }}"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-300" />
                    @else
                        <div class="w-full h-full flex items-center justify-center text-base-content/40">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                </div>

                <div class="flex justify-center">
                    @if ($viewData['supplement']->getStock() > 0)
                        <div class="badge badge-success badge-lg font-medium px-4 py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Disponible - Stock: {{ $viewData['supplement']->getStock() }}
                        </div>
                    @else
                        <div class="badge badge-error badge-lg font-medium px-4 py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Producto Agotado
                        </div>
                    @endif
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <h1 class="text-4xl font-bold text-base-content mb-2">{{ $viewData['supplement']->getName() }}</h1>
                    <p class="text-lg text-base-content/70">{{ $viewData['supplement']->getLaboratory() }}</p>
                </div>

                <div class="flex items-center gap-4">
                    <div class="rating rating-lg">
                        @for ($i = 1; $i <= 5; $i++)
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

                <div class="space-y-4">
                    @if ($viewData['supplement']->getFlavour())
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/60" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                            </svg>
                            <span class="font-medium text-base-content">Sabor:</span>
                            <span class="text-base-content/80">{{ $viewData['supplement']->getFlavour() }}</span>
                        </div>
                    @endif

                    @if (count($viewData['categories']) > 0)
                        <div class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/60 mt-0.5"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            <div>
                                <span class="font-medium text-base-content">Categorías:</span>
                                <div class="flex flex-wrap gap-2 mt-1">
                                    @foreach ($viewData['categories'] as $category)
                                        <div class="badge badge-primary badge-outline">{{ $category->getName() }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="pt-4">
                    @if ($viewData['supplement']->getStock() > 0)
                        <form method="POST" action="{{ route('cart.items.store') }}" class="grid grid-cols-4 gap-3">
                            @csrf
                            <input type="hidden" name="supplement_id" value="{{ $viewData['supplement']->getId() }}" />
                            <div class="flex flex-col gap-2">
                                <div class="">
                                    <label class="label">
                                        <span class="label-text">Cantidad</span>
                                    </label>
                                </div>
                                <div class="join">
                                    <input type="number" name="quantity" min="1" max="99" value="1"
                                        class="input join-item w-20" placeholder="Cantidad" />
                                    <button class="btn btn-primary join-item rounded-r-md">Agregar al Carrito
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-shopping-cart-icon lucide-shopping-cart">
                                            <circle cx="8" cy="21" r="1" />
                                            <circle cx="19" cy="21" r="1" />
                                            <path
                                                d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                        <button class="btn btn-disabled btn-lg w-full" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728" />
                            </svg>
                            Producto No Disponible
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <div class="bg-base-100 rounded-lg shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold text-base-content mb-6">Descripción del Producto</h2>
            <div class="prose max-w-none">
                <p class="text-base-content/80 leading-relaxed text-lg">
                    {{ $viewData['supplement']->getDescription() }}
                </p>
            </div>
        </div>

        <div class="bg-base-100 rounded-lg shadow-lg p-8">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-base-content">
                    Reseñas de Clientes
                    <span class="text-base-content/60 font-normal text-lg ml-2">
                        ({{ count($viewData['supplement']->reviews) }})
                    </span>
                </h2>

                <div class="flex items-center gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-primary mb-1">
                            {{ number_format($viewData['averageRating'], 1) }}
                        </div>
                        <div class="rating rating-sm">
                            @for ($i = 1; $i <= 5; $i++)
                                <input type="radio" class="mask mask-star-2 bg-warning pointer-events-none"
                                    {{ $i <= $viewData['averageRating'] ? 'checked' : '' }} />
                            @endfor
                        </div>
                        <div class="text-xs text-base-content/60 mt-1">Promedio</div>
                    </div>

                    @auth
                        <button type="button" class="btn btn-primary" data-modal-open="createReviewModal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Escribir Reseña
                        </button>
                    @endauth
                </div>
            </div>

            @if (count($viewData['reviews']) > 0)
                <div class="space-y-6 mb-8">
                    @foreach ($viewData['reviews'] as $review)
                        <div class="border-b border-neutral/20 pb-6 last:border-b-0 last:pb-0"
                            id="review-{{ $review->getId() }}">
                            <div class="flex items-start gap-4">
                                <div class="placeholder">
                                    <div
                                        class="bg-neutral text-neutral-content rounded-full w-12 h-12 flex items-center justify-center">
                                        <span class="text-sm font-medium">
                                            {{ strtoupper(substr($review->getUserName(), 0, 2)) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center gap-3">
                                            <h4 class="font-semibold text-base-content">{{ $review->getUserName() }}</h4>
                                            <div class="rating rating-sm">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <input type="radio"
                                                        class="mask mask-star-2 bg-warning pointer-events-none"
                                                        {{ $i <= $review->getRating() ? 'checked' : '' }} />
                                                @endfor
                                            </div>
                                            <span class="text-sm text-base-content/60">
                                                {{ $review->getCreatedAt()->diffForHumans() }}
                                            </span>
                                            @if ($review->getUpdatedAt() && $review->getUpdatedAt() != $review->getCreatedAt())
                                                <div class="badge badge-sm badge-info">Editada</div>
                                            @endif
                                        </div>

                                        @auth
                                            <div class="dropdown dropdown-end">
                                                <div tabindex="0" role="button" class="btn btn-ghost btn-sm btn-circle">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M12 5v.01M12 12v.01M12 19v.01" />
                                                    </svg>
                                                </div>
                                                <ul tabindex="0"
                                                    class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow border border-base-300">
                                                    @if (Auth::user()->getId() == $review->getUserId())
                                                        <li>
                                                               <button type="button"
                                                                   class="text-blue-600 hover:text-blue-800"
                                                                   data-review-edit
                                                                   data-review-edit-url="{{ url('reviews/' . $review->getId()) }}"
                                                                   data-review-rating="{{ $review->getRating() }}"
                                                                   data-review-comment="{{ e($review->getComment()) }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                </svg>
                                                                Editar Reseña
                                                            </button>
                                                        </li>
                                                        <li>
                                                           <button type="button"
                                                               class="text-red-600 hover:text-red-800"
                                                               data-review-delete
                                                               data-review-delete-url="{{ url('reviews/' . $review->getId()) }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                                Eliminar Reseña
                                                            </button>
                                                        </li>
                                                    @else
                                                        <li>
                                                               <button type="button"
                                                                   class="text-orange-600 hover:text-orange-800"
                                                                   data-review-report
                                                                   data-review-report-url="{{ url('reviews/' . $review->getId() . '/report') }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                                                </svg>
                                                                Reportar Reseña
                                                            </button>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        @endauth
                                    </div>

                                    <p class="text-base-content/80 leading-relaxed">
                                        {{ $review->getComment() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($viewData['total_pages'] > 1)
                    <div class="flex justify-center pt-6 border-t border-neutral/20">
                        <div class="join shadow">
                            @if ($viewData['current_page'] > 1)
                                <a href="{{ route('supplements.show', ['id' => $viewData['supplement']->getId(), 'page' => 1]) }}"
                                    class="join-item btn btn-sm hover:btn-primary">
                                    Primera
                                </a>
                            @else
                                <button class="join-item btn btn-sm btn-disabled">Primera</button>
                            @endif

                            @if ($viewData['current_page'] > 1)
                                <a href="{{ route('supplements.show', ['id' => $viewData['supplement']->getId(), 'page' => $viewData['current_page'] - 1]) }}"
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

                            @for ($i = max(1, $viewData['current_page'] - 2); $i <= min($viewData['total_pages'], $viewData['current_page'] + 2); $i++)
                                <a href="{{ route('supplements.show', ['id' => $viewData['supplement']->getId(), 'page' => $i]) }}"
                                    class="join-item btn btn-sm {{ $i == $viewData['current_page'] ? 'btn-active btn-primary' : 'hover:btn-primary' }}">
                                    {{ $i }}
                                </a>
                            @endfor

                            @if ($viewData['current_page'] < $viewData['total_pages'])
                                <a href="{{ route('supplements.show', ['id' => $viewData['supplement']->getId(), 'page' => $viewData['current_page'] + 1]) }}"
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

                            @if ($viewData['current_page'] < $viewData['total_pages'])
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
                <div class="text-center py-12">
                    <div class="max-w-sm mx-auto">
                        <div class="mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-base-content/30"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-base-content mb-2">Sin reseñas aún</h3>
                        <p class="text-base-content/70 mb-6">
                            Este producto aún no tiene reseñas. ¡Sé el primero en compartir tu experiencia!
                        </p>
                        @auth
                            <button type="button" class="btn btn-primary btn-outline" data-modal-open="createReviewModal">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                                Escribir Reseña
                            </button>
                        @else
                            <div class="text-center">
                                <p class="text-base-content/60 mb-4">Inicia sesión para escribir una reseña</p>
                                <a href="{{ route('auth.login') }}" class="btn btn-primary btn-outline">Iniciar Sesión</a>
                            </div>
                        @endauth
                    </div>
                </div>
            @endif
        </div>

        <div class="flex justify-center mt-8">
            <a href="{{ route('supplements.index') }}" class="btn btn-ghost btn-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Volver al Catálogo
            </a>
        </div>
    </div>

    @auth
        <dialog id="createReviewModal" class="modal">
            <div class="modal-box">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>

                <h3 class="font-bold text-lg mb-6">Escribir Reseña</h3>

                <form action="{{ route('reviews.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="supplement_id" value="{{ $viewData['supplement']->getId() }}">

                    <div class="space-y-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Calificación</span>
                            </label>
                            <div class="flex items-center gap-2">
                                <div class="rating rating-lg">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <input type="radio" name="rating" value="{{ $i }}"
                                            class="mask mask-star-2 bg-warning" {{ $i == 5 ? 'checked' : '' }} />
                                    @endfor
                                </div>
                                <span class="text-sm text-base-content/60">Selecciona de 1 a 5 estrellas</span>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Comentario</span>
                            </label>
                            <textarea name="comment" class="textarea textarea-bordered h-32"
                                placeholder="Comparte tu experiencia con este producto..." maxlength="500" required></textarea>
                            <div class="label">
                                <span class="label-text-alt text-base-content/60">Máximo 500 caracteres</span>
                            </div>
                        </div>

                        <div class="flex gap-3 pt-4">
                            <button type="submit" class="btn btn-primary flex-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Publicar Reseña
                            </button>
                            <button type="button" class="btn btn-ghost flex-1" data-modal-close="createReviewModal">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </dialog>

        <dialog id="editReviewModal" class="modal">
            <div class="modal-box">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>

                <h3 class="font-bold text-lg mb-6">Editar Reseña</h3>

                <form id="editReviewForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Calificación</span>
                            </label>
                            <div class="flex items-center gap-2">
                                <div class="rating rating-lg">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <input type="radio" name="rating" value="{{ $i }}"
                                            class="mask mask-star-2 bg-warning" id="edit-rating-{{ $i }}" />
                                    @endfor
                                </div>
                                <span class="text-sm text-base-content/60">Selecciona de 1 a 5 estrellas</span>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium">Comentario</span>
                            </label>
                            <textarea id="editComment" name="comment" class="textarea textarea-bordered h-32"
                                placeholder="Comparte tu experiencia con este producto..." maxlength="500" required></textarea>
                            <div class="label">
                                <span class="label-text-alt text-base-content/60">Máximo 500 caracteres</span>
                            </div>
                        </div>

                        <div class="flex gap-3 pt-4">
                            <button type="submit" class="btn btn-primary flex-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Actualizar Reseña
                            </button>
                            <button type="button" class="btn btn-ghost flex-1" data-modal-close="editReviewModal">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </dialog>

        <dialog id="deleteReviewModal" class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg text-error mb-4">Eliminar Reseña</h3>
                <p class="text-base-content/80 mb-6">
                    ¿Estás seguro de que deseas eliminar tu reseña? Esta acción no se puede deshacer.
                </p>

                <div class="flex gap-3">
                    <form id="deleteReviewForm" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-error w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Eliminar
                        </button>
                    </form>
                    <button type="button" class="btn btn-ghost flex-1" data-modal-close="deleteReviewModal">
                        Cancelar
                    </button>
                </div>
            </div>
        </dialog>

        <dialog id="reportReviewModal" class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg text-warning mb-4">Reportar Reseña</h3>
                <p class="text-base-content/80 mb-6">
                    ¿Deseas reportar esta reseña? Los administradores revisarán el contenido para determinar si viola nuestras
                    políticas.
                </p>

                <div class="flex gap-3">
                    <form id="reportReviewForm" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="btn btn-warning w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                            Reportar
                        </button>
                    </form>
                    <button type="button" class="btn btn-ghost flex-1" data-modal-close="reportReviewModal">
                        Cancelar
                    </button>
                </div>
            </div>
        </dialog>
    @endauth

    @push('scripts')
        @vite(entrypoints: ['resources/js/supplements/show.js'])
    @endpush
@endsection
