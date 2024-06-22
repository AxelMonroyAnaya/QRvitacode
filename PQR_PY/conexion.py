import mysql.connector
def conexion():
    Conex = mysql.connector.connect(
        host = "localhost",
        user = "root",
        passwd = "",
        database = "qrmotors",
        port = 3308
        
     )
    return Conex




