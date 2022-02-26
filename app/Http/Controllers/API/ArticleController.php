<?php

namespace App\Http\Controllers\API;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ArticleSaveRequest;
use App\Http\Resources\ArticleCollection;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = Article::with('user')->with('logined_user_reaction_points')->orderBy('id', 'desc');

        if ($request->input('search_keyword')) {
            $articles = $articles->where('title', 'like', "%{$request->input('search_keyword')}%");
            $articles = $articles->orWhere('body', 'like', "%{$request->input('search_keyword')}%");
        }

        $articles = $articles->paginate(3)->withQueryString();

        return new ArticleCollection($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleSaveRequest $request, Article $article)
    {
        $validated = $request->validated();

        $article->title = $validated['title'];
        $article->body = $validated['body'];

        if (isset($validated['img_1__remove'])) {
            if ($article->img_1) {
                Storage::disk('public')->delete($article->img_1);
            }
            $article->img_1 = null;
        }

        if ($request->hasFile('img_1')) {
            if ($article->img_1) {
                Storage::disk('public')->delete($article->img_1);
            }

            $article->img_1 = $request->file('img_1')->store('article/' . date('Y/m/d'), 'public');
        }

        $article->save();

        response()->json(['success' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
