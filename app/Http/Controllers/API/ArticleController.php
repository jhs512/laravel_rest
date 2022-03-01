<?php

namespace App\Http\Controllers\API;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
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

        $articles = $articles->paginate(30)->withQueryString();

        return new ArticleCollection($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleSaveRequest $request)
    {
        $validated = $request->validated();
        $article = new Article();
        $article->user_id = auth()->user()->id;
        $article->title = $validated['title'];
        $article->body = $validated['body'];

        if ($request->hasFile('img_1')) {
            $article->img_1 = $request->file('img_1')->store('article/' . date('Y/m/d'), 'public');
        }

        $article->save();

        return response()->json(['resultCode' => 'S-1', 'msg' => '생성되었습니다.'], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return new ArticleResource($article);
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

        return response()->json(['resultCode' => 'S-1', 'msg' => '수정되었습니다.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        if ($article->img_1) {
            Storage::disk('public')->delete($article->img_1);
        }

        $article->delete();

        return response()->json(['resultCode' => 'S-1', 'msg' => '삭제되었습니다.']);
    }
}
