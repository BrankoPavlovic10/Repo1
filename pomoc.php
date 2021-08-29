<?php
/*
create TABLE potpisnici (
IDpotpisa int(9) AUTO_INCREMENT PRIMARY KEY not null,
ime varchar(50) not null,
prezime varchar(50) not null,
telefon varchar(15) not null,
email varchar(50) not null,
lk varchar(20) not null,
komentar varchar(150) not null,
IDlokacije int(9) not null,
FOREIGN KEY (IDlokacije) REFERENCES lokacije(IDlok),
datum varchar(20) not null,
brTermina int(6) not null,
od7do9 varchar(10) not null,
od9do11 varchar(10) not null,
od11do13 varchar(10) not null,
od13do15 varchar(10) not null,
od15do17 varchar(10) not null,
od17do19 varchar(10) not null,
od19do21 varchar(10) not null,
infoMejl varchar(10) not null,
objava varchar(10) not null,
preuzet varchar(10) not null,
broj int(7) not null,
Xkord float(10) not null,
Ykord float(10) not null,
IDorganizatora int(9) not null   
);


TABELA VESTI


create table vesti (
IDvesti int(9) AUTO_INCREMENT PRIMARY KEY not null,
IDorganizatora int not null,
naslov varchar(60) not null,
datum varchar(50) not null,
sadrzaj varchar(250) not null

);


tabela organizatori-administratori
h

create table orgAdmin (
IDorg int(9) AUTO_INCREMENT PRIMARY KEY not null,
orgIme varchar(50) not null,
orgPrezime varchar(50) not null,
orgSifra varchar(20) not null,
orgTelefon varchar(20) not null,    
orgMejl varchar(50) not null,
orgLicnaKarta varchar(20) not null, 
orgOdobren int not null,
IDpreporuke int(9) not null,
nevPotpisi int not null,
nevPreporuke int not null,
orgIzbor varchar(15) not null    
    
);

tabela lokacije


CREATE TABLE lokacije (
IDlok int(9) AUTO_INCREMENT PRIMARY KEY not null,
IDorgadm int(9) not null,

IDbiraca int(9) not null,
nazivLok varchar(30) not null,
grad varchar(30) not null,    
opstina varchar(30) not null,
ulica varchar(30) not null
);