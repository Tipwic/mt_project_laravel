<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    protected $fillable = ['user_id', 'name', 'nick_name', 'guild_id', 'grade_id', 'game_id','portrait_url' ];

    public function user()
    {
      return $this->belongsTo(User::class, 'user_id');
    }

    public function game()
    {
      return $this->belongsTo(Game::class, 'game_id');
    }

    public function grade()
    {
      return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function guild()
    {
      return $this->belongsTo(Guild::class, 'guild_id');
    }


    public function articles()
    {
        return $this->hasMany(Article::class, 'owner_id')->where('category', '=', 1)->where('type', '=', 1);
    }

}
