<?php

namespace App\Transformers\Errors;

use League\Fractal\TransformerAbstract;

class PhoneNumberInvalidLengthTransformer extends TransformerAbstract {
	public function transform($number) {

		$number_raw = $number->raw;

		return [
			'error' => [
				'error_code' => 'number_invalid_length',
				'error_message' => 'Number is too short',
			],
		];
	}
}