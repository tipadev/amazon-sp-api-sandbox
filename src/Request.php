<?php

class Request
{
    public function get($url, $headers = [], $data = []): array
    {
        return $this->send($url, 0, $data, $headers);
    }

    public function post($url, $headers = [], $data = []): array
    {
        return $this->send($url, 1, $data, $headers);
    }

    public function send($url, $isPost = 0, $headers = [], $data = []): array
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_POST => $isPost,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => $data,
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        if (curl_errno($curl)) {
            throw new Exception('Could not resolve request');
        }

        $result = (array) json_decode($response, true);

        if (isset($result['errors'])) {
            $errorMessage = 'The request returned with error';

            if (isset($result['errors'][0]) && isset($result['errors'][0]['message'])) {
                $errorMessage .= ': ' . $result['errors'][0]['message'];
            }

            throw new Exception($errorMessage);
        }

        return $result;
    }
}
