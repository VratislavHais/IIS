DROP TABLE expozice_umelce;
DROP TABLE mistnosti_objednavky;
DROP TABLE vybaveni_mistnosti;
DROP TABLE mistnost;
DROP TABLE objednavka;
DROP TABLE fyz_osoba;
DROP TABLE prav_osoba;
DROP TABLE pronajimatel;
DROP TABLE expozice;
DROP TABLE umelec;
DROP TABLE zamestnanec;

CREATE TABLE expozice(
	id_expozice int NOT NULL,
	typ VARCHAR(40) NOT NULL,
	umelec VARCHAR(80) NOT NULL,
	od DATE NOT NULL,
	do DATE NOT NULL,
	id_zamestnance int NOT NULL
);

CREATE TABLE umelec(
	id_umelce int NOT NULL,
	jmeno VARCHAR(40) NOT NULL,
	prijmeni VARCHAR(40) NOT NULL,
	specializace VARCHAR(40) NOT NULL,
	id_zamestnance int NOT NULL
);

CREATE TABLE zamestnanec(
	id_zamestnance int NOT NULL,
	jmeno VARCHAR(40),
	prijmeni VARCHAR(40),
	datum_nar DATE NOT NULL,
	prava int NOT NULL,
	rod_cislo number(10) NOT NULL,
	plat int NOT NULL,
	CHECK(round(rod_cislo/11.0) = rod_cislo/11.0)
);

CREATE TABLE mistnost(
	id_mistnosti int NOT NULL,
	typ_exp VARCHAR(40) NOT NULL,
	plocha int NOT NULL,
	cena int NOT NULL,
	tvar VARCHAR(20) NOT NULL,
	id_zamestnance int NOT NULL
);

CREATE TABLE vybaveni_mistnosti(
	id_vybaveni int NOT NULL,
	typ VARCHAR(40) NOT NULL,
	pocet int NOT NULL,
	id_mistnosti int NOT NULL
);

CREATE TABLE pronajimatel(
	id_pronajimatele int NOT NULL,
	nazev VARCHAR(60) NOT NULL,
	kontakt VARCHAR(13) NOT NULL,
	poplatek VARCHAR(3) NOT NULL
);

CREATE TABLE fyz_osoba(
	id_pronajimatele int NOT NULL,
	rod_cislo number(10) NOT NULL,
	CHECK(round(rod_cislo/11.0) = rod_cislo/11.0)
);

CREATE TABLE prav_osoba(
	id_pronajimatele int NOT NULL,
	ICO number(8) NOT NULL
);

CREATE TABLE objednavka(
	id_objednavky int NOT NULL,
	od DATE NOT NULL,
	do DATE NOT NULL,
	poplatek VARCHAR(3) NOT NULL,
	id_pronajimatele int NOT NULL,
	id_expozice int NOT NULL,
	id_zamestnance int NOT NULL
);

CREATE TABLE mistnosti_objednavky(
	id_mistnosti int NOT NULL,
	id_objednavky int NOT NULL
);

CREATE TABLE expozice_umelce(
	id_umelce int NOT NULL,
	id_expozice int NOT NULL
);

ALTER TABLE expozice ADD PRIMARY KEY (id_expozice);
ALTER TABLE umelec ADD PRIMARY KEY (id_umelce);
ALTER TABLE zamestnanec ADD PRIMARY KEY (id_zamestnance);
ALTER TABLE mistnost ADD PRIMARY KEY (id_mistnosti);
ALTER TABLE vybaveni_mistnosti ADD PRIMARY KEY (id_vybaveni);
ALTER TABLE pronajimatel ADD PRIMARY KEY (id_pronajimatele);
ALTER TABLE objednavka ADD PRIMARY KEY (id_objednavky);
ALTER TABLE mistnosti_objednavky ADD PRIMARY KEY (id_mistnosti,id_objednavky);
ALTER TABLE expozice_umelce ADD PRIMARY KEY (id_umelce, id_expozice);

ALTER TABLE objednavka ADD FOREIGN KEY (id_expozice) REFERENCES expozice(id_expozice) ON DELETE CASCADE;
ALTER TABLE objednavka ADD FOREIGN KEY (id_pronajimatele) REFERENCES pronajimatel(id_pronajimatele) ON DELETE CASCADE;
ALTER TABLE objednavka ADD FOREIGN KEY (id_zamestnance) REFERENCES zamestnanec(id_zamestnance) ON DELETE CASCADE;

ALTER TABLE umelec ADD FOREIGN KEY (id_zamestnance) REFERENCES zamestnanec(id_zamestnance) ON DELETE CASCADE;

ALTER TABLE expozice ADD FOREIGN KEY (id_zamestnance) REFERENCES zamestnanec(id_zamestnance) ON DELETE CASCADE;

ALTER TABLE mistnost ADD FOREIGN KEY (id_zamestnance) REFERENCES zamestnanec(id_zamestnance) ON DELETE CASCADE;

ALTER TABLE vybaveni_mistnosti ADD FOREIGN KEY (id_mistnosti) REFERENCES mistnost(id_mistnosti) ON DELETE CASCADE;

