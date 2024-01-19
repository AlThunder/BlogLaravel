<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\BlogCategory;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paginator = BlogCategory::paginate();

        return view('blog.admin.category.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        dd(__METHOD__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd(__METHOD__);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = BlogCategory::findOrFail($id);
        $categoryList = BlogCategory::all();

        return view('blog.admin.category.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd(__METHOD__);
    }
}
