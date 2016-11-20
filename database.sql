/* Droping previous data*/
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

DROP SEQUENCE seq_expozice;
DROP SEQUENCE seq_umelec;
DROP SEQUENCE seq_zamestnanec;
DROP SEQUENCE seq_mistnost;
DROP SEQUENCE seq_vybaveni_mistnosti;
DROP SEQUENCE seq_pronajimatel;
DROP SEQUENCE seq_objednavka;



/* Creating new tables*/
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
  heslo VARCHAR(20) NOT NULL,
	datum_nar DATE NOT NULL,
	prava int NOT NULL,
	rod_cislo number(10) NOT NULL,
	plat int NOT NULL
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
	rod_cislo number(10) NOT NULL
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

/* Adding primary and foreign keys to tables*/
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

/* Creating sequences for IDs*/
CREATE SEQUENCE seq_expozice MINVALUE 0 NOMAXVALUE START WITH 1 INCREMENT BY 1;
CREATE SEQUENCE seq_umelec MINVALUE 0 NOMAXVALUE START WITH 1 INCREMENT BY 1;
CREATE SEQUENCE seq_zamestnanec MINVALUE 0 NOMAXVALUE START WITH 1 INCREMENT BY 1;
CREATE SEQUENCE seq_mistnost MINVALUE 0 NOMAXVALUE START WITH 1 INCREMENT BY 1;
CREATE SEQUENCE seq_vybaveni_mistnosti MINVALUE 0 NOMAXVALUE START WITH 1 INCREMENT BY 1;
CREATE SEQUENCE seq_pronajimatel MINVALUE 0 NOMAXVALUE START WITH 1 INCREMENT BY 1;
CREATE SEQUENCE seq_objednavka MINVALUE 0 NOMAXVALUE START WITH 1 INCREMENT BY 1;

/* Creating triggers for automatic id sequencing*/
CREATE OR REPLACE TRIGGER tr_expozice
  BEFORE INSERT ON expozice
  FOR EACH ROW
  BEGIN
    SELECT seq_expozice.NEXTVAL INTO :NEW.id_expozice FROM DUAL;
  END;
  /
  
  CREATE OR REPLACE TRIGGER tr_umelec
  BEFORE INSERT ON umelec
  FOR EACH ROW
  BEGIN
    SELECT seq_umelec.NEXTVAL INTO :NEW.id_umelce FROM DUAL;
  END;
  /
  
  CREATE OR REPLACE TRIGGER tr_zamestnanec
  BEFORE INSERT ON zamestnanec
  FOR EACH ROW
  BEGIN
    SELECT seq_zamestnanec.NEXTVAL INTO :NEW.id_zamestnance FROM DUAL;
  END;
  /
  
  CREATE OR REPLACE TRIGGER tr_mistnost
  BEFORE INSERT ON mistnost
  FOR EACH ROW
  BEGIN
    SELECT seq_mistnost.NEXTVAL INTO :NEW.id_mistnosti FROM DUAL;
  END;
  /
  
  CREATE OR REPLACE TRIGGER tr_vybaveni_mistnosti
  BEFORE INSERT ON vybaveni_mistnosti
  FOR EACH ROW
  BEGIN
    SELECT seq_vybaveni_mistnosti.NEXTVAL INTO :NEW.id_vybaveni FROM DUAL;
  END;
  /
  
  CREATE OR REPLACE TRIGGER tr_pronajimatel
  BEFORE INSERT ON pronajimatel
  FOR EACH ROW
  BEGIN
    SELECT seq_pronajimatel.NEXTVAL INTO :NEW.id_pronajimatele FROM DUAL;
  END;
  /
  
  CREATE OR REPLACE TRIGGER tr_objednavka
  BEFORE INSERT ON objednavka
  FOR EACH ROW
  BEGIN
    SELECT seq_objednavka.NEXTVAL INTO :NEW.id_objednavky FROM DUAL;
  END;
  /
  
  /* Creating trigger to check correctness of ID number of person*/
  CREATE OR REPLACE TRIGGER tr_rodne_c_z
  AFTER UPDATE OR INSERT ON zamestnanec
  FOR EACH ROW
  DECLARE
    cislo zamestnanec.rod_cislo%TYPE;
    rok NUMBER;
    mesic NUMBER;
    den NUMBER;
    koncovka NUMBER;
  BEGIN
    cislo := :NEW.rod_cislo;
    rok := SUBSTR(cislo,1,2);
    mesic := SUBSTR(cislo,3,2);
    den := SUBSTR(cislo,5,2);
    koncovka := SUBSTR(cislo,7,4);
    IF (LENGTH(cislo) != 10) THEN 
      Raise_Application_Error (-20220, 'Nespravne pocet cislic rodneho cisla!');
    END IF;
    IF (mesic > 50) THEN
      mesic := mesic - 50;
    END IF;
    IF ((mesic < '01') OR (mesic > '12') OR (den < '01') OR (den > '31') OR (koncovka = '0000')) THEN
      Raise_Application_Error (-20221, 'Nespravne zadane rodne cislo!');
    END IF;
    IF (MOD(TO_NUMBER(cislo), 11) != 0) THEN 
      Raise_Application_Error (-20222, 'Rodne cislo nedelitelne 11!');
    END IF;
  END;
  /

