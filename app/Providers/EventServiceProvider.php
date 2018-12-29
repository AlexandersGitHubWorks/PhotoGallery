<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // Slicing image
        Event::listen('image-slicing', function ($img) {

            $path = 'storage/photos/';
            $file = $path . $img;
            list($width, $height) = getimagesize($file);
            $ratio = $width / $height;
            $src = imagecreatefromjpeg($file);

            // The mechanism of conservation of proportions when cutting the image
            list($width_s, $height_s) = [320, 240];
            if ($ratio >= ($width_s / $height_s)) {
                $height_s = round($height / ($width / $width_s)); // Line calculates new height keeping proportions
            } else {
                $width_s = round($width / ($height / $height_s)); // Line calculates new width keeping proportions
            }

            $dest_s = imagecreatetruecolor($width_s, $height_s);
            imagecopyresampled($dest_s, $src, 0, 0, 0, 0, $width_s, $height_s, $width, $height);
            imagejpeg($dest_s, $path . str_replace('-o-', '-s-', $img));

            // The mechanism of conservation of proportions when cutting the image
            list($width_m, $height_m) = [1200, 1200];
            if ($ratio >= ($width_m / $height_m)) {
                $height_m = round($height / ($width / $width_m)); // Line calculates new height keeping proportions
            } else {
                $width_m = round($width / ($height / $height_m)); // Line calculates new width keeping proportions
            }

            $dest_m = imagecreatetruecolor($width_m, $height_m);
            imagecopyresampled($dest_m, $src, 0, 0, 0, 0, $width_m, $height_m, $width, $height);
            imagejpeg($dest_m, $path . str_replace('-o-', '-m-', $img));

            imagedestroy($src);
            imagedestroy($dest_s);
            imagedestroy($dest_m);
        });
    }
}
