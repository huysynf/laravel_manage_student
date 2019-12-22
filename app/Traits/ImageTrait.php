<?php
namespace App\Traits;
use Image;
trait ImageTrait{
    public  function veryfyImage($request,$filename='image'){
        if($request->hasFile($filename)){
                return true;
        }
        return false;

    }
    public function saveImage($request,$path,$filename='image')
    {
            if($this->veryfyImage($request,$filename)){
                $name = time() . '.' . $request->file($filename)->getClientOriginalExtension();
                Image::make($request->file($filename))->resize(300, 300)->save($path . $name);
                return $name;
            }

    }

    public function deleteImage($name)
    {
        if (file_exists($this->imagePath . $name) && $name != 'default.jpg') {
            unlink($this->imagePath . $name);
        }
    }

    public function updateImage($request,$path, $currentName,$filename='image')
    {
        if ($request) {
            $name = $this->saveimage($request,$path,$filename);
            $this->deleteimage($currentName);
            return $name;
        } else {
            return $currentName;
        }
    }
}
