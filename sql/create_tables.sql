-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Joukkue(
	id SERIAL PRIMARY KEY,
	nimi varchar(30) NOT NULL,
	perustamisvuosi INTEGER,
	paikkakunta varchar(30)
);

CREATE TABLE Pelaaja(
	id SERIAL PRIMARY KEY,
	nimi varchar(30) NOT NULL,
	salasana varchar(30) NOT NULL,
	joukkue_id INTEGER REFERENCES Joukkue(id)
);


CREATE TABLE Tapahtuma(
	id SERIAL PRIMARY KEY,
	kuvaus varchar(30) NOT NULL,
	aika DATE,
	paikka varchar(30),
	joukkue_id INTEGER REFERENCES Joukkue(id)
);