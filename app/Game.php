<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [ 'name'];

    public function articles()
    {
        return $this->hasMany(Article::class, 'owner_id')->where('category', '=', 3)->where('type', '=', 1);
    }

    public function avatars()
    { 
        $this->hasMany(Avatar::class, 'game_id');
    }

    public function guilds()
    {
        return $this->hasManyThrough(
            Game_guild::class, Guild::class, 'game_id', 'guild_id'
        );
    }
}
