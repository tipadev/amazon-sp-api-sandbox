# Amazon Selling Partner API sandbox project

### This project contains a command that sends sandbox requests to [Amazon Selling Partner API (SP-API)](https://developer-docs.amazon.com/sp-api) to fulfill the order using seller inventory in Amazon's fulfillment network (FBA) and returns the tracking number

#### To run the command, you need to fill in `api_client_id`, `api_client_secret` and `api_refresh_token` fields in the `config.php` file and then execute:
```
php ./track.php 16400
```

#### 16400 is the order number that is mocked up in the project