ALTER TABLE mistnosti_objednavky ADD FOREIGN KEY (id_mistnosti) REFERENCES mistnost(id_mistnosti) ON DELETE CASCADE;
ALTER TABLE mistnosti_objednavky ADD FOREIGN KEY (id_objednavky) REFERENCES objednavka(id_objednavky) ON DELETE CASCADE;

ALTER TABLE expozice_umelce ADD FOREIGN KEY (id_umelce) REFERENCES umelec(id_umelce) ON DELETE CASCADE;
ALTER TABLE expozice_umelce ADD FOREIGN KEY (id_expozice) REFERENCES expozice(id_expozice) ON DELETE CASCADE;

ALTER TABLE fyz_osoba ADD PRIMARY KEY (rod_cislo);
ALTER TABLE fyz_osoba ADD FOREIGN KEY (id_pronajimatele) REFERENCES pronajimatel(id_pronajimatele) ON DELETE CASCADE;

ALTER TABLE prav_osoba ADD PRIMARY KEY (ICO);
ALTER TABLE prav_osoba ADD FOREIGN KEY (id_pronajimatele) REFERENCES pronajimatel(id_pronajimatele) ON DELETE CASCADE;

INSERT INTO zamestnanec (id_zamestnance, jmeno, prijmeni, datum_nar, prava, rod_cislo, plat) VALUES('001', 'Jan', 'Dvořák', TO_DATE('1954-03-12','YYYY-MM-DD'), '1', '5412036069', '35650');
INSERT INTO zamestnanec (id_zamestnance, jmeno, prijmeni, datum_nar, prava, rod_cislo, plat) VALUES('002', 'Aneta', 'Mašličková', TO_DATE('1989-06-24','YYYY-MM-DD'), '3', '8956248763', '15650');
INSERT INTO zamestnanec (id_zamestnance, jmeno, prijmeni, datum_nar, prava, rod_cislo, plat) VALUES('003', 'Ludmila', 'Šípková', TO_DATE('1956-07-26','YYYY-MM-DD'), '2', '5657264459', '17650');

INSERT INTO pronajimatel (id_pronajimatele, nazev, kontakt, poplatek) VALUES('001', 'UMPRUM', '731548762', 'ano');
INSERT INTO pronajimatel (id_pronajimatele, nazev, kontakt, poplatek) VALUES('002', 'Pavel Novák', '609548795', 'ne');
INSERT INTO pronajimatel (id_pronajimatele, nazev, kontakt, poplatek) VALUES('003', 'Antotnín kratochvíl', '581548221', 'ano');

INSERT INTO fyz_osoba(id_pronajimatele, rod_cislo) VALUES('2', '5657264470');
INSERT INTO prav_osoba(id_pronajimatele, ICO) VALUES('1', '12345678');
INSERT INTO prav_osoba(id_pronajimatele, ICO) VALUES('1', '87654321');

INSERT INTO mistnost (id_mistnosti, typ_exp, plocha, cena, tvar, id_zamestnance) VALUES('001', 'sochy', '59', '1200', 'čtverec', '001');
INSERT INTO mistnost (id_mistnosti, typ_exp, plocha, cena, tvar, id_zamestnance) VALUES('002', 'sochy', '20', '1500', 'kruh', '001');
INSERT INTO mistnost (id_mistnosti, typ_exp, plocha, cena, tvar, id_zamestnance) VALUES('003', 'instalace', '160', '1200', 'čtverec', '001');
INSERT INTO mistnost (id_mistnosti, typ_exp, plocha, cena, tvar, id_zamestnance) VALUES('004', 'instalace', '70', '1200', 'čtverec', '003');

INSERT INTO vybaveni_mistnosti (id_vybaveni, typ, pocet, id_mistnosti) VALUES('001', 'podstavec hliníkový', '30', '002');
INSERT INTO vybaveni_mistnosti (id_vybaveni, typ, pocet, id_mistnosti) VALUES('002', 'podstavec kamený', '30', '004');
INSERT INTO vybaveni_mistnosti (id_vybaveni, typ, pocet, id_mistnosti) VALUES('003', 'rám dřevěný', '50', '001');
INSERT INTO vybaveni_mistnosti (id_vybaveni, typ, pocet, id_mistnosti) VALUES('004', 'rám hliníkový', '100', '002');
INSERT INTO vybaveni_mistnosti (id_vybaveni, typ, pocet, id_mistnosti) VALUES('005', 'zářivka bílá', '60', '001');
INSERT INTO vybaveni_mistnosti (id_vybaveni, typ, pocet, id_mistnosti) VALUES('006', 'zářivka barevná', '20', '003');
INSERT INTO vybaveni_mistnosti (id_vybaveni, typ, pocet, id_mistnosti) VALUES('007', 'stojan dřevěný', '15', '003');
INSERT INTO vybaveni_mistnosti (id_vybaveni, typ, pocet, id_mistnosti) VALUES('008', 'rám popisovací', '200', '004');
INSERT INTO vybaveni_mistnosti (id_vybaveni, typ, pocet, id_mistnosti) VALUES('009', 'stůl rozkládací', '6', '001');
INSERT INTO vybaveni_mistnosti (id_vybaveni, typ, pocet, id_mistnosti) VALUES('010', 'židle dřevěná', '50', '004');

