# -*- coding: utf-8 -*-

# Importar las bibliotecas necesarias
from sklearn import datasets
from sklearn.model_selection import train_test_split
from sklearn.tree import DecisionTreeClassifier, plot_tree
import pandas as pd
import numpy as np
import json
'''
from sklearn.metrics import accuracy_score
from sklearn.metrics import confusion_matrix
import seaborn as sns
import matplotlib.pyplot as plt 
'''
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

'''
# Dividir el conjunto de datos en entrenamiento y prueba
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.3, random_state=42)
# Crear el modelo de árbol de decisión
clf = DecisionTreeClassifier()
# Entrenar el modelo con los datos de entrenamiento
clf.fit(X_train, y_train)
# Realizar predicciones en los datos de prueba
y_pred = clf.predict(X_test)
# Calcular la precisión del modelo
accuracy = accuracy_score(y_test, y_pred)
print("Precisión:", accuracy)
# Obtener la matriz de confusión
conf_matrix = confusion_matrix(y_test, y_pred)
class_names = np.unique(y)
# Orden deseado de las etiquetas
orden_etiquetas = ['Fuera de rango', 'Deficiente', 'Regular', 'Aceptable', 'Bueno', 'Excelente']
# Crear un mapeo de las etiquetas actuales a su índice deseado
mapeo_etiquetas = {etiqueta: indice for indice, etiqueta in enumerate(orden_etiquetas)}
# Reordenar la matriz de confusión y las etiquetas
conf_matrix_reordenada = conf_matrix[np.argsort(list(map(mapeo_etiquetas.get, class_names)))]
class_names_reordenados = np.array(orden_etiquetas)
# Visualizar la matriz de confusión reordenada
plt.figure(figsize=(8, 6))
sns.heatmap(conf_matrix_reordenada, annot=True, fmt='d', cmap='Blues', xticklabels=class_names_reordenados, yticklabels=class_names_reordenados)
plt.xlabel('Clases Predichas')
plt.ylabel('Clases Reales')
plt.title('Matriz de Confusión')
plt.show()
'''