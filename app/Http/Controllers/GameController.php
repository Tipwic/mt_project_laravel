<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Game;
use App\Http\Resources\Game as GameResource;
use Validator;

class GameController extends Controller
{
    public function index()
  {
      $games = Game::all()->paginate(10);
      $code = 201;
      return $this->respondWithPaginate($games, $code);
  }

  public function show($id)
  {
      $game = Game::find($id);
      $code = 201;
      return (new GameResource($game))->response()->setStatusCode(201);
  }

  public function store(Request $request)
  {
    if ($this->validate($request)){
        return response()->json($validator->errors());
    }

    $game = Game::create($request->all());
    return (new GameResource($game))->response()->setStatusCode(201);
  }

  public function update(Request $request, $id)
  {
    if ($this->validate($request)){
        return response()->json($validator->errors());
    }

    $game = Game::findOrFail($id);
    $game->update($request->all());
    return (new GameResource($game))->response()->setStatusCode(201);
  }

  public function delete(Request $request, $id)
  {
      $game = Game::findOrFail($id);
      $game->delete();
      return response()->json(['id' => $id], 204);
  }

  protected function validate(Request $request){
    $validator = Validator::make($request->all(), [
        'title' => 'required',
        'content' => 'required',
        'type'=> 'required',
        'category' => 'required'
    ]);
    return $validator->fails();
  }

  protected function respondWithPaginate($games, $code)
    {
        return response()->json([
            'games' => GameResource::collection($games),
            'paginate' => 'TODO',

        ])->setStatusCode($code);;
    }
}
