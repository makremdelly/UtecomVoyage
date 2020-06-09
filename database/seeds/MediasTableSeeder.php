<?php

use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\Models\Media;

class MediasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url  = 'https://s-ec.bstatic.com/images/hotel/max1024x768/172/172070682.jpg';
        $url1 = 'https://www.baglionihotels.com/wp-content/themes/baglioni-hotels-new/images/schema/baglioni-hotel-london.jpg';
        $url2 = 'https://media-cdn.tripadvisor.com/media/photo-s/10/00/09/a8/swimming-pool.jpg';
        $url3 = 'https://t-ec.bstatic.com/images/hotel/max1280x900/111/111171246.jpg';
        $url4 = 'https://t-ec.bstatic.com/images/hotel/max1024x768/546/54686729.jpg';
        $url5 = 'https://cdn-wp.s3-eu-central-1.amazonaws.com/wp-content/uploads/sites/11/2018/10/pool-1-the-student-hotel-florence.jpg';

        App\Models\Hotel::find(1)
            ->addMediaFromUrl($url1) //starting method
            ->preservingOriginal() //middle method
            ->toMediaCollection(); //finishing method

        App\Models\Hotel::find(2)
            ->addMediaFromUrl($url) //starting method
            ->preservingOriginal() //middle method
            ->toMediaCollection(); //finishing method


        App\Models\Hotel::find(3)
            ->addMediaFromUrl($url2) //starting method
            ->preservingOriginal() //middle method
            ->toMediaCollection(); //finishing method

        App\Models\Hotel::find(2)
            ->addMediaFromUrl($url3) //starting method
            ->preservingOriginal() //middle method
            ->toMediaCollection(); //finishing method


        App\Models\Hotel::find(1)
            ->addMediaFromUrl($url4) //starting method
            ->preservingOriginal() //middle method
            ->toMediaCollection(); //finishing method


        App\Models\Hotel::find(1)
            ->addMediaFromUrl($url5) //starting method
            ->preservingOriginal() //middle method
            ->toMediaCollection(); //finishing method



        //room
        App\Models\Room::find(12)
            ->addMediaFromUrl($url1) //starting method
            ->preservingOriginal() //middle method
            ->toMediaCollection(); //finishing method

        App\Models\Room::find(12)
            ->addMediaFromUrl($url2) //starting method
            ->preservingOriginal() //middle method
            ->toMediaCollection(); //finishing method

        App\Models\Room::find(12)
            ->addMediaFromUrl($url3) //starting method
            ->preservingOriginal() //middle method
            ->toMediaCollection(); //finishing method

        App\Models\Room::find(13)
            ->addMediaFromUrl($url1) //starting method
            ->preservingOriginal() //middle method
            ->toMediaCollection(); //finishing method


        App\Models\Room::find(13)
            ->addMediaFromUrl($url1) //starting method
            ->preservingOriginal() //middle method
            ->toMediaCollection(); //finishing method
            
        App\Models\Room::find(13)
        ->addMediaFromUrl( $url4) //starting method
        ->preservingOriginal() //middle method
        ->toMediaCollection(); //finishing method


    }
}
