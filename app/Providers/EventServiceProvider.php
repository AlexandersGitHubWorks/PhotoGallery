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
        Event::listen('image-slicing', function ($image_name, $param = null, $path = 'storage/photos/') {

            if (file_exists($file = $path . $image_name)) {
                list($width, $height) = getimagesize($file);
                $ratio = $width / $height;
                $src = imagecreatefromjpeg($file);
                $pathinfo_name = pathinfo($file, PATHINFO_FILENAME);

                if (is_null($param)) {
                    $param = [
                        'md' => [1200, 1200],
                        'sm' => [320, 240],
                    ];
                }

                foreach ($param as $size => $new_wh) {
                    // The mechanism of conservation of proportions when cutting the image
                    list($width_new, $height_new) = $new_wh;
                    if ($ratio >= ($width_new / $height_new)) {
                        $height_new = round($height / ($width / $width_new)); // Line calculates new height keeping proportions
                    } else {
                        $width_new = round($width / ($height / $height_new)); // Line calculates new width keeping proportions
                    }

                    $dest = imagecreatetruecolor($width_new, $height_new);
                    imagecopyresampled($dest, $src, 0, 0, 0, 0, $width_new, $height_new, $width, $height);
                    imagejpeg($dest, $path . str_replace($pathinfo_name, $pathinfo_name . '-' . $size, $image_name));
                }

                imagedestroy($dest);
                imagedestroy($src);
            }
        });
    }
}
