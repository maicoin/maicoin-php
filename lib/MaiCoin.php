<?php

if(!function_exists('curl_init')) {
    throw new Exception('The MaiCoin client library requires the CURL PHP extension.');
}

require_once(dirname(__FILE__) . '/MaiCoin/Exception.php');
require_once(dirname(__FILE__) . '/MaiCoin/ApiException.php');
require_once(dirname(__FILE__) . '/MaiCoin/ConnectionException.php');
require_once(dirname(__FILE__) . '/MaiCoin/CheckoutParamBuilder.php');
require_once(dirname(__FILE__) . '/MaiCoin/MaiCoin.php');
require_once(dirname(__FILE__) . '/MaiCoin/Requestor.php');
require_once(dirname(__FILE__) . '/MaiCoin/Rpc.php');
require_once(dirname(__FILE__) . '/MaiCoin/Authentication.php');
require_once(dirname(__FILE__) . '/MaiCoin/ApiKeyAuthentication.php');
