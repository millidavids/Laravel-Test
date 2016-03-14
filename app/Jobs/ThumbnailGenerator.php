<?php

namespace App\Jobs;

use App\Image;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\ImageManagerStatic;

class ThumbnailGenerator extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $image;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $info = pathinfo($this->image->path);
        $img = ImageManagerStatic::make($this->image->path);
        $img->resize(100, 100);
        $img->save(storage_path().'/app/public/' . $info['filename'] . '-thumbnail.' . $info['extension']);
    }
}
