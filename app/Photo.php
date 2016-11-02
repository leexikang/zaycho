<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Image;

class Photo extends Model
{
    public $name;
    public $baseDir ='product/photos';

    /**
     * undocumented function
     *
     * @return void
     */
    public function product($param)
    {
        return $this->belongsTo('App\Product');
    }

    public static function fromForm(UploadedFile $file){

        $photo = new static; 
        $name = time() . $file->getClientOriginalName();
        $photo->name = $name;
        $photo->path = $photo->baseDir . '/'. $name;
        $file->move($photo->baseDir, $name);
        return $photo;

    }

    public function createThumbnail(){

        $this->thumbnail_path = sprintf("%s/tn-%s", $this->baseDir, $this->name);
        $this->save();
        Image::make($this->path)
            ->fit(200)
            ->save($this->thumbnail_path);
        return $this;
    }

}
