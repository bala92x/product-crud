<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadsFile {
    /**
     * Uploads a test file.
     * 
     * @param string $module
	 * @param string $type
	 * @param string $disk
     * @return string
     */
    protected function uploadFile(string $module, string $type, string $disk = 'public'): string {
        Storage::fake($disk);
		
        if ($type === 'image') {
            $file = UploadedFile::fake()->image('image.jpeg');
        }

        $route 			= '/api/files';
        $response 		= $this->post($route, [
			'file'		=> $file,
			'module'	=> $module
		]);
		
        $response->assertStatus(201)
				->assertJsonStructure(['filePath']);
		
        $filePath = json_decode($response->getContent())->filePath;
		
        Storage::disk($disk)->assertExists($filePath);
		
        return $filePath;
    }
}