<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected CategoryRepositoryInterface $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $categories = $this->categoryRepo->all();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->categoryRepo->create($data);

        return redirect()->route('categories.index')->with('success', 'Category added successfully.');
    }

    public function show(string $id)
    {
        $category = $this->categoryRepo->find($id);

        return view('categories.show', compact('category'));
    }

    public function edit(string $id)
    {
        $category = $this->categoryRepo->find($id);

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->categoryRepo->update($id, $data);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(string $id)
    {
        $this->categoryRepo->delete($id);

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
