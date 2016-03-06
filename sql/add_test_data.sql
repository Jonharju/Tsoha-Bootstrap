-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Team (name, year, city) VALUES ('Kerho', '2016', 'Helsinki');
INSERT INTO Player(name, password) VALUES ('Teemu', 'joku123');
INSERT INTO Event(description, time, place, Team_id) VALUES ('treenit kotona', NOW(), 'Hima', 1);
INSERT INTO Teammember(Player_id, Team_id) VALUES (1,1);