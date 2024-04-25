<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Products extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('square_wall_product_images')
            ->useDisk('public')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('medium')
                    ->width(400)
                    ->height(442);

                $this
                    ->addMediaConversion('medium-60')
                    ->width(60)
                    ->height(60);

            });
            // $this
            // ->addMediaCollection('square_wall_product_images')
            // ->registerMediaConversions(function (Media $media) {
            //     $this
            //         ->addMediaConversion('medium-60')
            //         ->width(60)
            //         ->height(60);
            // });
        $this
            ->addMediaCollection('product_gallery')
            ->useDisk('public')
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('thumb')
                    ->width(154)
                    ->height(154);
            });
    }
    
    public function featuredImage(): MorphMany
    {
        return $this->morphMany(Media::class, 'model')->where('collection_name', '=', 'square_wall_product_images');
    }
    public function imageGallery(): MorphMany
    {
        return $this->morphMany(Media::class, 'model')->where('collection_name', '=', 'product_gallery');
    }

}
