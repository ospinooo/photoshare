<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Database data can be changed here
    // Table name
    protected $table = 'posts';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
