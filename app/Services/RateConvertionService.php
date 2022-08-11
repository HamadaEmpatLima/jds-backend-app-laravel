<?php

namespace App\Services;

/**
 * Using api.apilayer.com to convert currency
 */

class RateConvertionService {

    /**
     * @param string $from - currency to convert from
     * @param string $to - currency to convert to
     * @param float $amount - amount to convert
     */
    public function convert($to, $from, $amount)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.apilayer.com/fixer/convert?to=$to&from=$from&amount=$amount",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: text/plain",
                "apikey: " . config('services.rate_convertion.api_key')
            ),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }
}