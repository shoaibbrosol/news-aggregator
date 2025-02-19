<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }
        if ($request->has('source')) {
            $query->where('source', $request->source);
        }
        if ($request->has('author')) {
            $query->where('author', $request->author);
        }

        return response()->json($query->paginate(10));
    }

    public function search(Request $request)
    {
        $query = Article::query();

        if ($request->has('q')) {
            $query->where('title', 'LIKE', "%{$request->q}%")
                ->orWhere('description', 'LIKE', "%{$request->q}%");
        }

        return response()->json($query->paginate(10));
    }
}

