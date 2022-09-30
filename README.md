## About Application

The application downloads transactions from the ethereum network for the selected wallet.

The etherscan API is used.

Due to API limits (max 10000 transactions per request), the application downloads data in segments of 1 million blocks.
If segment has more than 10000 transaction, the application tries with a smaller segment.

Users must first add the wallet to the list of tracked wallets.
For the added wallet, the user must activate the synchronization option.
After transactions download is finished, the user can search for transactions data within a desired range of blocks.

The download process for wallets with a large number of transactions (10000+) can be tracked in app/storage/logs/laravel.log
Download time for 100000 transaction is about 10 minutes.

## Installation

git clone https://github.com/mariomilunovic/eth-crawler.git eth-crawler

cd eth-crawler

composer install

npm install
npm run build

sail up -d
