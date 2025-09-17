<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryResquest;
use App\Http\Requests\UpdateCategoryResquest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminCategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();

        $viewData = [];
        $viewData['categories'] = $categories;

        return view('admin.categories.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(CreateCategoryResquest $request): RedirectResponse
    {
        $category = new Category;
        $category->setName($request->input('name'));
        $category->setDescription($request->input('description'));

        $category->save();

        return redirect()->route('admin.categories.index')->with('success', trans('admin/admin.success_category_created'));
    }

    public function delete(int $id): RedirectResponse
    {
        $category = Category::find($id);
        if (! $category) {
            return redirect()->route('admin.categories.index')->with('error', trans('admin/admin.category_not_found'));
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', trans('admin/admin.success_category_deleted'));
    }

    public function edit(int $id): mixed
    {
        $category = Category::find($id);

        if (! $category) {
            return redirect()->route('admin.categories.index')->with('error', trans('admin/admin.category_not_found'));
        }

        $viewData = [];
        $viewData['category'] = $category;

        return view('admin.categories.edit')->with('viewData', $viewData);
    }

    public function update(UpdateCategoryResquest $request, int $id): RedirectResponse
    {
        $category = Category::find($id);

        if (! $category) {
            return redirect()->route('admin.categories.index')->with('error', trans('admin/admin.category_not_found'));
        }

        $category->fill($request->validated());
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', trans('admin/admin.success_category_updated'));
    }
}
