<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Avatar;
use App\Http\Resources\Avatar as AvatarResource;
use Validator;

class AvatarController extends Controller
{

    public function index()
    {
        $avatars = Avatar::orderBy('id', 'DESC')->paginate(10);
        return AvatarResource::collection($avatars);
    }

    public function show($id)
    {
        $avatar = Avatar::findOrFail($id);
        return (new AvatarResource($avatar))->response()->setStatusCode(201);
    }

    public function store(Request $request)
    {
        if ($this->valiForm($request)){
            return response()->json($validator->errors());
        }

        $avatar = Avatar::create($request->all());     
        $imgUrl = $this->saveImg($request->portraitImg, $avatar->id);
        $avatar->update(['portrait_url' => $imgUrl]);

        return (new AvatarResource($avatar))->response()->setStatusCode(201);
    }

    public function update(Request $request, $id)
    {
        if ($this->valiForm($request)){
            return response()->json($validator->errors());
        }
          
        $avatar = Avatar::findOrFail($id);
        /*if(isset($request->portraitImg)){
            $imgUrl = $this->saveImg($request->portraitImg, $avatar->id);
            $avatar->update(['portrait_url' => $imgUrl]);
        }*/
        
        $avatar->update($request->all());
        return (new AvatarResource($avatar))->response()->setStatusCode(201);
    }

    public function destroy($id)
    {
        $avatar = Avatar::findOrFail($id);

        if(file_exists(public_path() . "/upload/" . $avatar->portrait_url)){
            unlink(public_path() . "/upload/" . $avatar->portrait_url);
        }

        if ($avatar->delete()) {
            return response()->json(['id' => $id], 204);
        }
    }

    public function valiForm(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'nick_name' => 'required',
            'user_id'=> 'required'
        ]);
        return $validator->fails();
    }

    public function saveImg($dataImg, $id){
        if(isset($dataImg)){
            list($type, $dataImg) = explode(';', $dataImg);
            list(, $dataImg)      = explode(',', $dataImg);
       
            $dataImg = base64_decode($dataImg);
            $image_name= 'portait-avatar_'.strval($id).'.png';
            $path = public_path() . "/upload/" . $image_name;       
            file_put_contents($path, $dataImg);
            return $image_name;
        }else{
            return public_path() . "/upload/" . "default_avatar.png";
        }
    }

}
