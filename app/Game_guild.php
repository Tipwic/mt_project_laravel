<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game_guild extends Model
{
    public function game()
    {
      return $this->belongsTo(Game::class, 'game_id');
    }

    public function guild()
    {
      return $this->belongsTo(Guild::class, 'guild_id');
    }
}
