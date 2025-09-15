<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterSupplementRequest;
use App\Http\Requests\CreateSupplementRequest;
use App\Http\Requests\UpdateSupplementRequest;
use App\Models\Category;
use App\Models\Supplement;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\View\View;

class AdminSupplementController extends Controller
{
    // Is a best practice to use middleware for authentication and authorization here or on routes?
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

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

        $supplementsPaginated = $query->paginate(
            $request->input('per_page'),
            ['*'],
            'page',
            $request->input('page')
        );

        $supplements = $supplementsPaginated->items();
        $totalPages = $supplementsPaginated->lastPage();
        $currentPage = $supplementsPaginated->currentPage();
        $elementsPerPage = $request->input('per_page');

        $viewData = [];
        $viewData['categories'] = Category::all();
        $viewData['supplements'] = $supplements;
        $viewData['per_page'] = $elementsPerPage;
        $viewData['total_pages'] = $totalPages;
        $viewData['current_page'] = $currentPage;

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
        $newSupplement = new Supplement();
        $newSupplement->setName($request->input('name'));
        $newSupplement->setDescription($request->input('description'));
        $newSupplement->setLaboratory($request->input('laboratory'));
        $newSupplement->setImages($request->input('images'));
        $newSupplement->setPrice($request->input('price'));
        $newSupplement->setStock($request->input('stock'));
        $newSupplement->setFlavour($request->input('flavour'));
        $newSupplement->setExpirationDate($request->input('expiration_date'));
        $newSupplement->setIngredients($request->input('ingredients'));
        $newSupplement->save();

        $newSupplement->categories()->attach($request->input('categories'));

        return redirect()->route('admin.supplements.index')->with('success', trans('admin/admin.success_supplement_created'));
    }

    public function delete(int $id): RedirectResponse   
    {
        $supplement = Supplement::find($id);
        if ($supplement) {
            $supplement->delete();
            return redirect()->route('admin.supplements.index')->with('success', trans('admin/admin.success_supplement_deleted'));
        } else {
            return redirect()->route('admin.supplements.index')->with('error', trans('admin/admin.failed_supplement_not_found'));
        }
    }
    
    public function edit(int $id): mixed
    {
        $supplement = Supplement::with('categories')->find($id);

        if (!$supplement) {
            return redirect()->route('admin.supplements.index')->with('error', trans('admin/admin.failed_supplement_not_found'));
        }

        $viewData = [];
        $viewData['categories'] = Category::all();
        $viewData['supplement'] = $supplement;

        return view('admin.supplements.edit')->with('viewData', $viewData);
    }

    public function update(UpdateSupplementRequest $request, int $id): RedirectResponse
    {
        $supplement = Supplement::find($id);
        if ($supplement) {
            // When the save picture functionality is implemented, handle image uploads here and on the model
            $supplement->fill($request->validated());

            if ($request->has('categories') && is_array($request->input('categories'))) {
                $supplement->categories()->sync($request->input('categories'));
            }

            $supplement->save();

            return redirect()->route('admin.supplements.index')->with('success', trans('admin/admin.success_supplement_updated'));
        } else {
            return redirect()->route('admin.supplements.index')->with('error', trans('admin/admin.failed_supplement_not_found'));
        }
    }
}


