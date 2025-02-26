create database workingco;
use workingco;

-- TABLE ADMINISTRATEUR
CREATE TABLE administrateur
(
    idAdministrateur int PRIMARY KEY AUTO_INCREMENT,
    nomAdministrateur VARCHAR(30),
    motdepasse VARCHAR(30)
);

insert into administrateur(nomAdministrateur,motdepasse) VALUES ('nardy','1234');

-- TABLE CLIENT
create table clientCoWorker
(
    idClient int PRIMARY KEY AUTO_INCREMENT,
    numeroTelephoneClient VARCHAR(30),
    nomClient VARCHAR(30) DEFAULT 'UNKNONW'
);

-- TABLE ESPACE DE TRAVAIL
create table espaceTravail
(
    idEspaceTravail int PRIMARY KEY AUTO_INCREMENT,
    nomEspaceTravail VARCHAR(30),
    prixEspaceTravail DOUBLE precision
);

-- TABLE STATUS
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



-- TABLE RESERVATION
create table reservation
(
    idReservation VARCHAR(255) PRIMARY KEY,
    idClient int,
    idespaceTravail int,
    heureDebut int,
    heureFin int,
    duree int,
    id_status int DEFAULT 3,
    dates date,
    idclientConnectez int,
    Foreign Key (idClient) REFERENCES clientcoWorker(idClient),
    Foreign Key (idEspaceTravail) REFERENCES espaceTravail(idEspaceTravail),
    Foreign Key (id_status) REFERENCES statuts(idstatut),
    Foreign Key (idClientConnectez) REFERENCES clientcoWorker(idClient)
);


-- DELIMITER

-- CREATE TRIGGER before_insert_reservation
-- BEFORE INSERT ON reservation
-- FOR EACH ROW
-- BEGIN
--     IF NEW.idClientConnectez IS NULL THEN
--         SET NEW.idClientConnectez = NEW.idClient;
--     END IF;
-- END;

-- DELIMITER ;

-- TABLE OPTIONS

create table lesOptions(
    idlesOptions int PRIMARY KEY AUTO_INCREMENT,
    codes VARCHAR(30),
    nomOption VARCHAR(30),
    prixOption DOUBLE PRECISION
);

-- PAIEMENT (ATTENTEPAIEMENT)

CREATE TABLE attentePaiement (
    idAttentePaiement INT PRIMARY KEY AUTO_INCREMENT,
    referencePaiement VARCHAR(30) UNIQUE,
    idReservation VARCHAR(255),
    datePaiement DATE DEFAULT CURRENT_DATE, -- Date actuelle par défaut
    FOREIGN KEY (idReservation) REFERENCES reservation(idreservation)
);


-- TABLE RELATION OPTION ET RESERVATION (OPTIONRESERVATION)
create table optionReservation
(
    idOptionReservation int PRIMARY key AUTO_INCREMENT,
    refReservation VARCHAR(255),
    idlesOptions int,
    Foreign Key (refReservation) REFERENCES reservation(idReservation),
    Foreign Key (idlesOptions) REFERENCES lesOptions(idlesOptions)
);


-- TABLE RESERVATIONCSV

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

CREATE OR REPLACE VIEW splitOptiongetEspaceview AS
SELECT
    optr.`refReservation`,
    ebr.`idClient`,
    ebr.`nomClient`,
    ebr.`numeroTelephoneClient`,
    ebr.`idespaceTravail`,
    ebr.`nomEspaceTravail`,
    FORMAT(ebr.`prixEspaceTravail`, 0) AS prixEspaceTravail, -- Ajout du formatage pour le séparateur de milliers
    ebr.id_status,
    ebr.`nomStatut`,
    ebr.`heureDebut`,
    ebr.`heureFin`,
    COALESCE(GROUP_CONCAT(lesoptions.`nomOption` SEPARATOR ', '), '') AS allOption,
    COALESCE(GROUP_CONCAT(lesoptions.`idlesOptions` SEPARATOR ', '), '') AS idlesOptionsList,
    COALESCE(GROUP_CONCAT(lesoptions.`codes` SEPARATOR ', '), '') AS codeOptions,
    -- Calcul de la durée ajustée (si heureFin > 18, prendre jusqu'à 18)
    CASE
        WHEN ebr.`heureFin` > 18 THEN (18 - ebr.`heureDebut`)
        ELSE ebr.duree
    END AS dureeAjustee,
    -- Calcul du prix total avec la durée ajustée et formaté avec séparateur de milliers
    FORMAT(
        COALESCE(SUM(lesoptions.`prixOption` *
            CASE
                WHEN ebr.`heureFin` > 18 THEN (18 - ebr.`heureDebut`)
                ELSE ebr.duree
            END), 0)
        + (ebr.`prixEspaceTravail` *
            CASE
                WHEN ebr.`heureFin` > 18 THEN (18 - ebr.`heureDebut`)
                ELSE ebr.duree
            END), 0) AS totalPrice,
    ebr.duree,
    ebr.dates
FROM optionreservation AS optr
JOIN espacetravailbydate AS ebr
    ON optr.`refReservation` = ebr.`idReservation`
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





select * from splitOptiongetEspaceview where id_status=3;
select * from splitOptiongetEspaceview;

select *FROM reservation;
ALTER TABLE optionreservation MODIFY refReservation VARCHAR(255);
ALTER TABLE attentepaiement MODIFY idReservation VARCHAR(255);


select * from reservation where dates>='2025-02-11' and dates<='2025-04-12';
