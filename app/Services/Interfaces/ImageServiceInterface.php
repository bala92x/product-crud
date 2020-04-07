<?php

namespace App\Services\Interfaces;

use Illuminate\Http\UploadedFile;

interface ImageServiceInterface {
    /**
     * Store an image.
     * 
	 * @param UploadedFile $image
	 * @param string $folder
	 * @param string $filename
     * @return string
     */
    public function storeAs(UploadedFile $image, string $folder, $filename = null): string;
	
    /**
     * Delete an image directory.
     * 
     * @param string $path
     * @return bool
     */
    public function deleteDirectory(string $path): bool;
	
    /**
     * Replace an image.
     * 
     * @param UploadedFile $image
     * @param string $folder
     * @param string $filename
     * @return string
     */
    public function replaceAs(UploadedFile $image, string $folder, $filename = null): string;
}