#!/bin/bash
logdate=`date +%F_%H%M%S`
python3 /app/QUANTiCA/script/hq_download.py > /config/log/quotes/quote_downloader_${logdate}.log
