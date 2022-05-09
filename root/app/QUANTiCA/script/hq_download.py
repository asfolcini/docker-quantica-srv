import yfinance as yf
import mysql.connector

print("-----------------------------------------------------------------------")
print("-- Historical Quotes Downloader ( Yahoo Finance Daily ) --")
print("-----------------------------------------------------------------------")

def connect():
  return mysql.connector.connect(user='quantica_usr',password='quantica_psw', host='quantica-db',database='db-quantica-core',use_pure=1)

def getTickers():
  cnx = connect();
  cursor = cnx.cursor()
  query = ("SELECT symbol,description FROM data_securities WHERE timeframe='1day'")
  cursor.execute(query)
  symbols = []
  for (symbol,description) in cursor:
    symbols.append(symbol)
  cursor.close()
  cnx.close()
  return symbols

def doUpdate(records):
  cnx = connect();
  cursor = cnx.cursor()
  for t,u in records:
    query = ("UPDATE data_securities set lastquote_date ='"+u+"' WHERE symbol='"+t+"' and timeframe='1day'")
    cursor.execute(query)
    cnx.commit()
    print(t+" DB table updated")
  cursor.close()
  cnx.close()

tickers = getTickers()
updates = []

for t in tickers:
  print("Downloading ticker "+t+".. .")
  hq = yf.Ticker(t)
  # get historical market data
  ofile = "/quantica/quantica/resources/"+t+".csv"
  hq.history(period="max").to_csv(ofile)
  try:
    f1 = open(ofile, "r")
    last = f1.readlines()[-1].split(",")[0]
    f1.close()
    updates.append([t,last])
  except:
    print("Exception in getting lastquoteTS!")

doUpdate(updates)
print("All done.")
