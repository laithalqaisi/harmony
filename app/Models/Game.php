<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public $table = 'games';

    protected $dates = [
        'release_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'rating',
        'publisher_id',
        'release_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function publisher(){
        return $this->belongsTo('App\Models\Publisher');
    }

    public function developers(){
        return $this->belongsToMany('App\Models\Developer', 'developed');
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag', 'tagged');
    }
}
