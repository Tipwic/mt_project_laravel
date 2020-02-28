<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;
use App\Http\Resources\Article as ArticleResource;
use Validator;

class ArticleController extends Controller
{
  public function index()
  {
      $articles = Article::all()->paginate(10);
      return response()->json($this->respondWithPaginate($article), 201);
  }

  public function getArticles(Request $request)
  {
        $articles = Article::where('owner_id', '=', $request->owner_id)
        ->where('category', '=', $request->category)
        ->paginate(10);

        $dataRes = ArticleResource::collection($articles);
        unset($articles->data);


        return response()->json($this->respondWithPaginate($articles, $dataRes), 201);
  }

  public function show($id)
  {
      $article = Article::find($id);
      return (new ArticleResource($article))->response()->setStatusCode(201);
  }

  public function store(Request $request)
  {
    if ($this->valiForm($request)){
        return (new ArticleResource($article))->response()->setStatusCode(201);
    }

    $article = Article::create($request->all());
    return (new ArticleResource($article))->response()->setStatusCode(201);
  }

  public function update(Request $request, $id)
  {
    if ($this->valiForm($request)){
        return response()->json($validator->errors());
    }

    $article = Article::findOrFail($id);
    $article->update($request->all());
    return (new ArticleResource($article))->response()->setStatusCode(201);
  }

  public function delete(Request $request, $id)
  {
      $article = Article::findOrFail($id);
      $article->delete();
      return response()->json(['id' => $id], 204);
  }

  public function valiForm(Request $request){
    $validator = Validator::make($request->all(), [
        'title' => 'required',
        'content' => 'required',
        'type'=> 'required',
        'category' => 'required'
    ]);
    return $validator->fails();
  }

  protected function respondWithPaginate($paginate, $articles)
    {
        return [
            'articles' => $articles,
            'paginate' => $paginate /*[
                'current_page' => $articles->current_page,
                'first_page_url' => $articles->first_page_url,
                'last_page_url' => $articles->last_page_url,
                'next_page_url' => $articles->next_page_url,
                'prev_page_url' => $articles->prev_page_url,
                'per_page' => $articles->per_page,
                'last_page' => $articles->last_page,
                'total' => $articles->total,
            ]*/

        ];
    }
}
