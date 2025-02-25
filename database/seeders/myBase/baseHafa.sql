create database workingco;


use workingco;

-- clientCowork
create table clientCoWorker
(
    idClient int PRIMARY KEY AUTO_INCREMENT,
    numeroTelephoneClient VARCHAR(30),
    nomClient VARCHAR(30)
);

-- donnees clients
INSERT INTO clientcoWorker(nomClient,numeroTelephoneClient) VALUES('Hariaja','0342558845');
INSERT INTO clientcoWorker(nomClient,numeroTelephoneClient) VALUES('Nomena','0332585223');
INSERT INTO clientcoWorker(nomClient,numeroTelephoneClient) VALUES('Bota','0332585224');

-- espace de travail
create table espaceTravail
(
    idEspaceTravail int PRIMARY KEY AUTO_INCREMENT,
    nomEspaceTravail VARCHAR(30),
    prixEspaceTravail DOUBLE precision
);

insert INTO espaceTravail(nomEspaceTravail) VALUES ('espace 1');
insert INTO espaceTravail(nomEspaceTravail) VALUES ('espace 2');
insert INTO espaceTravail(nomEspaceTravail) VALUES ('espace 3');


create table statuts
(
    idstatut int PRIMARY KEY AUTO_INCREMENT,
    nomStatut VARCHAR(30)
);

INSERT INTO statuts(nomStatut) VALUES('libre');
INSERT INTO statuts(nomStatut) VALUES('occupe');
INSERT INTO statuts(nomStatut) VALUES('reserve non payee');
INSERT INTO statuts(nomStatut) VALUES('en attente');
INSERT INTO statuts(nomStatut) VALUES('fait');
INSERT INTO statuts(nomStatut) VALUES('annulez');


create table reservation
(
    idReservation VARCHAR(30) PRIMARY KEY,
    idClient int,
    idespaceTravail int,
    heureDebut int,
    heureFin int,
    duree int,
    id_status int DEFAULT 3,
    dates date,
    Foreign Key (idClient) REFERENCES clientcoWorker(idClient),
    Foreign Key (idEspaceTravail) REFERENCES espaceTravail(idEspaceTravail),
    Foreign Key (id_status) REFERENCES statuts(idstatut)
);

-- INSERTION DE DONNEE...
INSERT INTO reservation (idClient, idEspaceTravail, heureDebut, heureFin, duree, id_status, dates)
VALUES
(1, 1, 14, 17, 3, 1, '2026-08-02');

INSERT INTO reservation (idClient, idEspaceTravail, heureDebut, heureFin, duree, id_status, dates)
VALUES
(1, 2, 14, 17, 3, 1, '2026-07-02');

INSERT INTO reservation (idClient, idEspaceTravail, heureDebut, heureFin, duree, id_status, dates)
VALUES
(2, 1, 14, 17, 3, 2, '2025-02-01');




select * from reservation;


SELECT * FROM espaceTravailbyDate WHERE dates = '2025-01-26';
-- Exemple d'insertion de données dans la table reservation


create or replace view espaceTravailbyDate as
select
    reservation.`idReservation`,
    reservation.`idClient`,
    clientcoworker.`nomClient`,
    clientcoworker.`numeroTelephoneClient`,
    reservation.`idespaceTravail`,
    espacetravail.`nomEspaceTravail`,
    espacetravail.`prixEspaceTravail`,
    reservation.id_status,
    statuts.`nomStatut`,
    reservation.`heureDebut`,
    reservation.`heureFin`,
    reservation.duree,
    reservation.dates
from reservation
join clientcoworker
    on clientcoworker.`idClient`=reservation.`idClient`
join espacetravail
    on espacetravail.`idEspaceTravail` = reservation.`idespaceTravail`
join statuts
    on statuts.idstatut = reservation.id_status



create table lesOptions(
    idlesOptions int PRIMARY KEY AUTO_INCREMENT,
    codes VARCHAR(30),
    nomOption VARCHAR(30),
    prixOption DOUBLE PRECISION
);

INSERT INTO lesoptions(nomOption) VALUES ('imprimante');
INSERT INTO lesoptions(nomOption) VALUES ('videoprojecteur');
INSERT INTO lesoptions(nomOption) VALUES ('laptop');
INSERT INTO lesoptions(nomOption) VALUES ('appareil photo');


