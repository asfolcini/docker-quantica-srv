import yfinance as yf
import mysql.connector 

print("-----------------------------------------------------------------------")
print("--       Historical Quotes Downloader ( Yahoo Finance Daily )        --")
print("-----------------------------------------------------------------------")


# Define a function `plus()`
def getTickers():
    cnx = mysql.connector.connect(user='quantica_usr',password='quantica_psw', host='quantica-db',database='db-quantica-core',use_pure=1)
    cursor = cnx.cursor()

    query = ("SELECT symbol,description FROM data_securities WHERE timeframe='1day'");

    cursor.execute(query)

    symbols = []

    for (symbol,description) in cursor:  
        symbols.append(symbol)

    cursor.close()
    cnx.close()
    return symbols


tickers = getTickers()

for t in tickers:

  print("Downloading ticker "+t+".. .")

  hq = yf.Ticker(t)

  # get historical market data
  hq.history(period="max").to_csv("/quantica/quantica/resources/"+t+".csv")


print("All done.")
