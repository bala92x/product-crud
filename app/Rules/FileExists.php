<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class FileExists implements Rule {
    /**
     * Name of the storage disk.
     * 
     * @var string
     */
    private $disk;
	
    /**
     * FileExists constructor
     * 
     * @param string $disk
     * @return void
     */
    public function __construct(string $disk = 'public') {
        $this->disk = $disk;
    }
	
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
	 * @param string $disk
     * @return bool
     */
    public function passes($attribute, $value): bool {
        $path = trim($value, '/');

        return Storage::disk($this->disk)->exists($path);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string {
        return 'The file specified for :attribute does not exist.';
    }
}