select * from espaceTravailbyDate where dates='2025-01-26';
select * from clientcoworker where `numeroTelephoneClient`='0342558845';


CREATE TABLE administrateur
(
    idAdministrateur int PRIMARY KEY AUTO_INCREMENT,
    nomAdministrateur VARCHAR(30),
    motdepasse VARCHAR(30)
);

insert into administrateur(nomAdministrateur,motdepasse) VALUES('nardy','1234');


-- ETAT PAIEMENT 0: AFFICHEZ
-- ETAT PAIEMENT 1:NE PLUS AFFICHEZ

CREATE TABLE attentePaiement
(
    idAttentePaiement INT PRIMARY KEY AUTO_INCREMENT,
    referencePaiement VARCHAR(30) UNIQUE,
    idReservation VARCHAR(30),
    datePaiement date,
    Foreign Key (idReservation) REFERENCES reservation(idreservation)
);


select * from reservation where `idClient`=1

select * from reservation;


select
    atp.`idAttentePaiement`,
    atp.`idReservation`,
    ebd.`idClient`,
    ebd.`nomClient`,
    ebd.`nomClient`,
    ebd.`numeroTelephoneClient`,
    ebd.`idespaceTravail`,
    ebd.id_status,
    ebd.`nomStatut`,
    ebd.`heureDebut`,
    ebd.`heureFin`,
    ebd.idoption,
    ebd.`nomOption`,
    ebd.`prixOption`,
    ebd.duree,
    atp.`datePaiement`,
    atp.`referencePaiement`,
    ebd.dates
from
attentepaiement as atp
join espacetravailbydate as ebd
on ebd.`idReservation` = atp.`idReservation`;

select * from espacetravailbydate;

insert into attentepaiement(`referencePaiement`,`idReservation`) VALUES('ref001',39);

select * from attentepaiement;


-- ATTENTE DE PAIEMENT
create or replace view attentPaiementView as
select
    atp.`idAttentePaiement`,
    atp.`idReservation`,
    etb.`idClient`,
    etb.`nomClient`,
    etb.`idespaceTravail`,
    etb.`nomEspaceTravail`,
    etb.id_status,
    etb.`nomStatut`,
    etb.`heureDebut`,
    etb.`heureFin`,
    etb.duree,
    etb.dates,
    atp.`datePaiement`,
    atp.`referencePaiement`
from attentepaiement as atp
join espacetravailbydate as etb
on etb.`idReservation` = atp.`idReservation`

select * from attentPaiementView;

UPDATE attentepaiement SET `etatPaiement` = 0 WHERE `idAttentePaiement` = 1;

select * from attentepaiement where `idReservation`=39 and `etatPaiement`=1;
delete from attentepaiement;
delete from reservation;

ALTER TABLE attentepaiement DROP COLUMN etatPaiement;

create table optionReservation
(
    idOptionReservation int PRIMARY key AUTO_INCREMENT,
    refReservation VARCHAR(30),
    idlesOptions int,
    Foreign Key (refReservation) REFERENCES reservation(idReservation),
    Foreign Key (idlesOptions) REFERENCES lesOptions(idlesOptions)
);

-- INSERTION OPTIONRESERVATION
INSERT INTO optionReservation (refReservation, idlesOptions)
VALUES
('r001', 1),
('r001', 2);


select * from lesoptions;

create or replace view getEspaceTravailbyDateView as
select
    optr.`refReservation`,
    ebr.`idClient`,
    ebr.`nomClient`,
    ebr.`numeroTelephoneClient`,
    ebr.`idespaceTravail`,
    ebr.`nomEspaceTravail`,
    ebr.`prixEspaceTravail`,
    ebr.id_status,
    ebr.`nomStatut`,
    ebr.`heureDebut`,
    ebr.`heureFin`,
    lesoptions.codes,
    lesoptions.`idlesOptions`,
    lesoptions.`nomOption`,
    lesoptions.`prixOption`,
   ebr.duree,
   ebr.dates
 from optionreservation as optr
join espacetravailbydate as ebr
on optr.`refReservation` = ebr.`idReservation`
join lesoptions
on lesoptions.`idlesOptions` = optr.`idlesOptions`;




SELECT * FROM espaceTravailbyDate










-- LA VIEW AVEC OPTION SPLITEZ PAR VIRGULE

