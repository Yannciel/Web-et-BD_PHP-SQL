#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
    Mingqiang WANG
    Transformer un fichier csv en un fichier csv
    usage : python3 csv2tableau.py
    Date : 27/12/2017
"""
import csv
import os
with open(os.path.join('..','Data','fontaines-a-boire.csv'),'r') as file:
    file.readline()
    contenu1=[]
    contenu2=[]
    contenu3=[]
    i=1
    for line in file:
        line=line.rstrip().split(';')[0:]
        if len(line)==31:
            line[30]=line[30].replace('1','Oui')
            line[30]=line[30].replace('0','Non')
            contenu1.append((i,line[8],line[6],line[0]))
            if line[14] =="Non":
                contenu2.append((i,line[9],'Ce sont des descriptions de la fontaine !!!!', 'url',line[30],line[14]))
            else :
                contenu2.append((i,line[9],'Ce sont des descriptions de la fontaine !!!!', 'url',line[30],"Oui"))
            contenu3.append((i,'Ce sont des commentaires!!!',i))
            i+=1

Header1=["Id","Arrondissement","Adresse","Location"]
Header2=["Id","Modele","Description","Photo","Potable","Ouvert"]
Header3=["Id","Commentaires",'FontaineId']
   
with open(os.path.join('..','Data','tableau1.csv'),'w') as f:
    f_csv = csv.writer(f)
    f_csv.writerow(Header1)
    f_csv.writerows(contenu1)
            
with open(os.path.join('..','Data','tableau2.csv'),'w') as f2:
    f_csv = csv.writer(f2)
    f_csv.writerow(Header2)
    f_csv.writerows(contenu2)
    
with open(os.path.join('..','Data','tableau3.csv'),'w') as f3:
    f_csv = csv.writer(f3)
    f_csv.writerow(Header3)
    f_csv.writerows(contenu3)
        