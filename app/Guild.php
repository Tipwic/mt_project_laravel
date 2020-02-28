<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guild extends Model
{
    protected $fillable = [ 'name'];

    public function articles()
    {
        return $this->hasMany(Article::class, 'owner_id')->where('category', '=', 2)->where('type', '=', 1);
    }

    public function avatars()
    { 
        return $this->hasManyThrough(
            Grade::class, Avatar::class, 'guild_id', 'avatar_id'
        );
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'guild_id');
    }
    
}
