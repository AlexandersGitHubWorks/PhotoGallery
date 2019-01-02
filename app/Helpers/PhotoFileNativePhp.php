<?php

namespace App\Helpers;

use App\Helpers\Contracts\PhotoFileContract;

class PhotoFileNativePhp implements PhotoFileContract
{
    /**
     * The attribute that is image name.
     *
     * @var str
     */
    public $image_name;

    /**
     * Method saves the image to the storage.
     */
    public function storePhoto($image, $slice = true, $path = 'storage/photos/')
    {
        $this->image_name = time() . '-' . $image->getClientOriginalName();
        $image->move(public_path($path), $this->image_name);

        // If necessary, cut the image
        if ($slice === true) {
            $this->slicePhoto($this->image_name, $slice, $path);
        }
    }

    /**
     * Method cuts the image.
     */
    public function slicePhoto($image_name, $slice, $path)
    {
        if (file_exists($file = $path . $image_name)) {
            list($width, $height) = getimagesize($file);
            $ratio = $width / $height;
            $src = imagecreatefromjpeg($file);
            $pathinfo_name = pathinfo($file, PATHINFO_FILENAME);

            $slice = [
                'md' => [1200, 1200],
                'sm' => [320, 240],
            ];

            foreach ($slice as $size => $new_wh) {
                // The mechanism of conservation of proportions when cutting the image
                list($width_new, $height_new) = $new_wh;
                if ($ratio >= ($width_new / $height_new)) {
                    // Line calculates new height keeping proportions
                    $height_new = round($height / ($width / $width_new));
                } else {
                    // Line calculates new width keeping proportions
                    $width_new = round($width / ($height / $height_new));
                }

                $dest = imagecreatetruecolor($width_new, $height_new);
                imagecopyresampled($dest, $src, 0, 0, 0, 0, $width_new, $height_new, $width, $height);
                imagejpeg($dest, $path . str_replace($pathinfo_name, $pathinfo_name . '-' . $size, $image_name));
            }

            imagedestroy($dest);
            imagedestroy($src);
        }
    }
}