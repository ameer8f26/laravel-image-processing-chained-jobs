<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\Image;
use Intervention\Image\ImageManagerStatic as ImageManager;

class ApplyFilter1 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $imagePath;

    public function __construct($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Open the image
        $image = ImageManager::make($this->imagePath);

        // Apply filter to the image
        $image->invert();

        // Save the updated image
        $image->save(public_path('storage/' . basename($this->imagePath)));

        // Get the URL of the updated image
        $imageUrl = asset('storage/' . basename($this->imagePath));

        return $imageUrl;
    }
}