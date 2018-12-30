<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /** New Directive for display Photo
         *
         * $arguments = ['name_photo', 'size_photo', 'path_photo']
         */
        Blade::directive('getPhoto', function ($arguments) {

            $arr_args = explode(',', str_replace(' ', '', $arguments));

            $image = empty($arr_args[0]) ? null : $arr_args[0];
            $size = empty($arr_args[1]) ? null : $arr_args[1];
            $path = empty($arr_args[2]) ? 'storage/photos/' : str_replace(["'", '"'], '', $arr_args[2]);

            if (!is_null($size) && !is_null($image)) {
                $result = '<?php $pathinfo_name = pathinfo(' . $image . ', PATHINFO_FILENAME); ?>'
                        . '<?php $image_name = str_replace($pathinfo_name, $pathinfo_name . \'-\' . ' . $size . ', ' . $image . '); ?>'
                        . '<?php if (file_exists("' . ($path . '$image_name') . '")) { ?>'
                            . '<img src="' . asset($path . '<?php echo $image_name ?>') . '">'
                        . '<?php } else { ?>'
                            . '<img src="' . asset($path . '<?php echo '. $image .' ?>') . '">'
                        . '<?php } ?>';
            } else if (!is_null($image)) {
                $result = '<img src="' . asset($path . '<?php echo '. $image .' ?>') . '">';
            } else {
                $result = '<div>Image not found</div>';
            }

            return $result;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
