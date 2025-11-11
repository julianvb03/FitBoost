@extends('layouts.admin')

@section('title', trans('admin/home.title'))

@section('content')
	<div class="space-y-8">
		<header class="flex flex-col gap-2">
			<h1 class="text-3xl font-bold text-base-content">{{ trans('admin/home.welcome') }}</h1>
			<p class="max-w-2xl text-base-content/70">
				{{ trans('admin/home.description') }}
			</p>
		</header>

		<section class="grid gap-6 md:grid-cols-2">
			<a href="{{ route('admin.supplements.index') }}" class="block rounded-2xl border border-base-300 bg-base-100 p-6 shadow transition hover:shadow-lg">
				<div class="flex items-center justify-between">
					<div>
						<h2 class="text-xl font-semibold text-base-content">{{ trans('admin/home.supplements') }}</h2>
						<p class="mt-2 text-sm text-base-content/70">{{ trans('admin/home.supplements_description') }}</p>
					</div>
					<span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-primary/10 text-primary">
						<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v12m6-6H6" />
						</svg>
					</span>
				</div>
			</a>

			<a href="{{ route('admin.categories.index') }}" class="block rounded-2xl border border-base-300 bg-base-100 p-6 shadow transition hover:shadow-lg">
				<div class="flex items-center justify-between">
					<div>
						<h2 class="text-xl font-semibold text-base-content">{{ trans('admin/home.categories') }}</h2>
						<p class="mt-2 text-sm text-base-content/70">{{ trans('admin/home.categories_description') }}</p>
					</div>
					<span class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-primary/10 text-primary">
						<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 7h16M4 12h16M4 17h10" />
						</svg>
					</span>
				</div>
			</a>
		</section>
	</div>
@endsection
