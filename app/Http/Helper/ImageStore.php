<?php

namespace App\Http\Helper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;


class ImageStore
{

    public $request;
    public $path;
    public $paths;

    public function __construct(Request $request, $path)
    {
        $this->request = $request;
        $this->path = $path;
    }

    public function imagesStore($image)
    {

        $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
        $paths = $this->makePaths();


        File::makeDirectory($paths['original'], $mode = 0755, true, true);
        File::makeDirectory($paths['thumbnail'], $mode = 0755, true, true);
        File::makeDirectory($paths['medium'], $mode = 0755, true, true);


        $image->move($paths['original'], $imageName);

        $findimage = $paths['original'] . $imageName;

        $manager = ImageManager::gd();
        $imagethumb = $manager->read($findimage)->scale(200);
        $imagemedium = $manager->read($findimage)->scale(600);
        $imagethumb->save($paths['thumbnail'] . $imageName);
        $imagemedium->save($paths['medium'] . $imageName);

        return $imageName;



    }

    public function imageStore()
    {
        if ($this->request->hasFile('image')) {
            $image = $this->request->file('image');

            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $paths = $this->makePaths();


            File::makeDirectory($paths['original'], $mode = 0755, true, true);
            File::makeDirectory($paths['thumbnail'], $mode = 0755, true, true);
            File::makeDirectory($paths['medium'], $mode = 0755, true, true);


            $image->move($paths['original'], $imageName);

            $findimage = $paths['original'] . $imageName;

            $manager = ImageManager::gd();
            $imagethumb = $manager->read($findimage)->scale(200);
            $imagemedium = $manager->read($findimage)->scale(600);
            $imagethumb->save($paths['thumbnail'] . $imageName);
            $imagemedium->save($paths['medium'] . $imageName);

            return $imageName;
        }

        return false;
    }

    public function makePaths()
    {
        $original = public_path() . '/assets/img/' . $this->path . '/originals/';;
        $thumbnail = public_path() . '/assets/img/' . $this->path . '/thumbnails/';
        $medium = public_path() . '/assets/img/' . $this->path . '/medium/';
        $paths = ['original' => $original, 'thumbnail' => $thumbnail, 'medium' => $medium];
        return $paths;
    }
}
