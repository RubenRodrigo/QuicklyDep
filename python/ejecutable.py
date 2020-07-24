# Estas son las librerias requridas para el funcionamiento
import urllib.parse
import requests
import sys
import networkx as nx # nx es un alias
import pandas as pd # pd es un alias
import matplotlib.pyplot as plt # plt es un alias
from tkinter import *

class Aplicacion():
    def __init__(self):        
        self.window = Tk()

    def createWindow(self):        

        self.window.title("QuicklyDep")
        self.window.geometry('800x250')
        # Titulo
        self.titulo = Label(self.window, text="Bienvenido al Serivicio Premiun de QuicklyDep")
        self.titulo.grid(column=1, row=0)

        # Label para usar una fila
        self.lblAux = Label(self.window, text="")
        self.lblAux.grid(column=1, row=1)
        # Label para usar una fila
        self.lblAuxPost = Label(self.window, text="")
        self.lblAuxPost.grid(column=1, row=1)

        # Label para usar una fila
        self.lblUsuario = Label(self.window, text="Ingrese el email de su usuario")
        self.lblUsuario.grid(column=0, row=2)
        self.txtUsuario = Entry(self.window,width=10)
        self.txtUsuario.grid(column=1, row=2)


        # Label para la direccion actual
        self.lblDireccion = Label(self.window, text="Ingrese su direccion")
        self.lblDireccion.grid(column=0, row=3)
        self.txtDireccion = Entry(self.window,width=10)
        self.txtDireccion.grid(column=1, row=3)

        # Label para el ID del post
        self.lblPost = Label(self.window, text="Ingrese el ID del POST")
        self.lblPost.grid(column=0, row=4)
        self.txtPost = Entry(self.window,width=10)
        self.txtPost.grid(column=1, row=4)

        # Interfaz
        self.lblTuDireccion = Label(self.window, text="Estas en: ")
        self.lblTuDireccion.grid(column=0, row=5)

        self.lblTuDestino = Label(self.window, text="Vas a:")
        self.lblTuDestino.grid(column=0, row=6)

        # Ruta Optima
        self.lblRuta = Label(self.window, text="")
        self.lblRuta.grid(column=0, row=7)
        
        # Boton
        self.btn = Button(self.window, text="Click Me", command=self.clicked)
        self.btn.grid(column=1, row=8)
        self.window.mainloop()

    # Evento del boton
    def clicked(self):
        # Direcciones de la API
        urlUser = "http://54.174.156.194/api/user/" + self.txtUsuario.get()
        urlPost = "http://54.174.156.194/api/post/" + self.txtPost.get()
        
        # Comprobacion
        if requests.get(urlUser).json() and requests.get(urlPost).json():
            json_user = requests.get(urlUser).json()            
            if json_user[0]["tipo"]=="Premiun":
                json_data = requests.get(urlPost).json()
                print("URLUSER: " + (urlUser))
                print("URL: " + (urlPost))                

                # Ruta Incio
                res = "Estas en: " + self.txtDireccion.get()
                self.lblTuDireccion.configure(text= res)

                # Ruta Destino
                res = "Vas a: " + str(json_data[0]["ciudad"])
                self.lblTuDestino.configure(text= res)

                # Ruta Optima                
                ruta = self.destino(self.txtDireccion.get(), json_data[0]["ciudad"])
                self.lblRuta.configure(text = "La ruta optima es: " + str(ruta))

            else:
                self.lblAux.configure(text="Su usuario no es premiun")    
        else:
            self.lblAux.configure(text="Correo o id incorrecto")

    # Se genera el objeto con los datos del archivo de ciudades 
    def destino(self, origin, destination):
        plt.rcParams['figure.figsize'] = (20.0, 10.0)
        destinos = pd.read_csv('destinos.csv')
        destinos.head()
        # iata_spain.set_index(["code"], inplace=True)
        self.DG=nx.DiGraph()
        for row in destinos.iterrows():
            self.DG.add_edge(row[1]["Origen"],
                        row[1]["Destino"],
                        duracion=row[1]["Duracion"],
                        kilometros=row[1]["Kilometros"],
                        combustible=row[1]["Combustible"],)
        
        return self.get_shortest_path(self.DG, origin, destination)

    # Grafica los nodos y sus uniones
    def plot_shortest_path(self, path):
        print(path)
        positions = nx.circular_layout(self.DG)
        
        nx.draw(self.DG, pos=positions,
                    node_color='lightblue',
                    edge_color='gray',
                    font_size=24,
                    width=1, with_labels=True, node_size=3500, alpha=0.8
            )
        
        short_path=nx.DiGraph()
        for i in range(len(path)-1):
            short_path.add_edge(path[i], path[i+1])
        
        nx.draw(short_path, pos=positions,
                    node_color='dodgerblue',
                    edge_color='dodgerblue',
                    font_size=24,
                    width=3, with_labels=True, node_size=3000
            )
        plt.show()

    # Se genera el camino optimo
    def get_shortest_path(self, DiGraph, origin, destination):
        print("*** Origen: %s Destino: %s" % (origin, destination))
        
        try:
            for weight in [None, "Duracion",]:
                print(" Ordenado por: %s" % weight)
                path = list(nx.astar_path(DiGraph,
                                        (origin),
                                        (destination),
                                        weight=weight
                                        ))
                print("   Camino óptimo: %s " % path)
                # show_path(path)
                self.plot_shortest_path(path)
            return path
        except:
            return "Esa ciudad no existe"

app = Aplicacion()
app.createWindow()