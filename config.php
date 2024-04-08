<?php

return [
    'api_client_id' => '',
    'api_client_secret' => '',
    'api_refresh_token' => '',
    'api_base_url' => 'https://sandbox.sellingpartnerapi-na.amazon.com',
    'api_auth_url' => 'https://api.amazon.com/auth/o2/token',
    'api_endpoints' => [
        'createFulfillmentOrder' => '/fba/outbound/2020-07-01/fulfillmentOrders',
        'getFulfillmentOrder' => '/fba/outbound/2020-07-01/fulfillmentOrders',
        'getPackageTrackingDetails' => '/fba/outbound/2020-07-01/tracking',
    ],
];