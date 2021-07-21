<?php

namespace App\Http\Traits;
use App\Models\Category;
trait DataTraits
{

    // all category data 
    public function index()
    {
        $category=Category::all();
        return view('admin.category.index')->with(compact('category'));
    }
}