/* Creating procedures for easier work with data */

/* Pocedure that calculate needed time to repaint the room */
SET serveroutput ON;
CREATE OR REPLACE PROCEDURE doba_malovani(id_mist IN NUMBER)
IS
  CURSOR mistnosti IS SELECT * FROM mistnost;
  uk_mistnost mistnost%ROWTYPE;
  cas REAL;
BEGIN
  cas := 0;
  OPEN mistnosti;
  LOOP
    FETCH mistnosti INTO uk_mistnost;
    EXIT WHEN mistnosti%NOTFOUND;
    IF (uk_mistnost.id_mistnosti = id_mist) THEN
      cas := uk_mistnost.plocha * 0.5;
    END IF;
  END LOOP;
  CLOSE mistnosti;
  dbms_output.put_line('Mistnost se bude malovat ' || cas || ' hodin.');
EXCEPTION
  WHEN OTHERS THEN
    Raise_Application_Error (-20201, 'Chyba!');
END;
/

SET serveroutput ON;
CREATE OR REPLACE PROCEDURE kolik_vybaveni(id_mist IN NUMBER, typ_vybav IN VARCHAR)
IS
  CURSOR vybav IS SELECT * FROM vybaveni_mistnosti;
  uk_vybav vybaveni_mistnosti%ROWTYPE;
  vsechny NUMBER;
  zvolene NUMBER;
BEGIN
  vsechny :=0;
  zvolene :=0;
  OPEN vybav;
  LOOP
    FETCH vybav INTO uk_vybav;
    EXIT WHEN vybav%NOTFOUND;
    IF (id_mist = uk_vybav.id_mistnosti) THEN
      vsechny := vsechny + uk_vybav.pocet;
      IF (typ_vybav = uk_vybav.typ) THEN
        zvolene := zvolene + uk_vybav.pocet;
      END IF;
    END IF;
  END LOOP;
  dbms_output.put_line('Zarizeni ' || typ_vybav || ' se v mistnosti nachazi ' || zvolene || ' co predstavuje ' || (zvolene * 100)/vsechny || '% .');
EXCEPTION
  WHEN ZERO_DIVIDE THEN
    dbms_output.put_line('Zadane zarizeni se v mistnosti nenachazi.');
  WHEN OTHERS THEN
    Raise_Application_Error (-20201, 'Chyba!');
END;
/


