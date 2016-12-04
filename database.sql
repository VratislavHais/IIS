DROP TABLE IF EXISTS `expozice`;
CREATE TABLE `expozice` (
	`id_expozice` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`typ` varchar(40) NOT NULL,
	`umelec` varchar(80) NOT NULL,
	`od` date NOT NULL,
	`do` date NOT NULL,
	`id_zamestnance` int(11) NOT NULL,
	PRIMARY KEY (`id_expozice`)
) AUTO_INCREMENT=1;

INSERT INTO `expozice` (`id_expozice`, `typ`, `umelec`, `od`, `do`, `id_zamestnance`) VALUES
(NULL, 'socharska instalace', 'Pavel Novak', '2016-01-14', '2016-05-15', '2'),
(NULL, 'fotograficka vystava', 'Antonin Kratochvil', '2016-03-12', '2016-12-04', '1'),
(NULL, 'malirska vystava', 'Frantisek Ringo Cech', '2016-12-04', '2016-12-05', '2');

DROP TABLE IF EXISTS `mistnost`;
CREATE TABLE `mistnost` (
	`id_mistnost` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`typ_exp` varchar(40) NOT NULL,
	`plocha` int(11) NOT NULL,
	`cena` int(11) NOT NULL,
	`tvar` varchar(20) NOT NULL,
	`id_zamestnance` int (11) NOT NULL,
	PRIMARY KEY (`id_mistnost`)
) AUTO_INCREMENT=1;

INSERT INTO `mistnost` (`id_mistnost`, `typ_exp`, `plocha`, `cena`, `tvar`, `id_zamestnance`) VALUES
(NULL, 'obrazy', '90', '1800', 'obdelnik', '1'),
(NULL, 'instalace', '45', '1400', 'ctverec', '3'),
(NULL, 'sochy', '38', '1100', 'cverec', '3'),
(NULL, 'instalace', '70', '1200', 'kruh', '1'),
(NULL, 'obrazy', '95', '1900', 'obdelnik', '2'),
(NULL, 'sochy', '32', '1100', 'ctverec', '2');

DROP TABLE IF EXISTS `objednavka`;
CREATE TABLE `objednavka` (
	`id_objednavka` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`od` date NOT NULL,
	`do` date NOT NULL,
	`poplatek` varchar(3) NOT NULL,
	`id_pronajimatele` int(11) NOT NULL,
	`id_expozice` int(11) NOT NULL,
	`id_zamestnance` int(11) NOT NULL,
	PRIMARY KEY (`id_objednavka`)
) AUTO_INCREMENT=1;

INSERT INTO `objednavka` (`id_objednavka`, `od`, `do`, `poplatek`, `id_pronajimatele`, `id_expozice`, `id_zamestnance`) VALUES
(NULL, '2016-04-12', '2016-05-12', 'yes', '3', '2', '1'),
(NULL, '2016-04-01', '2016-05-05', 'no', '1', '3', '1'),
(NULL, '2016-03-12', '2016-04-12', 'yes', '2', '1', '2');

DROP TABLE IF EXISTS `pronajimatel`;
CREATE TABLE `pronajimatel` (
	`id_pronajimatel` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`nazev` varchar(60) NOT NULL,
	`kontakt` varchar(13) NOT NULL,
	`poplatek` varchar(3) NOT NULL,
	PRIMARY KEY (`id_pronajimatel`)
) AUTO_INCREMENT=1;

INSERT INTO `pronajimatel` (`id_pronajimatel`, `nazev`, `kontakt`, `poplatek`) VALUES
(NULL, 'UMPRUM', '731548762', 'yes'),
(NULL, 'Pavel Novák', '609548795', 'no'),
(NULL, 'Antotnín kratochvíl', '581548221', 'yes');

DROP TABLE IF EXISTS `umelec`;
CREATE TABLE `umelec` (
	`id_umelec` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`jmeno` varchar(40) NOT NULL,
	`prijmeni` varchar(40) NOT NULL,
	`specializace` varchar(40) NOT NULL,
	`id_zamestnance` int(11) NOT NULL,
	PRIMARY KEY (`id_umelec`)
) AUTO_INCREMENT=1;

INSERT INTO `umelec` (`id_umelec`, `jmeno`, `prijmeni`, `specializace`, `id_zamestnance`) VALUES
(NULL, 'Pavel', 'Novák', 'socharství', '1'),
(NULL, 'Antotnín', 'Kratochvíl', 'fotografie', '3'),
(NULL, 'Fratnišek Ringo', 'Cech', 'malba', '3');

DROP TABLE IF EXISTS `zamestnanec`;
CREATE TABLE `zamestnanec` (
	`id_zamestnanec` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`jmeno` varchar(40)	NOT NULL,
	`prijmeni` varchar(40) NOT NULL,
	`login` varchar(8) NOT NULL,
	`heslo` varchar(20) NOT NULL,
	`datum_nar` date NOT NULL,
	`prava` int(1) NOT NULL,
	`rod_cislo` bigint(11) NOT NULL,
	`plat` int(11) NOT NULL,
	PRIMARY KEY (`id_zamestnanec`)
) AUTO_INCREMENT=1;

INSERT INTO `zamestnanec` (`id_zamestnanec`, `jmeno`, `prijmeni`, `login`, `heslo`, `datum_nar`, `prava`, `rod_cislo`, `plat`) VALUES
(NULL, 'Vratislav', 'Hais', 'admin', 'heslo', '2016-01-02', '1', '1601026520', '10000'),
(NULL, 'Patrik', 'Cigas', 'user', 'heslo', '2016-01-02', '0', '1601026520', '10000'),
(NULL, 'Test', 'User', 'xusert00', 'passwd', '2016-01-02', '0', '1601026520', '10000'),
(NULL, 'Thanatos', 'Mrtvy', 'xmrtvy01', 'nejakeheslo', '2016-01-02', '0', '1601026520', '10000');

DROP TABLE IF EXISTS `vybaveni_mistnosti`;
CREATE TABLE `vybaveni_mistnosti` (
	`id_vybaveni_mistnosti` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`typ` varchar(40) NOT NULL,
	`pocet` int(11) NOT NULL,
	`id_mistnosti` int(11) NOT NULL,
	PRIMARY KEY (`id_vybaveni_mistnosti`)
) AUTO_INCREMENT=1;

INSERT INTO `vybaveni_mistnosti` (`id_vybaveni_mistnosti`, `typ`, `pocet`, `id_mistnosti`) VALUES
(NULL, 'podstavec hlinikovy', 100, '1'),
(NULL, 'podstavec zelezny', 300, '1'),
(NULL, 'nejaky podstavec', 5, 2);