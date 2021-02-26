<?php

namespace App\Http\Traits;

/**
 *
 */
trait Services {

    public static function consumeCountryApi() {
        $url = 'http://restcountries.eu/rest/v2/all';
        $ch = curl_init();       
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($httpCode == 200) {
            return json_decode($response, true);
        } else {
            return 404;
        }
    }

    public static function consumeCountryApiByCode($code) {
        $url = 'http://restcountries.eu/rest/v2/alpha/'.$code;
        $ch = curl_init();       
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($httpCode == 200) {
            return json_decode($response, true);
        } else {
            return 404;
        }
    }

}
