<?php

namespace App\Services\Interfaces;

use Illuminate\Http\UploadedFile;

interface FileServiceInterface {
    /**
     * Store a file with the original filename.
     * 
	 * @param UploadedFile $file
	 * @param string $folder
     * @return string
     */
    public function store(UploadedFile $file, string $folder): string;
	
    /**
     * Store a file with the given filename.
     * 
	 * @param UploadedFile $file
	 * @param string $folder
	 * @param string $filename
     * @return string
     */
    public function storeAs(UploadedFile $file, string $folder, $filename = null): string;
	
    /**
     * Delete a directory.
     * 
     * @param string $path
     * @return bool
     */
    public function deleteDirectory(string $path): bool;
	
    /**
     * Replace a file.
     * 
     * @param UploadedFile $file
     * @param string $folder
     * @param string $filename
     * @return string
     */
    public function replaceAs(UploadedFile $file, string $folder, $filename = null): string;
}