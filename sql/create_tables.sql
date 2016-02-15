-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Team(
	id SERIAL PRIMARY KEY,
	name varchar(30) NOT NULL,
	year INTEGER,
	city varchar(30)
);

CREATE TABLE Player(
	id SERIAL PRIMARY KEY,
	name varchar(30) NOT NULL,
	password varchar(30) NOT NULL,
	Team_id INTEGER REFERENCES Team(id)
);


CREATE TABLE Event(
	id SERIAL PRIMARY KEY,
	description varchar(30) NOT NULL,
	time DATE,
	place varchar(30),
	Team_id INTEGER REFERENCES Team(id)
);