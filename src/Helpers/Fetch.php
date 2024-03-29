<?php

declare(strict_types=1);

namespace Gneb\Fee\Helpers;

class Fetch
{
    public function get($url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'cache-control: no-cache',
            ],
        ]);
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($httpCode !== 200) {
            echo "error making fetch request at {$url}";
            exit;
        }

        curl_close($curl);

        return json_decode($response);
    }
}
