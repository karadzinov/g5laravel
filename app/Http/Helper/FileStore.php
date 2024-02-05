<?php

namespace App\Http\Helper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class FileStore
{

    public $request;
    public $path;
    public $paths;

    public function __construct(Request $request, $path)
    {
        $this->request = $request;
        $this->path = $path;
    }

    public function fileStore()
    {
        if ($this->request->hasFile('file')) {
            $file = $this->request->file('file');

            $fileName = Str::random(10) . '.' . $file->getClientOriginalExtension();
            $paths = $this->makePaths();
            File::makeDirectory($paths['original'], $mode = 0755, true, true);

            $file->move($paths['original'], $fileName);

            return $fileName;
        }

        return false;
    }

    public function makePaths()
    {
        $original = public_path() . '/assets/files/' . $this->path . '/';;
        $paths = ['original' => $original];
        return $paths;
    }
}
