<?php
echo (dirname(__FILE__) . '/lib/MaiCoin.php');
require_once(dirname(__FILE__) . '/lib/MaiCoin.php');

$_API_KEY = "YOUR_API_KEY";
$_API_SECRET = "YOUR_API_SECRET"

$maicoin = MaiCoin::withApiKey($_API_KEY, $_API_SECRET);
echo PHP_EOL;

echo "Prices:".PHP_EOL;
echo json_encode($maicoin->getPrices()).PHP_EOL;
echo json_encode($maicoin->getPrices('twd')).PHP_EOL;
echo json_encode($maicoin->getPrices('cny')).PHP_EOL;
echo json_encode($maicoin->getPrices('usd')).PHP_EOL;
echo PHP_EOL;

echo "Currencies:".PHP_EOL;
echo json_encode($maicoin->getCurrencies()).PHP_EOL;
echo PHP_EOL;


echo 'Account:'.PHP_EOL;
echo 'Balance: ' . json_encode($maicoin->getBalance()). PHP_EOL;
echo 'Receive address:' . json_encode($maicoin->getReceiveAddress()).PHP_EOL;
echo 'Addresses:' . json_encode($maicoin->getAddresses()).PHP_EOL;
echo 'Generate receive address'.json_encode($maicoin->generateReceiveAddress()).PHP_EOL;
echo PHP_EOL;


echo 'Orders:'.PHP_EOL;
echo json_encode($maicoin->getOrders()).PHP_EOL;
echo json_encode($maicoin->getOrders(2,1)).PHP_EOL;
//echo json_encode($maicoin->buyBtc(1.123)).PHP_EOL;
//echo json_encode($maicoin->sellBtc(1.45)).PHP_EOL;
echo PHP_EOL;

echo 'Transactions:'.PHP_EOL;
echo json_encode($maicoin->getTransactions()).PHP_EOL;
echo json_encode($maicoin->getTransactions(2,1)).PHP_EOL;
echo PHP_EOL;

echo 'Checkout:'.PHP_EOL;
$checkout = $maicoin->newCheckoutParamBuilder();
$checkout->setCheckoutData(10, 'twd', 'http://my.com/return',
    'http://my.com/cancel', 'http://my.com/callback', 'SKU-2324',
    'userid=199', 'zh-TW');
$checkout->setBuyerData("yl", 'add1', 'add2', 'palo alto', 'ca', '94535',
    'abcd@gmail.com','6504898934', 'us');
$checkout->addItem('desc1', '1111', '100', 'twd', true);
$checkout->addItem('desc2', '2222', '200', 'twd', false);
$checkoutParam = $checkout->build();
echo json_encode($checkoutParam).PHP_EOL;
$newCheckout = $maicoin->createCheckout($checkoutParam);
echo json_encode($newCheckout).PHP_EOL;
echo json_encode($maicoin->getCheckout($newCheckout->checkout->uid)).PHP_EOL;
echo json_encode($maicoin->getCheckouts()).PHP_EOL;
echo json_encode($maicoin->getCheckouts(2,1)).PHP_EOL;
echo PHP_EOL;
