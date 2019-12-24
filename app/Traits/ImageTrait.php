<?php
namespace App\Traits;

use Image;

trait ImageTrait
{
    public function veryfyImage($image, $filename = 'image')
    {
        if ($image->hasFile($filename)) {
            return true;
        }
        return false;
    }

    public function saveImage($image, $path, $filename = 'image')
    {
        if ($this->veryfyImage($image, $filename)) {
            $name = time() . '.' . $image->file($filename)->getClientOriginalExtension();
            Image::make($image->file($filename))->resize(300, 300)->save($path . $name);
            return $name;
        }

    }

    public function deleteImage($name,$path)
    {
        if (file_exists($path . $name) && $name != 'default.jpg') {
            unlink($path . $name);
        }
    }

    public function updateImage($image, $path, $currentName, $filename = 'image')
    {
        if ($this->veryfyImage($image,$filename)) {
            $name = $this->saveimage($image, $path, $filename);
            $this->deleteImage($currentName,$path);
            return $name;
        } else {
            return $currentName;
        }
    }
}
