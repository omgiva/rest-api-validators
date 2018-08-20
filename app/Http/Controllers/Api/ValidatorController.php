<?php

namespace App\Http\Controllers\Api;

use App\Transformers\Errors\PhoneNumberInvalidFormatTransformer;
use App\Transformers\Errors\PhoneNumberInvalidLengthTransformer;
use App\Transformers\PhoneNumberTransformer;
use Brick\PhoneNumber\PhoneNumber;
use Dingo\Api\Routing\Helpers;
use Laravel\Lumen\Routing\Controller as BaseController;
use StdClass;

class ValidatorController extends BaseController {
	//

	use Helpers;

	public function phone($number) {

		$numberObject = new StdClass;
		$numberObject->raw = $number;

		try {
			$parsed = PhoneNumber::parse($number);
			$isValidNumber = $parsed->isValidNumber();

			if (!$isValidNumber) {

				return $this->response->item($numberObject, new PhoneNumberInvalidFormatTransformer);
			} else {

				return $this->response->item($numberObject, new PhoneNumberTransformer);
			}

		} catch (PhoneNumberParseException $e) {

			return $this->response->item($numberObject, new PhoneNumberInvalidLengthTransformer);
		}
	}
}
