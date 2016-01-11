import mysql.connector
import datetime
cnx = mysql.connector.connect(user='b3ed445a17e1e3', password="ddff34c6", host="eu-cdbr-azure-west-c.cloudapp.net", database='waterlevel')
cursor = cnx.cursor()


query = ("SELECT count(*) FROM measurements")
cursor.execute(query)
rc = cursor.fetchone()
count =rc[0]
ctr = 1
cursor.close()
cnx.close()

connection = mysql.connector.connect(user='b3ed445a17e1e3', password="ddff34c6", host="eu-cdbr-azure-west-c.cloudapp.net", database='waterlevel')
kurz = connection.cursor()

with open('meritve.txt','r') as f:
    for line in f:
        
        besede = line.split('#')
        datum = datetime.datetime.fromtimestamp(float(besede[2])).strftime('%Y-%m-%d %H:%M:%S')
        if(ctr>count):
            print(datum)
            vnos = ("INSERT INTO measurements (WaterLevel,BatteryVoltage,TimeStamp) VALUES(%s, %s, %s)")
            podatki =(besede[0],besede[1],datum)
            kurz.execute(vnos,podatki)
        ctr+=1

connection.commit()
kurz.close()
connection.close()


