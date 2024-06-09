const ccxt = require('ccxt');
const axios = require('axios');
const qs = require('qs');

(async function() {
    let exchange = new ccxt.binance({
        enableRateLimit: true,
    });

    const coins = [
        { id: 1, symbol: 'BTC/USDT' },
        { id: 2, symbol: 'ETH/USDT' },
        { id: 3, symbol: 'LTC/USDT' },
    ];

    while (true) {
        for (const coin of coins) {
            let ticker = await exchange.fetchTicker(coin.symbol);
            console.log(`${coin.symbol}: ${ticker['last']}`);

            // Send the price and coin id to the PHP script
            axios.post('http://localhost/ProjectSS/php/update_price.php', qs.stringify({ price: ticker['last'], id: coin.id }))
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    console.error(error);
                });
        }

        // Wait for 5 seconds
        await new Promise(resolve => setTimeout(resolve, 60000));
    }
})();