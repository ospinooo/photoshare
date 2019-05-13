<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Post extends Model implements HasMedia
{
    use HasMediaTrait;

    /**
     *
     */
    public function registerMediaConversions(Media $media = null)
    {
        // Perform a resize and filter on images from the 'images' and 'anotherCollection' collections
        // and save them as png files.
        $this->addMediaConversion('medium')
            ->fit(Manipulations::FIT_FILL, 1024, 768)
            // ->setManipulations(['w' => 360, 'h' => 360])
            ->performOnCollections('document');


        // Perform a resize and sharpen on every collection
        $this->addMediaConversion('small')
            ->fit(Manipulations::FIT_FILL, 800, 600)
            // ->setManipulations(['w' => 50, 'h' => 50])
            ->performOnCollections('document');

        // Perform a resize on every collection
        $this->addMediaConversion('big')
            ->fit(Manipulations::FIT_FILL, 1600, 1200)
            //->setManipulations(['w' => 700, 'h' => 700])
            ->performOnCollections('document');
    }

    // Database data can be changed here
    // Table name
    protected $table = 'posts';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    // Relation
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }
}
