<?php

namespace App\Traits;

use Image;

trait ImageTrait
{
    public function veryfyImage($image)
    {
        if ($image->isValid()) {
            return true;
        }
        return false;
    }

    public function saveImage($image, $path)
    {
        if ($this->veryfyImage($image)) {
            $name = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save($path . $name);
            return $name;
        }

    }

    public function deleteImage($name, $path)
    {
        if (file_exists($path . $name) && $name != 'default.jpg') {
            unlink($path . $name);
        }
    }

    public function updateImage($image, $path, $currentName)
    {
        if ($this->veryfyImage($image)) {
            $name = $this->saveimage($image, $path);
            $this->deleteImage($currentName, $path);
            return $name;
        } else {
            return $currentName;
        }
    }

}
