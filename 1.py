#!/usr/bin/python
import json
print "Content-type:text/html\r\n\r\n"
#IMPORTAMOS LA CLASE TIME PARA DETERMINAR EL TIEMPO DE NUESTRO PROGRAMA
from time import time

class Producto():
    def __init__(self, codigo, descripcion, stock):
        self.codigo = codigo
        self.descripcion = descripcion
        self.stock = stock

    def __str__(self):
        return {'codigo': str(self.codigo),"descripcion":str(self.descripcion) ,"stock":str(self.stock)}

data = {}
data['productos'] = []

t_inicio = time()

for i in range(0,10):
    producto=Producto("000"+str(i),"DESCRIPCION"+str(i),i*10)
    data['productos'].append(producto.__str__())

print(json.dumps(data, indent=4))

t_fin = time()
t_demora=t_fin - t_inicio