CREATE OR REPLACE VIEW getEspaceTravailbyDateSplitView AS
SELECT
    optr.`refReservation`,
    ebr.`idClient`,
    ebr.`nomClient`,
    ebr.`numeroTelephoneClient`,
    ebr.`idespaceTravail`,
    ebr.`nomEspaceTravail`,
    ebr.`prixEspaceTravail`,
    ebr.id_status,
    ebr.`nomStatut`,
    ebr.`heureDebut`,
    ebr.`heureFin`,
    GROUP_CONCAT(lesoptions.`nomOption` SEPARATOR ', ') AS allOption,
    GROUP_CONCAT(lesoptions.`idlesOptions` SEPARATOR ', ') AS idlesOptionsList,
    SUM(lesoptions.`prixOption`) AS totalPrice,  -- Ajout du prix de l'espace de travail
    ebr.duree,
    ebr.dates
FROM optionreservation AS optr
JOIN espacetravailbydate AS ebr
    ON optr.`refReservation` = ebr.`idReservation`
JOIN lesoptions
    ON lesoptions.`idlesOptions` = optr.`idlesOptions`
GROUP BY
    optr.`refReservation`,
    ebr.`idClient`,
    ebr.`nomClient`,
    ebr.`numeroTelephoneClient`,
    ebr.`idespaceTravail`,
    ebr.`nomEspaceTravail`,
    ebr.`prixEspaceTravail`,
    ebr.id_status,
    ebr.`nomStatut`,
    ebr.`heureDebut`,
    ebr.`heureFin`,
    ebr.duree,
    ebr.dates;

select * from getespacetravailbydatesplitview

-- OK


-- OPTION NULL

select * from espacetravailbydate;
CREATE OR REPLACE VIEW splitOptiongetEspaceview AS

SELECT
    optr.`refReservation`,
    ebr.`idClient`,
    ebr.`nomClient`,
    ebr.`numeroTelephoneClient`,
    ebr.`idespaceTravail`,
    ebr.`nomEspaceTravail`,
    ebr.`prixEspaceTravail`,
    ebr.id_status,
    ebr.`nomStatut`,
    ebr.`heureDebut`,
    ebr.`heureFin`,
    -- Utilisation de COALESCE pour s'assurer que les options sont affichées même si NULL
    COALESCE(GROUP_CONCAT(lesoptions.`nomOption` SEPARATOR ', '), '') AS allOption,
    COALESCE(GROUP_CONCAT(lesoptions.`idlesOptions` SEPARATOR ', '), '') AS idlesOptionsList,
    COALESCE(GROUP_CONCAT(lesoptions.`codes` SEPARATOR ', '), '') AS codeOptions,
    -- Calcul du prix total en évitant NULL et garantissant le prix de l'espace s'il n'y a pas d'options
    COALESCE(SUM(lesoptions.`prixOption`), 0) + (ebr.`prixEspaceTravail` * ebr.duree) AS totalPrice,
    ebr.duree,
    ebr.dates
FROM optionreservation AS optr
JOIN espacetravailbydate AS ebr
    ON ebr.`idReservation` = optr.`refReservation`
LEFT JOIN lesoptions
    ON lesoptions.`idlesOptions` = optr.`idlesOptions`
GROUP BY
    optr.`refReservation`,
    ebr.`idClient`,
    ebr.`nomClient`,
    ebr.`numeroTelephoneClient`,
    ebr.`idespaceTravail`,
    ebr.`nomEspaceTravail`,
    ebr.`prixEspaceTravail`,
    ebr.id_status,
    ebr.`nomStatut`,
    ebr.`heureDebut`,
    ebr.`heureFin`,
    ebr.duree,
    ebr.dates;

SELECT * FROM espacetravailbydate WHERE idReservation = 'r016';

    SELECT * FROM splitoptiongetespaceview where `numeroTelephoneClient`='0342558845';


    select *
    from splitoptiongetespaceview
    where dates='2020-05-20';


create table reservationCsv
(
    idReservationCsv int AUTO_INCREMENT PRIMARY KEY,
    refs VARCHAR(30),
    espace VARCHAR(30),
    clients VARCHAR(30),
    dates DATE,
    heureDebut TIME,
    duree int,
    theOptions VARCHAR(30)
);

INSERT INTO reservationCsv (refs, espace, clients, dates, heureDebut, duree, theOptions)
VALUES ('REF1234', 'Espace A', 'Client X', '2025-02-02', 14, 2, 'Option1, Option2');

