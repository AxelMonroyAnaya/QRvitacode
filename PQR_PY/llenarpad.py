from PQR_PY.conexion import conexion
import random

database = conexion()

cursor = database.cursor()

print(type(database), type(cursor))

cursor.execute("describe padecimiento")
db = cursor.fetchall()
for i in db:
    print(f"{i}\n")

antecedentes_clinicos = (
    "Hipertensión",
    "Diabetes",
    "Colesterol alto",
    "Enfermedad cardíaca",
    "Asma",
    "EPOC",
    "Artritis",
    "Osteoporosis",
    "Cáncer",
    "Hepatitis",
    "renal",
    "ninguna"
)

medicamentos = (
    "Lisinopril",   # Hipertensión
    "Metformina",   # Diabetes
    "Atorvastatina",# Colesterol alto
    "Aspirina",     # Enfermedad cardíaca
    "Salbutamol",   # Asma
    "Tiotropio",    # EPOC
    "Ibuprofeno",   # Artritis
    "Alendronato",  # Osteoporosis
    "Cisplatino",   # Cáncer
    "Ribavirina",   # Hepatitis
    "Furosemida",   # Renal
    "N/A"           # Ninguna
)

sintomas = (
    "Presión arterial alta",              # Hipertensión
    "Niveles altos de azúcar en sangre",  # Diabetes
    "Niveles altos de colesterol",        # Colesterol alto
    "Dolor en el pecho",                  # Enfermedad cardíaca
    "Dificultad para respirar",           # Asma
    "Dificultad para respirar persistente",# EPOC
    "Dolor e inflamación en las articulaciones", # Artritis
    "Fragilidad ósea",                    # Osteoporosis
    "Crecimiento anormal de células",     # Cáncer
    "Inflamación del hígado",             # Hepatitis
    "Función renal deteriorada",          # Renal
    "Sin síntomas"                        # Ninguna
)

observaciones = (
    "Requiere monitoreo regular de la presión arterial", # Hipertensión
    "Es importante controlar la dieta y la glucosa",     # Diabetes
    "Necesario realizar pruebas de colesterol periódicas", # Colesterol alto
    "Consultar a un cardiólogo regularmente",            # Enfermedad cardíaca
    "Uso de inhaladores según sea necesario",            # Asma
    "Requiere terapia con broncodilatadores",            # EPOC
    "Puede necesitar fisioterapia y medicamentos",       # Artritis
    "Suplementación de calcio y vitamina D recomendada", # Osteoporosis
    "Seguimiento con oncología",                         # Cáncer
    "Evitar consumo de alcohol y hepatotóxicos",         # Hepatitis
    "Requiere control de la función renal",              # Renal
    "No requiere intervención médica"                    # Ninguna
)


sql = "insert into padecimiento(numPade,nombrePadecimiento, medicamento, sintomas, observaciones) values(%s,%s, %s, %s, %s)"
for j in range(12):
    valores = (j,antecedentes_clinicos[j],medicamentos[j],sintomas[j],observaciones[j])
    cursor.execute(sql,valores)
database.commit()


cursor.close()
database.close()