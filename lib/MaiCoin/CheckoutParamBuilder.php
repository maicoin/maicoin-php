<?php

class MaiCoin_CheckoutParamBuilder
{
    private $_checkoutData;
    private $_buyerData;
    private $_items;

    public function __construct()
    {
        $this->_items = array();
        $this->_buyerData = array();
        $this->_checkoutData = array();
    }

    public function build()
    {
        $this->_checkoutData['buyer'] = $this->_buyerData;
        $this->_checkoutData['items'] = $this->_items;
        return array (
            'checkout' => $this->_checkoutData
        );
    }

    public function setCheckoutData($amount, $currency, $returnUrl, $cancelUrl,
                                    $callbackUrl,$merchantRefId="", $posData="", $locale="zh-TW")
    {
        $this->_checkoutData = array(
            'amount'=>$amount,
            'currency'=>$currency,
            'return_url'=>$returnUrl,
            'cancel_url'=>$cancelUrl,
            'callback_url'=>$callbackUrl,
            'merchant_ref_id'=>$merchantRefId,
            'pos_data'=>$posData,
            'locale'=>$locale
        );
    }

    public function setBuyerData($name="", $address1="", $address2="",
        $city="", $state="", $zip="", $email="", $phone="", $country="")
    {
        $this->_buyerData = array(
            'buyer_name' => $name,
            'buyer_address1' => $address1,
            'buyer_address2' => $address2,
            'buyer_city' => $city,
            'buyer_state' => $state,
            'buyer_zip' => $zip,
            'buyer_email' => $email,
            'buyer_phone' => $phone,
            'buyer_country' => $country
        );
    }

    public function addItem($description="", $code="", $price="", $currency="", $isPhysical="")
    {
        $item = array(
            'item' => array(
                'description'=>$description,
                'code'=>$code,
                'price'=>$price,
                'currency'=>$currency,
                'is_physical'=>$isPhysical
            )
        );
        array_push($this->_items, $item);
    }
}