select * from reservationcsv;


select * from splitoptiongetespaceview;
SELECT
    dates,
    SUM(totalPrice) AS totalSumPrice
FROM splitoptiongetespaceview
WHERE dates = '2030-01-05' -- Remplacez par la date souhaitée
GROUP BY dates;


















SELECT
    optr.`refReservation`,
    ebr.`idClient`,
    ebr.`nomClient`,
    ebr.`numeroTelephoneClient`,
    ebr.`idespaceTravail`,
    ebr.`nomEspaceTravail`,
    ebr.`prixEspaceTravail`,
    ebr.id_status,
    ebr.`nomStatut`,
    ebr.`heureDebut`,
    ebr.`heureFin`,
    -- Utilisation de COALESCE pour s'assurer que les options sont affichées même si NULL
    COALESCE(GROUP_CONCAT(lesoptions.`nomOption` SEPARATOR ', '), '') AS allOption,
    COALESCE(GROUP_CONCAT(lesoptions.`idlesOptions` SEPARATOR ', '), '') AS idlesOptionsList,
    COALESCE(GROUP_CONCAT(lesoptions.`codes` SEPARATOR ', '), '') AS codeOptions,
    -- Calcul du prix total avec gestion des NULL (et prix de l'espace de travail s'il n'y a pas d'options)
    COALESCE(SUM(lesoptions.`prixOption`), 0) + ebr.`prixEspaceTravail` * COALESCE(ebr.duree, 1) AS totalPrice,
    ebr.duree,
    ebr.dates
FROM optionreservation AS optr
JOIN espacetravailbydate AS ebr
    ON ebr.`idReservation` = optr.`refReservation`
LEFT JOIN lesoptions
    ON lesoptions.`idlesOptions` = optr.`idlesOptions`
GROUP BY
    optr.`refReservation`,
    ebr.`idClient`,
    ebr.`nomClient`,
    ebr.`numeroTelephoneClient`,
    ebr.`idespaceTravail`,
    ebr.`nomEspaceTravail`,
    ebr.`prixEspaceTravail`,
    ebr.id_status,
    ebr.`nomStatut`,
    ebr.`heureDebut`,
    ebr.`heureFin`,
    ebr.duree,
    ebr.dates;

SELECT * FROM optionreservation WHERE refReservation = 'r016';

DROP VIEW IF EXISTS getespacetravailbydateview;


SHOW CREATE VIEW getespacetravailbydateview;

SELECT
    optr.`refReservation`,
    ebr.`idClient`,
    ebr.`nomClient`,
    ebr.`numeroTelephoneClient`,
    ebr.`idespaceTravail`,
    ebr.`nomEspaceTravail`,
    ebr.`prixEspaceTravail`,
    ebr.id_status,
    ebr.`nomStatut`,
    ebr.`heureDebut`,
    ebr.`heureFin`,
    COALESCE(GROUP_CONCAT(lesoptions.`nomOption` SEPARATOR ', '), '') AS allOption,
    COALESCE(GROUP_CONCAT(lesoptions.`idlesOptions` SEPARATOR ', '), '') AS idlesOptionsList,
    COALESCE(GROUP_CONCAT(lesoptions.`codes` SEPARATOR ', '), '') AS codeOptions,
    COALESCE(SUM(lesoptions.`prixOption`), 0) + ebr.`prixEspaceTravail` * COALESCE(ebr.duree, 1) AS totalPrice,
    ebr.duree,
    ebr.dates
FROM optionreservation AS optr
JOIN reservation AS res
    ON res.`idReservation` = optr.refReservation  -- Remplacement de l'UUID par l'id de reservation
JOIN espacetravailbydate AS ebr
    ON ebr.`idReservation` = optr.`refReservation`
LEFT JOIN lesoptions
    ON lesoptions.`idlesOptions` = optr.`idlesOptions`
GROUP BY
    optr.`refReservation`,
    ebr.`idClient`,
    ebr.`nomClient`,
    ebr.`numeroTelephoneClient`,
    ebr.`idespaceTravail`,
    ebr.`nomEspaceTravail`,
    ebr.`prixEspaceTravail`,
    ebr.id_status,
    ebr.`nomStatut`,
    ebr.`heureDebut`,
    ebr.`heureFin`,
    ebr.duree,
    ebr.dates;
