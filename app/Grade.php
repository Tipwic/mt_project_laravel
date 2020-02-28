<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['name', 'grants', 'guild_id'];

    public function guild()
    {
      return $this->belongsTo(Guild::class, 'guild_id');
    }

    public function avatar()
    {
        return $this->hasMany(Avatar::class, 'grade_id');
    }
}
