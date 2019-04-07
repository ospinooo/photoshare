<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    /**
     * 
     */
    public function posts(){
        return $this->hasMany('App\Post');
    }
    
}
