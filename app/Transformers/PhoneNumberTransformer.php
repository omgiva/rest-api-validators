<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Brick\PhoneNumber\PhoneNumber;
use Brick\PhoneNumber\PhoneNumberType;

class PhoneNumberTransformer extends TransformerAbstract
{
    public function transform($number)
    {

        $parsed = PhoneNumber::parse($number->raw);
        $is_mobile = false;
        $is_fixed_line = false;

        $numberType = $parsed->getNumberType();
        $numberRC =  $parsed->getRegionCode(); // GB
        $numberCC =  $parsed->getCountryCode(); // 44
        $numberNN =  $parsed->getNationalNumber(); // 7123456789
        $getNumberType = $parsed->getNumberType(); // PhoneNumberType::MOBILE

        //dd($getNumberType);

        switch ($numberType) {
            case PhoneNumberType::MOBILE:
                $is_mobile = true;
                break;
            case PhoneNumberType::FIXED_LINE:
                $is_fixed_line = true;
                break;

            default:
                # code...
                break;
        }


        return [
            'original' => $number->raw,
            'country_code' => $numberCC,
            'region_code' => $numberRC,
            'national_number' => $numberNN,
            'is_mobile' => $is_mobile,
            'is_fixed_line' => $is_fixed_line
        ];
    }
}