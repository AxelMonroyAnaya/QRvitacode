from PQR_PY.conexion import conexion
import random

database = conexion()

cursor = database.cursor()

print(type(database), type(cursor))

cursor.execute("describe datospersonales")
db = cursor.fetchall()
for i in db:
    print(f"{i}\n")

curps_mexicanas = (
    "BIMM860605HMNFRNL4",
    "CQPM900712HMNFRN09",
    "DUAM750315HMNFRNR0",
    "EGMM821101HMNFRNG1",
    "FOPP880725HMNFRPL2",
    "GNMA930430HMNFRVR3",
    "HOSJ751206HMNFRBS4",
    "IASM881019HMNFRSD5",
    "JBVS800503HMNFRBS6",
    "KASM891224HMNFRSL7",
    "LIGM810907HMNFRBL8",
    "MAMA940718HMNFRPL9",
    "NDNM860215HMNFRSLA",
    "OERF900526HMNFRDLB",
    "PIGR761207HMNFRGRC",
    "QASV801223HMNFRBLE",
    "ROBG880410HMNFRSDG",
    "SLAN910519HMNFRNRL",
    "TORM750809HMNFRDLL",
    "UEVR811112HMNFRTNM",
    "VUNN940222HMNFRVDN",
    "WRCT850313HMNFRSDO",
    "XANP790724HMNFRRLP",
    "YARV920215HMNFRVLL",
    "ZLBP831019HMNFRNCP",
    "AECQ920630HMNFRSRCQ",
    "BELR791101HMNFRTN2R",
    "CSTM860315HMNFRSL2S",
    "DLRR930416HMNFRTN2T",
    "EONR890525HMNFRNRM",
    "FABM751107HMNFRBLM",
    "GMRM841228HMNFRBLN",
    "HDRN911201HMNFRNRP",
    "ILKQ890731HMNFRTNQ",
    "JMIB780902HMNFRBDR",
    "KDLS950313HMNFRSLA",
    "LOBN840126HMNFRTNB",
    "MNNM930409HMNFRNRC",
    "NUAC780419HMNFRPLC",
    "ORCW800525HMNFRRNC",
    "PARM920612HMNFRCDR",
    "QAON860714HMNFRRNN",
    "RERH910813HMNFRSDD",
    "SARR790924HMNFRBLR",
    "TEHN940529HMNFRNRH",
    "UNNA810620HMNFRNNA",
    "VUSB900721HMNFRBSW",
    "WNRH761215HMNFRRNA"
)
largo = len(curps_mexicanas)
print(largo)
nombres = (
    "Ana",
    "Benito",
    "César",
    "Daniela",
    "Elena",
    "Fernando",
    "Gabriela",
    "Héctor",
    "Juan",
    "Karla",
    "Luis",
    "María",
    "Natalia",
    "Oscar",
    "Patricia",
    "Quintín",
    "Rosaura",
    "Salvador",
    "Tomás",
    "Ulises",
    "Vero",
    "Wendy",
    "Ximena",
    "Yahir",
    "Zaira",
    "Alejandro",
    "Beatriz",
    "Cecilia",
    "Diego",
    "Felipe",
    "Gerardo",
    "Hilda",
    "Irma",
    "Jorge",
    "Kenia",
    "Leonel",
    "Melissa",
    "Nancy",
    "Omar",
    "Paola",
    "Quetzal",
    "Ricardo",
    "Sofía",
    "Tania",
    "Uriel",
    "Valeria",
    "Wendy",
    "Xiomara"
)
apellidos_paternos = (
    "Ornelas",
    "Pérez",
    "Ureña",
    "Arroyo",
    "Acosta",
    "Ávila",
    "Ortiz",
    "Aguilar",
    "Vázquez",
    "Álvarez",
    "Gómez",
    "Andrade",
    "Navarro",
    "Arias",
    "Iglesias",
    "Araujo",
    "Olvera",
    "Benavides",
    "Reyes",
    "Oviedo",
    "Nolasco",
    "Escobar",
    "Arguelles",
    "Rodríguez",
    "Barrios",
    "Escalante",
    "Fernández",
    "Torres",
    "Estrada",
    "Hernández",
    "Espinoza",
    "Ávila",
    "Ruiz",
    "Sánchez",
    "Espinosa",
    "López",
    "Jiménez",
    "Nolasco",
    "Ulloa",
    "Fernández",
    "Arias",
    "Ortega",
    "Flores",
    "Luna",
    "Herrera",
    "Nuñez",
    "Estrada",
    "Rivas"
)
apellidos_maternos = (
    "Martínez",
    "Méndez",
    "Alvarado",
    "Mena",
    "Paredes",
    "Montes",
    "Jiménez",
    "Morales",
    "Sánchez",
    "Sandoval",
    "Martínez",
    "Mendoza",
    "Molina",
    "Fernández",
    "Rodríguez",
    "Silva",
    "Benítez",
    "Nava",
    "Martínez",
    "Rivas",
    "Nájera",
    "Tapia",
    "Paredes",
    "Vega",
    "Pérez",
    "Aguilar",
    "Ruiz",
    "Martínez",
    "Barrera",
    "Ramírez",
    "Méndez",
    "Ramírez",
    "Rivera",
    "Quintana",
    "Ibarra",
    "Salgado",
    "Navarro",
    "Cano",
    "Chávez",
    "Castillo",
    "Rangel",
    "Navarro",
    "Ramírez",
    "Reyes",
    "Hernández",
    "Naranjo",
    "Figueroa",
    "Hernández"
)
numeros_ss = (
    123456789,
    987654321,
    456789123,
    654321987,
    789123456,
    321987654,
    567891234,
    456789123,
    234567891,
    891234567,
    654321987,
    432198765,
    345678912,
    678912345,
    789123456,
    456789123,
    987654321,
    234567891,
    789123456,
    567891234,
    456789123,
    123456789,
    345678912,
    567891234,
    456789123,
    987654321,
    345678912,
    891234567,
    234567891,
    456789123,
    987654321,
    123456789,
    789123456,
    234567891,
    567891234,
    987654321,
    345678912,
    678912345,
    234567891,
    987654321,
    456789123,
    345678912,
    891234567,
    123456789,
    567891234,
    234567891,
    456789123,
    789123456,
    345678912,
    987654321
)
nacionalidades = (
    "Mexicana",
    "Española",
    "Argentina",
    "Brasileña",
    "Colombiana",
    "Peruana",
    "Chilena"
)
pesos = (
    65.75,
    80.50,
    55.25,
    70.80,
    90.00,
    76.98,
    66.74
)
tipos_sangre = (
    "A+",
    "B-",
    "AB+",
    "O-",
    "A-",
)
numeros_telefonicos = (
    "555-123-4567",
    "555-234-5678",
    "555-345-6789",
    "555-456-7890",
    "555-567-8901",
    "555-678-9012",
    "555-789-0123",
    "555-890-1234",
    "555-901-2345",
    "555-012-3456",
    "555-123-4567",
    "555-234-5678",
    "555-345-6789",
    "555-456-7890",
    "555-567-8901",
    "555-678-9012",
    "555-789-0123",
    "555-890-1234",
    "555-901-2345",
    "555-012-3456",
    "555-123-4567",
    "555-234-5678",
    "555-345-6789",
    "555-456-7890",
    "555-567-8901",
    "555-678-9012",
    "555-789-0123",
    "555-890-1234",
    "555-901-2345",
    "555-012-3456",
    "555-123-4567",
    "555-234-5678",
    "555-345-6789",
    "555-456-7890",
    "555-567-8901",
    "555-678-9012",
    "555-789-0123",
    "555-890-1234",
    "555-901-2345",
    "555-012-3456",
    "555-123-4567",
    "555-234-5678",
    "555-345-6789",
    "555-456-7890",
    "555-567-8901",
    "555-678-9012",
    "555-789-0123",
    "555-890-1234"
)

numeroAntecedente=[]
for i in range(100):
    numeroAntecedente.append(int(i))
    print(numeroAntecedente)
sexo = ("masculino", "femenino")

print(len(curps_mexicanas),len(nombres), len(apellidos_maternos), len(apellidos_paternos), len(numeros_ss))

sql = "insert into datospersonales(curp, nombre, apellido_p, apellido_m, NumeroSS, nacionalidad, peso, tipoSangre, sexo,numero, numeroAntecedente) values(%s, %s, %s, %s, %s, %s,%s,%s,%s,%s,%s)"
for j in range(len(curps_mexicanas)):
    valores = (curps_mexicanas[j], nombres[j],apellidos_paternos[j], apellidos_maternos[j],numeros_ss[j], random.choice(nacionalidades), random.choice(pesos),  random.choice(tipos_sangre),random.choice(sexo), numeros_telefonicos[j], numeroAntecedente[j])
    cursor.execute(sql,valores)
database.commit()


cursor.close()
database.close()