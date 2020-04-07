<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use App\Services\Interfaces\ImageServiceInterface;

class ImageService implements ImageServiceInterface {
    /**
     * Store an image.
     * 
	 * @param UploadedFile $image
	 * @param string $folder
	 * @param string $filename
     * @return string
     */
    public function storeAs(UploadedFile $image, string $folder, $filename = null): string {
        $filename = $filename ?: $image->getClientOriginalName();

        Storage::disk('public')->putFileAs(
			$folder,
			$image,
			$filename
		);

        return implode('/', [$folder, $filename]);
    }
	
    /**
     * Delete an image directory.
	 * 
	 * @param string $path
	 * @return bool
     */
    public function deleteDirectory(string $path): bool {
        return Storage::disk('public')->deleteDirectory($path);
    }

    /**
     * Replace an image.
	 * 
	 * @param UploadedFile $image
	 * @param string $folder
	 * @param string $filename
     * @return string
     */
    public function replaceAs(UploadedFile $image, string $folder, $filename = null): string {
        $this->deleteDirectory($folder);
		
        return $this->storeAs($image, $folder, $filename);
    }
}