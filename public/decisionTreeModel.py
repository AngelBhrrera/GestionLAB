# Importar las bibliotecas necesarias
from sklearn import datasets
from sklearn.model_selection import train_test_split
from sklearn.tree import DecisionTreeClassifier, plot_tree
from sklearn.metrics import accuracy_score
from sklearn.metrics import confusion_matrix
import pandas as pd
import numpy as np
import json

#SS MODULAR RENDIMIENTO CALCULADOR
df2 = pd.read_csv('registro_acts.csv')

X = df2.drop(columns=['resultado','id_prestador','id_actividad']) 
y = df2['resultado'] 
X = pd.get_dummies(X)

clf = DecisionTreeClassifier()
clf.fit(X, y)
 
df_acts = pd.read_csv("act.csv")
df_users = pd.read_csv("users.csv")
df_acts['key'] = 0
df_users['key'] = 0

# Realizar la fusión para crear el producto cartesiano
df_merged = pd.merge(df_acts, df_users, how='outer', on='key').drop(columns=['id_actividad', 'id_prestador', 'key'])
test = pd.get_dummies(df_merged)
test = df_merged.reindex(columns=X.columns, fill_value=0)

y_pred_example = clf.predict(test)

# Crear un nuevo DataFrame con las columnas id_prestador y resultado
df_resultados = pd.DataFrame({'id_prestador': df_users['id_prestador'], 'resultado': y_pred_example})

# Ordenar el nuevo DataFrame por la columna resultado de mayor a menor
df_resultados_sorted = df_resultados.sort_values(by='resultado', ascending=False)

# Convertir el DataFrame a un diccionario de Python
resultados_dict = df_resultados_sorted.to_dict(orient='records')

# Convertir el diccionario a una cadena JSON
resultados_json = json.dumps(resultados_dict)

# Imprimir la cadena JSON para verificar
print(resultados_json)

