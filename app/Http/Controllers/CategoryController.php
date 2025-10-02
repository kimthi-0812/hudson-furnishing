<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Section;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index()
    {
        $categories = Category::with('section')->get();
        $sections = Section::all();

        return view('pages.categories.index', compact('categories', 'sections'));
    }
}
