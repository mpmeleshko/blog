<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class Article extends Model

{


    protected $fillable = [
        'title', 'body', 'image', 'user_id'
    ];

    public $checks = [
        'бублик', 'ревербератор', 'кастет',
        'хорь', 'алкоголь', 'превысокомногорассматрительствующий',
        'гражданин', 'паста'];



    /* замена слов из массива в сторке */
    public function check_article($article)

    {

        foreach ($this->checks as $check) {

            $length = mb_strlen($check);
            $newCheck = '';

            for ($i = 1; $i <= $length; $i++) {



               if ($i == 1 || $i == $length) {
                   $letter = mb_substr($check, $i-1, 1);
               }
               else {
                   $letter = '*';
               }

               $newCheck .= $letter;
            }

            $article->title = str_replace($check, $newCheck, $article->title);
            $article->body = str_replace($check, $newCheck, $article->body);

        }

    }

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




    public function favorites()

    {

        return $this->morphMany(Favorite::class, 'favorited');

    }


    public function favorite()

    {

        $attributes = ['user_id' => auth()->id()];

        if (! $this->favorites()->where($attributes)->exists()) {
                $this->favorites()->create($attributes);

        }

    }

    public function isFavorited()

    {

        return $this->favorites()->where('user_id', auth()->id())->exists();

    }


}
