<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterSupplementRequest;
use App\Models\Category;
use App\Models\Supplement;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SupplementController extends Controller
{
    public function __construct() {}

    public function index(FilterSupplementRequest $request): View
    {
        $query = Supplement::query();

        $query->filter(
            $request->input('category_id'),
            $request->input('min_price'),
            $request->input('max_price'),
            $request->input('in_stock')
        );

        if ($request->has('search')) {
            $query->search($request->input('search'));
        }

        if ($request->has('order_by')) {
            $query->sortBy($request->input('order_by'));
        }

        $query->with(['reviews', 'categories']);

        $elementsPerPage = (int) $request->input('per_page', 8);

        $supplementsPaginated = $query->paginate(
            $elementsPerPage,
            ['*'],
            'page',
            $request->input('page')
        );

        $supplements = $supplementsPaginated->items();
        $totalPages = $supplementsPaginated->lastPage();
        $currentPage = $supplementsPaginated->currentPage();
        $currentItemsCount = $supplementsPaginated->count();
        $totalResults = $supplementsPaginated->total();
        $categories = Category::all();

        $filters = $request->only([
            'search',
            'category_id',
            'min_price',
            'max_price',
            'in_stock',
            'order_by',
            'per_page',
        ]);
        $hasFilters = collect($filters)
            ->filter(fn ($value) => ! is_null($value) && $value !== '')
            ->isNotEmpty();

        $viewData = [];
        $viewData['categories'] = $categories;
        $viewData['supplements'] = $supplements;
        $viewData['per_page'] = $elementsPerPage;
        $viewData['total_pages'] = $totalPages;
        $viewData['current_page'] = $currentPage;
        $viewData['current_items_count'] = $currentItemsCount;
        $viewData['has_filters'] = $hasFilters;
        $viewData['total_results'] = $totalResults;

        return view('supplements.index')->with('viewData', $viewData);
    }

    public function show(int $id, int $page): View|RedirectResponse
    {
        $supplement = Supplement::with('categories')->find($id);
        $per_page = 6;

        if (! $supplement) {
            $viewData = [];
            $viewData['error'] = trans('admin/admin.failed_supplement_not_found');

            return redirect()->route('supplements.index')->with('viewData', $viewData);
        }

        $paginatedReviews = $supplement->reviews()
            ->with('user')
            ->where('status', true)
            ->orderBy('created_at', 'desc')
            ->paginate(
                $per_page,
                ['*'],
                'page',
                $page
            );

        $viewData = [];
        $viewData['supplement'] = $supplement;
        $viewData['categories'] = $supplement->getCategories();
        $viewData['averageRating'] = $supplement->getAverageRating();
        $viewData['reviews'] = $paginatedReviews->items();
        $viewData['per_page'] = $per_page;
        $viewData['total_pages'] = $paginatedReviews->lastPage();
        $viewData['current_page'] = $paginatedReviews->currentPage();

        return view('supplements.show')->with('viewData', $viewData);
    }
}
