<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSupplementRequest;
use App\Http\Requests\FilterSupplementRequest;
use App\Http\Requests\UpdateSupplementRequest;
use App\Interfaces\ImageStorage;
use App\Models\Category;
use App\Models\Supplement;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminSupplementController extends Controller
{
    private $imageStorage;

    public function __construct(ImageStorage $imageStorage)
    {
        $this->imageStorage = $imageStorage;
        // Is a best practice to use middleware for authentication and authorization here or on routes?
        // $this->middleware('auth');
    }

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

        // For avoid the N + 1 problem
        $query->with(['reviews', 'categories']);

        $elementsPerPage = (int) $request->input('per_page', 4);

        $supplementsPaginated = $query->paginate(
            $elementsPerPage,
            ['*'],
            'page',
            $request->input('page')
        );

        $supplements = $supplementsPaginated->items();
        $totalPages = $supplementsPaginated->lastPage();
        $currentPage = $supplementsPaginated->currentPage();

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
        $viewData['categories'] = Category::all();
        $viewData['supplements'] = $supplements;
        $viewData['per_page'] = $elementsPerPage;
        $viewData['total_pages'] = $totalPages;
        $viewData['current_page'] = $currentPage;
        $viewData['has_filters'] = $hasFilters;

        return view('admin.supplements.index')->with('viewData', $viewData);
    }

    public function create()
    {
        $viewData = [];
        $viewData['categories'] = Category::all();

        return view('admin.supplements.create')->with('viewData', $viewData);
    }

    public function store(CreateSupplementRequest $request): RedirectResponse
    {
        $newSupplement = new Supplement;
        $newSupplement->setName($request->input('name'));
        $newSupplement->setDescription($request->input('description'));
        $newSupplement->setLaboratory($request->input('laboratory'));
        $newSupplement->setPrice($request->input('price'));
        $newSupplement->setStock($request->input('stock'));
        $newSupplement->setFlavour($request->input('flavour'));
        $newSupplement->setExpirationDate($request->input('expiration_date'));
        $newSupplement->setIngredients($request->input('ingredients'));

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $this->imageStorage->store($request->file('image'), 'supplements');
            if ($imagePath) {
                $newSupplement->setImagePath($imagePath);
            }
        }

        $newSupplement->save();
        $newSupplement->categories()->attach($request->input('categories'));

        $viewData = [];
        $viewData['success'] = trans('admin/admin.success_supplement_created');

        return redirect()->route('admin.supplements.index')->with('viewData', $viewData);
    }

    public function delete(int $id): RedirectResponse
    {
        $supplement = Supplement::find($id);
        $viewData = [];

        if ($supplement) {
            $imagePath = $supplement->getImagePath();
            if ($imagePath) {
                $this->imageStorage->delete($imagePath);
            }

            $supplement->delete();
            $viewData['success'] = trans('admin/admin.success_supplement_deleted');

            return redirect()->route('admin.supplements.index')->with('viewData', $viewData);
        } else {
            $viewData['error'] = trans('admin/admin.failed_supplement_not_found');

            return redirect()->route('admin.supplements.index')->with('viewData', $viewData);
        }
    }

    public function edit(int $id): View|RedirectResponse
    {
        $supplement = Supplement::with('categories')->find($id);
        $viewData = [];

        if (! $supplement) {
            $viewData['error'] = trans('admin/admin.failed_supplement_not_found');

            return redirect()->route('admin.supplements.index')->with('viewData', $viewData);
        }

        $viewData['categories'] = Category::all();
        $viewData['supplement'] = $supplement;
        $viewData['selectedCategories'] = $supplement->getCategories()->pluck('id')->toArray();

        return view('admin.supplements.edit')->with('viewData', $viewData);
    }

    public function update(UpdateSupplementRequest $request, int $id): RedirectResponse
    {
        $supplement = Supplement::find($id);
        $viewData = [];

        if (! $supplement) {
            $viewData['error'] = trans('admin/admin.failed_supplement_not_found');

            return redirect()->route('admin.supplements.edit')->with('viewData', $viewData);
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $oldImagePath = $supplement->getImagePath();
            if ($oldImagePath) {
                $this->imageStorage->delete($oldImagePath);
            }

            $imagePath = $this->imageStorage->store($request->file('image'), 'supplements');
            if ($imagePath) {
                $supplement->setImagePath($imagePath);
            }
        } elseif ($request->has('remove_image') && $request->input('remove_image')) {
            $oldImagePath = $supplement->getImagePath();
            if ($oldImagePath) {
                $this->imageStorage->delete($oldImagePath);
                $supplement->setImagePath(null);
            }
        }

        $validatedData = $request->validated();
        unset($validatedData['image'], $validatedData['remove_image']);
        $supplement->fill($validatedData);

        if ($request->has('categories') && is_array($request->input('categories'))) {
            $supplement->categories()->sync($request->input('categories'));
        }

        $supplement->save();
        $viewData['success'] = trans('admin/admin.success_supplement_updated');

        return redirect()->route('admin.supplements.index')->with('viewData', $viewData);
    }
}
