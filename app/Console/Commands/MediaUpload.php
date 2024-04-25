<?php

namespace App\Console\Commands;

use App\Models\Products;
use Illuminate\Console\Command;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaUpload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:media-upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = Products::take(76)->get();
        foreach ($products as $key => $value) {
            $model_id = $value->id;
            $medias = Media::where('model_id', $model_id)->get();
            $product = Products::find($model_id);
            foreach ($medias as $k => $v) {
                $product->addMediaFromUrl('https://andor-server.sixty13.com/storage/'.$v->id."/".$v->file_name)->toMediaCollection($v->collection_name);
            }
            $this->info('Product '.$model_id.' is uploaded.');
        }
    }
}
