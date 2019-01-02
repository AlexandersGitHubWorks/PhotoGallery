<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'img', 'name', 'description'
    ];

    /**
     * Create a bindings with 'users' table.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
