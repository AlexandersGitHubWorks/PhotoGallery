<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
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
