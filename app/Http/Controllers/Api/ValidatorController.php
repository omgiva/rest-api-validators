<?php

namespace App\Http\Controllers\Api;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Transformers\PhoneNumberTransformer;
use Dingo\Api\Routing\Helpers;
use StdClass;
use Brick\PhoneNumber\PhoneNumber;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ValidatorController extends BaseController
{
    //

    use Helpers;

    public function phone($number)
    {

        $numberObject = new StdClass;
        $numberObject->raw = $number;

        //return $this->response->item($numberObject, new PhoneNumberTransformer);
        //return $number;

        try {
            $parsed = PhoneNumber::parse($number);
            $isValidNumber = $parsed->isValidNumber();

            if (!$isValidNumber) {

                throw new BadRequestHttpException('That is not a valid phone number');
            } else {

                
                return $this->response->item($numberObject, new PhoneNumberTransformer);
            }

            

        }
        catch (PhoneNumberParseException $e) {
            // 'The string supplied is too short to be a phone number.'
            throw new Symfony\Component\HttpKernel\Exception\BadRequestHttpException($e->getMessage());
        }
    }
}