INSERT INTO umelec (id_umelce, jmeno, prijmeni, specializace, id_zamestnance) VALUES('001', 'Pavel', 'Novák', 'sochařství', '001');
INSERT INTO umelec (id_umelce, jmeno, prijmeni, specializace, id_zamestnance) VALUES('002', 'Antotnín', 'Kratochvíl', 'fotografie', '003');
INSERT INTO umelec (id_umelce, jmeno, prijmeni, specializace, id_zamestnance) VALUES('003', 'Fratnišek Ringo', 'Čech', 'malba', '003');

INSERT INTO expozice (id_expozice, typ, umelec, od, do, id_zamestnance) VALUES('001', 'sochařská instalace', 'Pavel Novák', TO_DATE('2016-01-14','YYYY-MM-DD'), TO_DATE('2016-05-15','YYYY-MM-DD'), '002');
INSERT INTO expozice (id_expozice, typ, umelec, od, do, id_zamestnance) VALUES('002', 'fotografická výstava', 'Antonín Kratochvíl', TO_DATE('2016-03-12','YYYY-MM-DD'), TO_DATE('2016-12-04','YYYY-MM-DD'), '002');
INSERT INTO expozice (id_expozice, typ, umelec, od, do, id_zamestnance) VALUES('003', 'malířská výstava', 'Fratnišek Ringo Čech', TO_DATE('2016-12-04','YYYY-MM-DD'), TO_DATE('2016-12-05','YYYY-MM-DD'), '003');

INSERT INTO objednavka (id_objednavky, od, do, poplatek, id_pronajimatele, id_expozice, id_zamestnance) VALUES('001', TO_DATE('2016-04-12','YYYY-MM-DD'), TO_DATE('2016-05-12','YYYY-MM-DD'), 'ano', '003', '002', '001');
INSERT INTO objednavka (id_objednavky, od, do, poplatek, id_pronajimatele, id_expozice, id_zamestnance) VALUES('002', TO_DATE('2016-04-01','YYYY-MM-DD'), TO_DATE('2016-05-05','YYYY-MM-DD'), 'ne', '001', '003', '001');
INSERT INTO objednavka (id_objednavky, od, do, poplatek, id_pronajimatele, id_expozice, id_zamestnance) VALUES('003', TO_DATE('2016-03-12','YYYY-MM-DD'), TO_DATE('2016-04-12','YYYY-MM-DD'), 'ano', '002', '001', '002');

INSERT INTO mistnosti_objednavky(id_mistnosti, id_objednavky) VALUES ('001','001');
INSERT INTO mistnosti_objednavky(id_mistnosti, id_objednavky) VALUES ('001','002');
INSERT INTO mistnosti_objednavky(id_mistnosti, id_objednavky) VALUES ('002','003');

INSERT INTO expozice_umelce(id_umelce, id_expozice) VALUES ('001','001');
INSERT INTO expozice_umelce(id_umelce, id_expozice) VALUES ('002','002');
INSERT INTO expozice_umelce(id_umelce, id_expozice) VALUES ('003','003');

COMMIT;

--kteri zamestnanec spravuje umelce s prijmenim Novák
SELECT Z.jmeno, Z.prijmeni
FROM zamestnanec Z, umelec U
WHERE U.prijmeni = 'Novák' and U.id_zamestnance=Z.id_zamestnance;

--jake vybaveni je v mistnosti c.3
SELECT V.typ, V.pocet
FROM vybaveni_mistnosti V, mistnost M
WHERE V.id_mistnosti=M.id_mistnosti and M.id_mistnosti='3';

--od kdy do kdy je objednana mistnost c.1
SELECT O.od, O.do
FROM objednavka O, mistnost M, mistnosti_objednavky MO
WHERE M.id_mistnosti=MO.id_mistnosti and MO.id_objednavky=O.id_objednavky and M.id_mistnosti='001';

--kolik je vybaveni v jednotlivych mistnostech
SELECT id_mistnosti, SUM(pocet) pocet_vybaveni
FROM vybaveni_mistnosti
GROUP BY id_mistnosti;

--za kterou mistnost se v objednavce plati nejvice
SELECT MO.id_objednavky, MAX(M.cena)
FROM mistnosti_objednavky MO, mistnost M
WHERE MO.id_mistnosti=M.id_mistnosti
GROUP BY MO.id_objednavky;

--kteri pronajimatele maji pouze jednu objednavku
SELECT P.*
FROM pronajimatel P, objednavka O
WHERE O.id_pronajimatele=P.id_pronajimatele and NOT EXISTS
    (SELECT *
     FROM objednavka O1
     WHERE O1.id_pronajimatele=P.id_pronajimatele and O.id_objednavky <> O1.id_objednavky);

--kteri zamestnanci nespravuji ani jednu mistnost
SELECT *
FROM zamestnanec
WHERE id_zamestnance NOT IN ( SELECT id_zamestnance from mistnost);