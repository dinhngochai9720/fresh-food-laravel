<?php

namespace App\Traits;

use Illuminate\Http\Request;
use File;
use Image;

trait HandlerImage
{
    public function uploadImage(Request $request, $input_name, $path, $with, $height)
    {
        if ($request->hasFile($input_name)) {

            $image = $request->{$input_name};
            $extension = $image->getClientOriginalExtension();
            $image_name = uniqid() . '.' . $extension;
            Image::make($image)->resize($with, $height)->save($path . '/' . $image_name);

            return $path . '/' . $image_name;
        }
    }

    public function uploadMultiImage(Request $request, $input_name, $path, $with, $height)
    {
        $array_image_paths = [];
        if ($request->hasFile($input_name)) {
            $images = $request->{$input_name};

            foreach ($images as $key => $image) {
                $extension = $image->getClientOriginalExtension();
                $image_name = uniqid() . '.' . $extension;

                Image::make($image)->resize($with, $height)->save($path . '/' . $image_name);

                //push path of image to array image paths
                $array_image_paths[] = $path . '/' . $image_name;
            }

            return $array_image_paths; // array paths of images
        }
    }


    public function updateImage(Request $request, $input_name, $path, $with, $height, $old_path = null)
    {
        if ($request->hasFile($input_name)) {
            if (File::exists(public_path($old_path))) {
                File::delete(public_path($old_path));
            }

            $image = $request->{$input_name};
            $extension = $image->getClientOriginalExtension();
            $image_name = uniqid() . '.' . $extension;
            Image::make($image)->resize($with, $height)->save($path . '/' . $image_name);

            return $path . '/' . $image_name;
        }
    }

    public function deleteImage(string $path)
    {
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
