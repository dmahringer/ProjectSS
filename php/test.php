<?php

require '../../vendor/autoload.php';

$exchange = new \ccxt\binance();

$ticker = $exchange->fetch_ticker('BTC/USDT');

echo "Symbol: " . $ticker['symbol'] . "\n";
echo "Timestamp: " . $ticker['timestamp'] . "\n";
echo "High: " . $ticker['high'] . "\n";
echo "Low: " . $ticker['low'] . "\n";
echo "Bid: " . $ticker['bid'] . "\n";
echo "Ask: " . $ticker['ask'] . "\n";
echo "Last: " . $ticker['last'] . "\n";
echo "Volume: " . $ticker['baseVolume'] . "\n";

echo "Current price: " . $ticker['last'] . "\n";

?>