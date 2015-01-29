CREATE DATABASE IF NOT EXISTS ciucholand;
use ciucholand;

CREATE TABLE IF NOT EXISTS uzytkownik(
	id INT(10) NOT NULL AUTO_INCREMENT,
	imie VARCHAR(30) NOT NULL,
	nazwisko VARCHAR(30) NOT NULL,
	adres VARCHAR(50) NOT NULL,
	telefon INT(9) NOT NULL,
	email VARCHAR(30) NOT NULL,
	login VARCHAR(30) NOT NULL,
	haslo VARCHAR(40) NOT NULL,
	PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE  IF NOT EXISTS roles(
	id INT(10) NOT NULL AUTO_INCREMENT,
	name VARCHAR(30) NOT NULL,
	PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS users_roles(
	user_id INT(10) NOT NULL,
	role_id INT(10) NOT NULL,
	PRIMARY KEY(user_id, role_id)
)ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS marka(
	id_marki INT(10) NOT NULL AUTO_INCREMENT,
	nazwa VARCHAR(30) NOT NULL,
	adres VARCHAR(30) NOT NULL,
	telefon INT(9) NOT NULL,
	email VARCHAR(30) NOT NULL,
	opis TEXT,
	PRIMARY KEY(id_marki)
)ENGINE=InnoDB;

CREATE TABLE  IF NOT EXISTS kolor(
	id_koloru INT(10) NOT NULL AUTO_INCREMENT,
	nazwa VARCHAR(30) NOT NULL,
	PRIMARY KEY(id_koloru)
)ENGINE=InnoDB;


CREATE TABLE  IF NOT EXISTS kolor_produktu(
	id_produktu INT(10) NOT NULL,
	id_koloru INT(10) NOT NULL,
	PRIMARY KEY(id_produktu,id_koloru)
)ENGINE=InnoDB;

CREATE TABLE  IF NOT EXISTS rozmiar(
	id_rozmiaru INT(10) NOT NULL AUTO_INCREMENT,
	nazwa VARCHAR(30) NOT NULL,
	PRIMARY KEY(id_rozmiaru)
)ENGINE=InnoDB;

CREATE TABLE  IF NOT EXISTS rozmiar_produktu(
	id_produktu INT(10) NOT NULL,
	id_rozmiaru INT(10) NOT NULL,
	PRIMARY KEY(id_produktu,id_rozmiaru)
)ENGINE=InnoDB;


CREATE TABLE  IF NOT EXISTS kategoria(
	id_kategorii INT(10) NOT NULL AUTO_INCREMENT,
	nazwa VARCHAR(30) NOT NULL,
	opis TEXT,
	PRIMARY KEY(id_kategorii)
)ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS produkt(
	id_produktu INT(10) NOT NULL AUTO_INCREMENT,
	nazwa VARCHAR(30) NOT NULL,
	id_marki INT(10) NOT NULL, 
	id_kategorii INT(10) NOT NULL, 
	cena DECIMAL(6,2) NOT NULL,
	opis TEXT,
	PRIMARY KEY(id_produktu)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS zamowienie(
	id_zamowienia INT(10) NOT NULL AUTO_INCREMENT,
	id_klienta INT(10) NOT NULL,
	upust DECIMAL(4,2), 
	data_zamowienia DATETIME,
	data_realizacji DATETIME,
	adres VARCHAR(50) NOT NULL,
	uwagi_dodatkowe TEXT,
	status VARCHAR(30),
	PRIMARY KEY(id_zamowienia)
)ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS szczegoly_zamowienia(
	id_zamowienia INT(10) NOT NULL AUTO_INCREMENT,
	id_produktu INT(10) NOT NULL,
	ilosc INT(10) NOT NULL,
	PRIMARY KEY(id_zamowienia,id_produktu)
)ENGINE=InnoDB;


ALTER TABLE users_roles ADD FOREIGN KEY (user_id) REFERENCES uzytkownik(id) ON DELETE CASCADE;
ALTER TABLE users_roles ADD FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE;
ALTER TABLE produkt ADD FOREIGN KEY (id_marki) REFERENCES marka(id_marki);
ALTER TABLE produkt ADD FOREIGN KEY (id_kategorii) REFERENCES kategoria(id_kategorii);
ALTER TABLE kolor_produktu ADD FOREIGN KEY (id_produktu) REFERENCES produkt(id_produktu) ON DELETE CASCADE;
ALTER TABLE kolor_produktu ADD FOREIGN KEY (id_koloru) REFERENCES kolor(id_koloru) ON DELETE CASCADE;
ALTER TABLE rozmiar_produktu ADD FOREIGN KEY (id_produktu) REFERENCES produkt(id_produktu) ON DELETE CASCADE;
ALTER TABLE rozmiar_produktu ADD FOREIGN KEY (id_rozmiaru) REFERENCES rozmiar(id_rozmiaru) ON DELETE CASCADE;
ALTER TABLE szczegoly_zamowienia ADD FOREIGN KEY (id_zamowienia) REFERENCES zamowienie(id_zamowienia) ON DELETE CASCADE;
ALTER TABLE szczegoly_zamowienia ADD FOREIGN KEY (id_produktu) REFERENCES produkt(id_produktu);
ALTER TABLE zamowienie ADD FOREIGN KEY (id_klienta) REFERENCES uzytkownik(id);

INSERT INTO roles (id,name) VALUES (1,'admin');
INSERT INTO uzytkownik(id,login,email,haslo) VALUES (1,'admin','admin@admin.pl',sha1('password'));
INSERT INTO users_roles(user_id,role_id) VALUES (1,1);

INSERT INTO kolor (nazwa) VALUES ('czerwony');
INSERT INTO kolor (nazwa) VALUES ('niebieski');
INSERT INTO kolor (nazwa) VALUES ('zielony');
INSERT INTO kolor (nazwa) VALUES ('czarny');
INSERT INTO kolor (nazwa) VALUES ('biały');
INSERT INTO kolor (nazwa) VALUES ('brązowy');

INSERT INTO rozmiar (nazwa) VALUES ('S');
INSERT INTO rozmiar (nazwa) VALUES ('M');
INSERT INTO rozmiar (nazwa) VALUES ('L');
INSERT INTO rozmiar (nazwa) VALUES ('XL');
INSERT INTO rozmiar (nazwa) VALUES ('XXL');

INSERT INTO kategoria (nazwa) VALUES ('spodnie');
INSERT INTO kategoria (nazwa) VALUES ('bluzy');
INSERT INTO kategoria (nazwa) VALUES ('T-shirt');
INSERT INTO kategoria (nazwa) VALUES ('kurtki');
INSERT INTO kategoria (nazwa) VALUES ('buty');
INSERT INTO kategoria (nazwa) VALUES ('bielizna');


INSERT INTO marka (nazwa) VALUES ('Cropp');
INSERT INTO marka (nazwa) VALUES ('H&M');
INSERT INTO marka (nazwa) VALUES ('Reserved');
INSERT INTO marka (nazwa) VALUES ('Nike');
INSERT INTO marka (nazwa) VALUES ('Adidas');


INSERT INTO produkt(nazwa,cena,id_kategorii,id_marki,opis) VALUES ('spodnie1','120.00',1,4,'nowa kolekcja');
INSERT INTO produkt(nazwa,cena,id_kategorii,id_marki,opis) VALUES ('bluza12','99.99',3,3,'nowa kolekcja');

INSERT INTO kolor_produktu(id_produktu,id_koloru) VALUES (1,1);
INSERT INTO kolor_produktu(id_produktu,id_koloru) VALUES (1,2);
INSERT INTO rozmiar_produktu(id_produktu,id_rozmiaru) VALUES (1,2);
INSERT INTO rozmiar_produktu(id_produktu,id_rozmiaru) VALUES (1,4);
INSERT INTO kolor_produktu(id_produktu,id_koloru) VALUES (2,3);
INSERT INTO rozmiar_produktu(id_produktu,id_rozmiaru) VALUES (2,4);
INSERT INTO kolor_produktu(id_produktu,id_koloru) VALUES (2,1);
INSERT INTO rozmiar_produktu(id_produktu,id_rozmiaru) VALUES (2,2);


INSERT INTO zamowienie (id_zamowienia,id_klienta,upust,uwagi_dodatkowe,status) VALUES (1,1,0,'rozmiary XXXL','nowe');
INSERT INTO szczegoly_zamowienia(id_zamowienia,id_produktu,ilosc) VALUES (1,1,1);
INSERT INTO szczegoly_zamowienia(id_zamowienia,id_produktu,ilosc) VALUES (1,2,2);

INSERT INTO zamowienie (id_zamowienia,id_klienta,upust,uwagi_dodatkowe,status) VALUES (2,1,0,'rozmiary M, czarne kolory','nowe');
INSERT INTO szczegoly_zamowienia(id_zamowienia,id_produktu,ilosc) VALUES (2,1,5);
INSERT INTO szczegoly_zamowienia(id_zamowienia,id_produktu,ilosc) VALUES (2,2,2);





