<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model

{


    protected $fillable = [

        'title', 'body', 'image', 'user_id'

    ];


    public function comments()

    {

        return $this->hasMany(Comment::class);

    }


    public function user()

    {

        return $this->belongsTo(User::class);

    }


    public function scopeFilter($query, $filters)

    {

        if (isset($filters['month'])) {

            $query->whereMonth('created_at', Carbon::parse($filters['month'])->month);

        }


        if (isset($filters['year'])) {

            $query->whereYear('created_at', $filters['year']);

        }

    }


    public static function archives()

    {

        return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')

            ->groupBy('year', 'month')

            ->get()

            ->toArray();

    }

}
