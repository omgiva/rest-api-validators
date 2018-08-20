<?php

namespace App\Transformers\Errors;

use League\Fractal\TransformerAbstract;

class PhoneNumberInvalidFormatTransformer extends TransformerAbstract {
	public function transform($number) {

		$number_raw = $number->raw;

		return [
			'error' => [
				'error_code' => 'number_invalid_format',
				'error_message' => 'Invalid phone number format',
			],
		];
	}
}