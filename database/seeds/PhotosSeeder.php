<?php

use Illuminate\Database\Seeder;
use App\Photo;

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
                'img' => 'picture' . $i . '.jpg',
                'name' => 'picture' . $i,
                'description' => 'Description ' . $i
            ]);
        }
    }
}
