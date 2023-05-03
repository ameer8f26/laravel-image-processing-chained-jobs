<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\ImageManagerStatic as ImageManager;


class ProcessImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $imagePath;

    /**
     * Create a new job instance.
     *
     * @param string $imagePath
     * @param array $filters
     */
    public function __construct(string $imagePath, array $filters = [])
    {
        $this->imagePath = $imagePath;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        info('image path in process image job' . $this->imagePath);

        // Open the image
        $image = ImageManager::make($this->imagePath);

        $image->brightness(30);
        $image->rotate(45);

        // Save the updated image
        $image->save(public_path('storage/' . basename($this->imagePath)));

        // Get the URL of the updated image
        $imageUrl = asset('storage/' . basename($this->imagePath));

        return $imageUrl;
    }
}
