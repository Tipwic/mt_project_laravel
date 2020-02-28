<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Guild;
use App\Http\Resources\Guild as GuildResource;
use Validator;

class GuildController extends Controller
{
    public function index()
  {
      $guilds = Guild::all()->paginate(10);
      $code = 201;
      return $this->respondWithPaginate($guilds, $code);
  }

  public function show($id)
  {
      $guild = Guild::find($id);
      $code = 201;
      return (new GameResource($guild))->response()->setStatusCode(201);
  }

  public function store(Request $request)
  {
    if ($this->validate($request)){
        return response()->json($validator->errors());
    }

    $guild = Guild::create($request->all());
    return (new GuildResource($guild))->response()->setStatusCode(201);
  }

  public function update(Request $request, $id)
  {
    if ($this->validate($request)){
        return response()->json($validator->errors());
    }

    $guild = Guild::findOrFail($id);
    $guild->update($request->all());
    return (new GuildResource($guild))->response()->setStatusCode(201);
  }

  public function delete(Request $request, $id)
  {
      $guild = Guild::findOrFail($id);
      $guild->delete();
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

  protected function respondWithPaginate($guilds, $code)
    {
        return response()->json([
            'guilds' => GuildResource::collection($guilds),
            'paginate' => 'TODO',

        ])->setStatusCode($code);;
    }
}