/* Inserting data to tables*/
INSERT INTO zamestnanec (id_zamestnance, jmeno, prijmeni, datum_nar, prava, rod_cislo, plat) VALUES(null, 'Jan', 'Dvoøák', TO_DATE('1954-03-12','YYYY-MM-DD'), '1', '5412036069', '35650');
INSERT INTO zamestnanec (id_zamestnance, jmeno, prijmeni, datum_nar, prava, rod_cislo, plat) VALUES(null, 'Aneta', 'Mašlièková', TO_DATE('1989-06-24','YYYY-MM-DD'), '3', '8956248763', '15650');
INSERT INTO zamestnanec (id_zamestnance, jmeno, prijmeni, datum_nar, prava, rod_cislo, plat) VALUES(null, 'Ludmila', 'Šípková', TO_DATE('1956-07-26','YYYY-MM-DD'), '2', '5657264459', '17650');

INSERT INTO pronajimatel (id_pronajimatele, nazev, kontakt, poplatek) VALUES(null, 'UMPRUM', '731548762', 'ano');
INSERT INTO pronajimatel (id_pronajimatele, nazev, kontakt, poplatek) VALUES(null, 'Pavel Novák', '609548795', 'ne');
INSERT INTO pronajimatel (id_pronajimatele, nazev, kontakt, poplatek) VALUES(null, 'Antotnín kratochvíl', '581548221', 'ano');

INSERT INTO fyz_osoba(id_pronajimatele, rod_cislo) VALUES('2', '5657264470');
INSERT INTO prav_osoba(id_pronajimatele, ICO) VALUES('1', '12345678');
INSERT INTO prav_osoba(id_pronajimatele, ICO) VALUES('1', '87654321');

INSERT INTO mistnost (id_mistnosti, typ_exp, plocha, cena, tvar, id_zamestnance) VALUES(null, 'sochy', '59', '1200', 'ètverec', '001');
INSERT INTO mistnost (id_mistnosti, typ_exp, plocha, cena, tvar, id_zamestnance) VALUES(null, 'sochy', '20', '1500', 'kruh', '001');
INSERT INTO mistnost (id_mistnosti, typ_exp, plocha, cena, tvar, id_zamestnance) VALUES(null, 'instalace', '160', '1200', 'ètverec', '001');
INSERT INTO mistnost (id_mistnosti, typ_exp, plocha, cena, tvar, id_zamestnance) VALUES(null, 'instalace', '70', '1200', 'ètverec', '003');

-- adding more data for index speed testing
INSERT INTO mistnost (id_mistnosti, typ_exp, plocha, cena, tvar, id_zamestnance) VALUES(null, 'obrazy', '90', '1800', 'obdelnik', '001');
INSERT INTO mistnost (id_mistnosti, typ_exp, plocha, cena, tvar, id_zamestnance) VALUES(null, 'instalace', '45', '1400', 'ètverec', '003');
INSERT INTO mistnost (id_mistnosti, typ_exp, plocha, cena, tvar, id_zamestnance) VALUES(null, 'sochy', '38', '1100', 'ètverec', '003');
INSERT INTO mistnost (id_mistnosti, typ_exp, plocha, cena, tvar, id_zamestnance) VALUES(null, 'instalace', '70', '1200', 'kruh', '001');
INSERT INTO mistnost (id_mistnosti, typ_exp, plocha, cena, tvar, id_zamestnance) VALUES(null, 'obrazy', '95', '1900', 'obdelnik', '002');
INSERT INTO mistnost (id_mistnosti, typ_exp, plocha, cena, tvar, id_zamestnance) VALUES(null, 'sochy', '32', '1100', 'ètverec', '002');

