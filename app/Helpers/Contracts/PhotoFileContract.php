<?php

namespace App\Helpers\Contracts;

interface PhotoFileContract
{
    /**
     * Method saves the image to the storage.
     */
    public function storePhoto($image, $slice, $path);

    /**
     * Method cuts the image.
     */
    public function slicePhoto($image_name, $slice, $path);
}