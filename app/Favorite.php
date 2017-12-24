<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{

    protected $fillable = [
        'id', 'user_id', 'favorited_id'
    ];

    protected $guarded = [];


    public function favoreted()

    {

        return $this->morphTo();

    }
}
