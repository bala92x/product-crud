<?php

namespace App\Http\Requests\ProductRequests;

use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Http\Requests\ApiFormRequest;
use App\Http\Requests\ProvidesAdditionalInput;
use App\Services\ProductService;
use App\Services\Interfaces\ProductServiceInterface;

class StoreProductRequest extends ApiFormRequest {
    use ProvidesAdditionalInput;
	
    /**
	 * The service used to manage products.
	 * 
     * @var ProductService
     */
    private $productService;
	
    /**
     * StoreProductRequest constructor.
     * 
	 * @param ProductServiceInterface $productService
     * @return void
     */
    public function __construct(ProductServiceInterface $productService) {
        $this->productService = $productService;
    }
	
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array {
        return [
			// Product
            'publishedAt' 		=> [
				'required_without:productId',
				'date'
			],
			'publishedUntil' 	=> [
				'date',
				'after:publishedAt'
			],
			'price'				=> [
				'required_without:productId',
				'integer'
			],
			'image'				=> [
				'required_without:productId',
				'image',
				'max:' . Config::get('app.max_image_size')
			],

			// Product translations
			'productTranslations'					=> [
				'required_without:productId',
				'array',
				'min:1'
			],
			'productTranslations.*.languageSlug' 	=> [
				'required_with:productTranslations',
				'alpha',
				'exists:languages,slug,deleted_at,NULL'
			],
			'productTranslations.*.name' 			=> [
				'required_without:productId',
				'max:255'
			],
			'productTranslations.*.slug' 			=> [
				'required_without:productId',
				'max:255',
				'unique:product_translations,slug,' . $this->productId .',product_id,deleted_at,NULL',
			],
			'productTranslations.*.description' 	=> 'max:' . Config::get('app.max_text_length'),

			// Product tags
			'productTagIds'		=> 'array',
			'productTagIds.*'	=> [
				'integer',
				'exists:product_tags,id,deleted_at,NULL'
			]
        ];
    }
	
    /**
     * Return additional request data.
     *
     * @return array
	 * 
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    protected function additionalInput(): array {
        if (is_null($this->productId)) {
            return [];
        }

        try {
            return [
				'product' 	=> $this->productService->find((int)$this->productId),
				'productId'	=> $this->productId
			];
        } catch (ModelNotFoundException $e) {
            abort(404, 'This product could not be found.');
        } catch (Exception $e) {
            abort(500, 'Product fetch error.');
        }
    }
	
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array {
        return [
    		'productTranslations.*.languageSlug.exists' => 'There is no language with the selected language slug.',
    		'productTagIds.*.exists' 					=> 'There is no product tag with the selected id.'
    	];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array {
        return [
			'productTranslations' 					=> 'product translations',
			'productTranslations.*.languageSlug' 	=> 'product translation language slug',
			'productTranslations.*.name' 			=> 'product translation name',
			'productTranslations.*.slug' 			=> 'product translation slug',
			'productTranslations.*.description' 	=> 'product translation description',

			'productTagIds' 	=> 'product tag ids',
			'productTagIds.*' 	=> 'product tag id',
    	];
    }
}
