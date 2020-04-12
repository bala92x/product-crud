<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

use App\Services\FileService;
use App\Http\Requests\FileFormRequest;
use App\Services\Interfaces\FileServiceInterface;

class FileController extends Controller {
    /**
     * The service used to manage files.
     * 
     * @var FileService 
     */
    private $fileService;
    
    /**
     * Create a new controller instance.
     *
	 * @param FileService $fileService
     * @return void
     */
    public function __construct(FileServiceInterface $fileService) {
        $this->fileService = $fileService;
    }
	
    /**
     * Upload a file.
     *
     * @param FileFormRequest
	 * @return JsonResponse
	 * 
	 * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function upload(FileFormRequest $request): JsonResponse {
        try {
            $filePath = $this->fileService->store($request->file, $request->module);
			
            return response()->json([
				'filePath' => $filePath
			], 201);
        } catch (Exception $e) {
            abort(500, 'File upload error.');
        }
    }
}