INSERT INTO vybaveni_mistnosti (id_vybaveni, typ, pocet, id_mistnosti) VALUES(null, 'podstavec hliníkový', '30', '002');
INSERT INTO vybaveni_mistnosti (id_vybaveni, typ, pocet, id_mistnosti) VALUES(null, 'podstavec kamený', '30', '004');
INSERT INTO vybaveni_mistnosti (id_vybaveni, typ, pocet, id_mistnosti) VALUES(null, 'rám døevìný', '50', '001');
INSERT INTO vybaveni_mistnosti (id_vybaveni, typ, pocet, id_mistnosti) VALUES(null, 'rám hliníkový', '100', '002');
INSERT INTO vybaveni_mistnosti (id_vybaveni, typ, pocet, id_mistnosti) VALUES(null, 'záøivka bílá', '60', '001');
INSERT INTO vybaveni_mistnosti (id_vybaveni, typ, pocet, id_mistnosti) VALUES(null, 'záøivka barevná', '20', '003');
INSERT INTO vybaveni_mistnosti (id_vybaveni, typ, pocet, id_mistnosti) VALUES(null, 'stojan døevìný', '15', '003');
INSERT INTO vybaveni_mistnosti (id_vybaveni, typ, pocet, id_mistnosti) VALUES(null, 'rám popisovací', '200', '004');
INSERT INTO vybaveni_mistnosti (id_vybaveni, typ, pocet, id_mistnosti) VALUES(null, 'stùl rozkládací', '6', '001');
INSERT INTO vybaveni_mistnosti (id_vybaveni, typ, pocet, id_mistnosti) VALUES(null, 'židle døevìná', '50', '004');

INSERT INTO umelec (id_umelce, jmeno, prijmeni, specializace, id_zamestnance) VALUES(null, 'Pavel', 'Novák', 'sochaøství', '001');
INSERT INTO umelec (id_umelce, jmeno, prijmeni, specializace, id_zamestnance) VALUES(null, 'Antotnín', 'Kratochvíl', 'fotografie', '003');
INSERT INTO umelec (id_umelce, jmeno, prijmeni, specializace, id_zamestnance) VALUES(null, 'Fratnišek Ringo', 'Èech', 'malba', '003');

INSERT INTO expozice (id_expozice, typ, umelec, od, do, id_zamestnance) VALUES(null, 'sochaøská instalace', 'Pavel Novák', TO_DATE('2016-01-14','YYYY-MM-DD'), TO_DATE('2016-05-15','YYYY-MM-DD'), '002');
INSERT INTO expozice (id_expozice, typ, umelec, od, do, id_zamestnance) VALUES(null, 'fotografická výstava', 'Antonín Kratochvíl', TO_DATE('2016-03-12','YYYY-MM-DD'), TO_DATE('2016-12-04','YYYY-MM-DD'), '002');
INSERT INTO expozice (id_expozice, typ, umelec, od, do, id_zamestnance) VALUES(null, 'malíøská výstava', 'Fratnišek Ringo Èech', TO_DATE('2016-12-04','YYYY-MM-DD'), TO_DATE('2016-12-05','YYYY-MM-DD'), '003');

INSERT INTO objednavka (id_objednavky, od, do, poplatek, id_pronajimatele, id_expozice, id_zamestnance) VALUES(null, TO_DATE('2016-04-12','YYYY-MM-DD'), TO_DATE('2016-05-12','YYYY-MM-DD'), 'ano', '003', '002', '001');
INSERT INTO objednavka (id_objednavky, od, do, poplatek, id_pronajimatele, id_expozice, id_zamestnance) VALUES(null, TO_DATE('2016-04-01','YYYY-MM-DD'), TO_DATE('2016-05-05','YYYY-MM-DD'), 'ne', '001', '003', '001');
INSERT INTO objednavka (id_objednavky, od, do, poplatek, id_pronajimatele, id_expozice, id_zamestnance) VALUES(null, TO_DATE('2016-03-12','YYYY-MM-DD'), TO_DATE('2016-04-12','YYYY-MM-DD'), 'ano', '002', '001', '002');

INSERT INTO mistnosti_objednavky(id_mistnosti, id_objednavky) VALUES ('001','001');
INSERT INTO mistnosti_objednavky(id_mistnosti, id_objednavky) VALUES ('001','002');
INSERT INTO mistnosti_objednavky(id_mistnosti, id_objednavky) VALUES ('002','003');

INSERT INTO expozice_umelce(id_umelce, id_expozice) VALUES ('001','001');
INSERT INTO expozice_umelce(id_umelce, id_expozice) VALUES ('002','002');
INSERT INTO expozice_umelce(id_umelce, id_expozice) VALUES ('003','003');

COMMIT;
