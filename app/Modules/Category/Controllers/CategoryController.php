<?php
namespace App\Modules\Category\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Category\Requests\StoreCategoryRequest;
use App\Modules\Category\Requests\UpdateCategoryRequest;
use App\Modules\Category\Services\CategoryService;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService) {}

    public function index()
    {
        $categories = $this->categoryService->all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->categoryService->create($request->validated());
        return redirect()->route('categories.index')->with('success', 'Category added successfully.');
    }

    public function show(string $id)
    {
        $category = $this->categoryService->find($id);
        return view('categories.show', compact('category'));
    }

    public function edit(string $id)
    {
        $category = $this->categoryService->find($id);
        return view('categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, string $id)
    {
        $this->categoryService->update($id, $request->validated());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(string $id)
    {
        $this->categoryService->delete($id);
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
