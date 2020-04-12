<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use App\Services\Interfaces\FileServiceInterface;

class FileService implements FileServiceInterface {
    /**
     * Store a file with the original filename.
     * 
	 * @param UploadedFile $file
	 * @param string $folder
     * @return string
     */
    public function store(UploadedFile $file, string $folder): string {
        return $this->storeAs($file, $folder);
    }
	
    /**
     * Store a file with the given filename.
     * 
	 * @param UploadedFile $file
	 * @param string $folder
	 * @param string $filename
     * @return string
     */
    public function storeAs(UploadedFile $file, string $folder, $filename = null): string {
        $filename = $filename ?: $file->getClientOriginalName();
        $fullPath = implode('/', [$folder, uniqid()]);

        Storage::disk('public')->putFileAs(
			$fullPath,
			$file,
			$filename
		);

        return implode('/', ['', $fullPath, $filename]);
    }
	
    /**
     * Delete a directory.
	 * 
	 * @param string $path
	 * @return bool
     */
    public function deleteDirectory(string $path): bool {
        return Storage::deleteDirectory($path);
    }

    /**
     * Replace a file.
	 * 
	 * @param UploadedFile $file
	 * @param string $folder
	 * @param string $filename
     * @return string
     */
    public function replaceAs(UploadedFile $file, string $folder, $filename = null): string {
        $this->deleteDirectory($folder);
		
        return $this->storeAs($file, $folder, $filename);
    }
}