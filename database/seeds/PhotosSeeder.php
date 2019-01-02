<?php

use Illuminate\Database\Seeder;
use App\Photo;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class PhotosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            Photo::create([
                'img' => 'photo.jpg',
                'name' => 'Photo' . $i,
                'description' => 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit'
            ]);
        }

        // Downloads images from dummy data
        $this->storePhotoDummyData();
    }

    public function storePhotoDummyData()
    {
        $filesystem = new Filesystem();
        $from = public_path('dummy-photo');
        $images = $filesystem->allFiles($from);
        foreach ($images as $image) {
            $path = '/public/photos/' . $image->getFilename();
            Storage::put($path, $filesystem->get($image->getPathname()));
        }
    }
}
