<?php

class MaiCoin
{
    const API_BASE = 'https://api.maicoin.com/v1/';
    private $_rpc;
    private $_authentication;

    public static function withApiKey($key, $secret)
    {
        return new MaiCoin(new MaiCoin_ApiKeyAuthentication($key, $secret));
    }

    ####################### Constructor #######################
    public function __construct($authentication, $tokens=null, $apiKeySecret=null)
    {
        // First off, check for a legit authentication class type
        if (is_a($authentication, 'MaiCoin_Authentication')) {
            $this->_authentication = $authentication;
        }
        $this->_rpc = new MaiCoin_Rpc(new MaiCoin_Requestor(), $this->_authentication);
    }

    ####################### Http Utils #######################
    public function get($path, $params=array())
    {
        return $this->_rpc->request("GET", $path, $params);
    }

    public function post($path, $params=array())
    {
        return $this->_rpc->request("POST", $path, $params);
    }

    public function delete($path, $params=array())
    {
        return $this->_rpc->request("DELETE", $path, $params);
    }

    ####################### Parameter Utils #######################
    public function newCheckoutParamBuilder()
    {
        return new MaiCoin_CheckoutParamBuilder();
    }
    ####################### API #######################

    ##### Get btc pricing
    public function getPrices($currency='TWD')
    {
        return $this->get("prices/".$currency);
    }

    ##### Get supported currencies
    public function getCurrencies()
    {
        return $this->get("currencies");
    }

    ##### Get account balance
    public function getBalance()
    {
        return $this->get("account/balance", array());
    }

    ##### Get most recent receive address
    public function getReceiveAddress()
    {
        return $this->get("account/receive_address", array());
    }

    ##### Get all receive addresses
    public function getAddresses()
    {
        return $this->get("account/addresses", array());
    }

    ##### Generate new receive address
    public function generateReceiveAddress()
    {
        return $this->post("/account/receive_address", array());
    }

    ##### Get orders
    public function getOrders($page=1, $limit=25)
    {
        return $this->get("orders", array(
            "page" => $page,
            "limit" => $limit
        ));
    }

    ##### Buy BTC
    public function buyBtc($amount)
    {
        return $this->post("orders", array(
            "type" => "buy",
            "amount" => $amount
        ));
    }

    ##### Sell BTC
    public function sellBtc($amount)
    {
        return $this->post("orders", array(
            "type" => "sell",
            "amount" => $amount
        ));
    }

    ##### Get transaction
    public function getTransactions($page=1, $limit=25)
    {
        return $this->get("transactions", array(
            "page" => $page,
            "limit" => $limit
        ));
    }

    public function getTransaction($txid)
    {
        return $this->get("transactions/".$txid, array());
    }

    ##### Request btc
    public function requestBtc($address, $amount, $currency, $notes=null)
    {
        return $this->post("transactions", array(
            "type" => "request",
            "address" => $address,
            "amount" => $amount,
            "currency" => $currency,
            "notes" => $notes
        ));
    }

    ##### Cancel request btc
    public function cancelRequestBtc($txid)
    {
        return $this->delete("transactions/".$txid);
    }
    ##### Create checkout
    public function createCheckout($checkoutParam)
    {
        return $this->post("checkouts", $checkoutParam);
    }

    ##### Get checkout
    public function getCheckout($checkoutUid)
    {
        return $this->get("checkouts/".$checkoutUid);
    }

    #### Get recent checkouts
    public function getCheckouts($page=1, $limit=25)
    {
        return $this->get("checkouts", array(
            "page" => $page,
            "limit" => $limit
        ));
    }
}
