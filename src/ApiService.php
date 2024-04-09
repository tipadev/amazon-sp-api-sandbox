<?php

use Skeleton\ApiServiceInterface;

class ApiService implements ApiServiceInterface
{
    private ?string $accessToken;
    private int $tokenExpirationDate;
    private array $config;
    private Request $request;

    public function __construct()
    {
        $this->config = require_once(__DIR__ . '/../config.php');
        $this->request = new Request();
        $this->accessToken = null;
    }

    protected function checkAccessToken(): void
    {
        $dateNow = new DateTime('now', new DateTimeZone('UTC'));

        if (is_null($this->accessToken) || $this->tokenExpirationDate < $dateNow->getTimestamp()) {
            $requestUrl = $this->config['api_auth_url'];

            $requestHeaders = [
                'Content-Type: application/x-www-form-urlencoded',
            ];

            $requestData = [
                'grant_type' => 'refresh_token',
                'client_id' => $this->config['api_client_id'],
                'client_secret' => $this->config['api_client_secret'],
                'refresh_token' => $this->config['api_refresh_token'],
            ];

            $result = $this->request->post($requestUrl, $requestHeaders, $requestData);

            if (!isset($result['access_token'])) {
                throw new Exception('Unable to get the access token');
            }

            $tokenExpirationDate = new DateTime(
                'now +' . $result['expires_in'] . ' seconds', 
                new DateTimeZone('UTC')
            );

            $this->accessToken = $result['access_token'];
            $this->tokenExpirationDate = $tokenExpirationDate->getTimestamp();
        }
    }

    public function createFulfillmentOrder($fulfillment): void
    {
        $this->checkAccessToken();

        $requestUrl = (
            $this->config['api_base_url'] . 
            $this->config['api_endpoints']['createFulfillmentOrder']
        );

        $requestHeaders = [
            'Content-Type: application/x-www-form-urlencoded',
            'x-amz-access-token: ' . $this->accessToken,
        ];

        $this->request->post($requestUrl, $requestHeaders, $fulfillment->data);
    }

    public function getFulfillmentOrder($fulfillmentOrderId): array
    {
        $this->checkAccessToken();

        $requestUrl = (
            $this->config['api_base_url'] . 
            $this->config['api_endpoints']['getFulfillmentOrder'] . 
            '/' . $fulfillmentOrderId
        );

        $requestHeaders = [
            'Content-Type: application/json',
            'x-amz-access-token: ' . $this->accessToken,
        ];

        return $this->request->get($requestUrl, $requestHeaders);
    }
}