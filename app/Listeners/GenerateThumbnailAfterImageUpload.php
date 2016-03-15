<?php

namespace App\Listeners;

use App\Events\ImageUploaded;
use App\Jobs\ThumbnailGenerator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateThumbnailAfterImageUpload implements ShouldQueue
{
    use DispatchesJobs;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ImageUploaded  $event
     * @return void
     */
    public function handle(ImageUploaded $event)
    {
        $this->dispatch(new ThumbnailGenerator($event->image));
    }
}
