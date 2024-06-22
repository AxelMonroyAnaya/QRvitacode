from PQR_PY.conexion import conexion
import random

database = conexion()

cursor = database.cursor()

print(type(database), type(cursor))

cursor.execute("describe antecedentes")
db = cursor.fetchall()
for i in db:
    print(f"{i}\n")

numPad = []
for i in range(12):
    numPad.append(i)
    
    
coagulopatia = (
    "Hemofilia A",
    "Hemofilia B",
    "von Willebrand",
    "II",
    "V",
    "factor VII",
    "X",
    "factor XI",
    "factor XIII",
    "Trombocitopenia",
    "Trombofilia",
    "ninguna",
    "ninguna",
    "ninguna",
    "ninguna",
    "ninguna",
    "ninguna"
)
alergias = (
    "Penicilina",
    "Aspirina",
    "Ibuprofeno",
    "Amoxicilina",
    "Codeína",
    "Eritromicina",
    "Anestesia",
    "Insulina",
    "Sulfamidas",
    "Tetraciclina",
    "Cefalosporinas",
    "Morfina",
    "Naproxeno",
    "Metformina",
    "Doxiciclina",
    "Miconazol",
    "Paracetamol",
    "Diazepam",
    "Omeprazol",
    "Fluconazol",
    "ninguna",
    "ninguna",
    "ninguna",
    "ninguna",
    "ninguna",
    "ninguna"
)

anafilaxia = (
    "Cacahuetes",
    "Mariscos",
    "Picaduras",
    "Nueces",
    "Pólen",
    "Látex",
    "Lactosa",
    "Polvo",
    "Arañas",
    "Medicamentos",
    "Soja",
    "Leche",
    "Trigo",
    "Huevos",
    "Insectos",
    "Frutas",
    "Pescado",
    "Hongos",
    "Químicos",
    "Alcohol",
        "ninguna",
    "ninguna",
    "ninguna",
    "ninguna",
    "ninguna",
    "ninguna"
)

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
i = len(curps_mexicanas)

sql = "insert into antecedentes(numPade, coagulopatia, alergias , anafilaxia, curp) values(%s, %s, %s, %s, %s)"
for j in range(i):
    valores = (random.choice(numPad), random.choice(coagulopatia), random.choice(alergias), random.choice(anafilaxia), curps_mexicanas[j])
    cursor.execute(sql,valores)
database.commit()


cursor.close()
database.close()