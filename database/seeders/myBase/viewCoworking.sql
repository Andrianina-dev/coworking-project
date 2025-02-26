-- VIEW ESPACETRAVAILBYDATE
create or replace view espaceTravailbyDate as
SELECT
    reservation.`idReservation`,
    reservation.`idClient`,
    reservation.`idclientConnectez`,
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
FROM reservation
JOIN clientcoworker
    ON clientcoworker.`idClient` = reservation.`idClient`
JOIN espacetravail
    ON espacetravail.`idEspaceTravail` = reservation.`idespaceTravail`
JOIN statuts
    ON statuts.idstatut = reservation.id_status;




-- VIEW ATTENTEPAIEMENT(ATTENTEPAIEMENT)

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

select * from espacetravailbydate;
--
-- VIEW GETESPACE DE TRAVAIL


CREATE OR REPLACE VIEW getEspaceTravailbyDateView AS
SELECT
    ebr.`idReservation`,                -- Référence de la réservation
    et.`idEspaceTravail`,                -- ID de l'espace de travail
    et.`nomEspaceTravail`,               -- Nom de l'espace de travail
    et.`prixEspaceTravail`,
    ebr.`idclientConnectez`,           -- Prix de l'espace de travail
    ebr.`idClient`,                      -- ID du client
    ebr.`nomClient`,                     -- Nom du client
    ebr.`numeroTelephoneClient`,         -- Numéro de téléphone du client
    ebr.`id_status`,                     -- ID du statut de la réservation
    ebr.`nomStatut`,                     -- Nom du statut de la réservation
    ebr.`heureDebut`,                    -- Heure de début de la réservation
    ebr.`heureFin`,                      -- Heure de fin de la réservation
    lesoptions.`codes`,                 -- Code de l'option
    lesoptions.`idlesOptions`,          -- ID de l'option
    lesoptions.`nomOption`,             -- Nom de l'option
    lesoptions.`prixOption`,            -- Prix de l'option
    ebr.`duree`,                         -- Durée de la réservation
    ebr.`dates`,                         -- Date de la réservation
    CASE
        WHEN ebr.`id_status` IS NULL THEN 0 -- Aucune réservation
        WHEN ebr.`id_status` = 1 THEN 0 -- Réservation avec id_status = 1 (non confirmée)
        WHEN ebr.`id_status` = 2 THEN 2 -- Réservation avec id_status = 2 (réservée)
        WHEN ebr.`id_status` = 3 THEN 1 -- Réservation avec id_status = 3 (confirmée)
        ELSE 0 -- Autres cas par défaut
    END AS `disponibilite`               -- Disponibilité de l'espace
FROM espaceTravail AS et
LEFT JOIN espacetravailbydate AS ebr ON et.`idEspaceTravail` = ebr.`idespaceTravail`
LEFT JOIN optionreservation AS optr ON optr.`refReservation` = ebr.`idReservation`
LEFT JOIN lesoptions ON lesoptions.`idlesOptions` = optr.`idlesOptions`;


--
-- create or REPLACE view resaPerson as

-- SELECT *
-- FROM getEspaceTravailbyDateView
-- WHERE `dates` = '2025-02-11'
--   AND `idClient` != `idclientConnectez`;

select * from getespacetravailbydateview;

-- avoir le nom Client
SELECT
    getEspaceTravailbyDateView.*
FROM
    getEspaceTravailbyDateView
LEFT JOIN
    clientcoworker
ON
    getEspaceTravailbyDateView.`idclientConnectez` = clientcoworker.idClient
WHERE
    getEspaceTravailbyDateView.dates = '2025-08-20'
    AND clientcoworker.idClient IS NULL;

    SELECT * from getespacetravailbydateview;


-- FONCTION POUR NEXTID

SELECT * FROM
espacetravailbydateview

DELIMITER $$

CREATE FUNCTION get_next_id_reservation()
RETURNS VARCHAR(30)
NOT DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE next_id INT DEFAULT 0;
    DECLARE next_id_reservation VARCHAR(30);

    -- Récupérer la partie numérique maximale après le "r"
    SELECT IFNULL(
             MAX(CAST(SUBSTRING(idReservation, 2) AS UNSIGNED)), 0
           )
      INTO next_id
      FROM reservation
     WHERE idReservation LIKE 'r%';

    -- Incrémentation
    SET next_id = next_id + 1;

    -- Générer l'ID avec un format `r0001` jusqu'à `r9999`
    SET next_id_reservation = CONCAT('r', LPAD(next_id, 3, '0'));

    RETURN next_id_reservation;
END$$

-- TRIGGER
DELIMITER $$

CREATE TRIGGER trig_reservation_insert
BEFORE INSERT ON reservation
FOR EACH ROW
BEGIN
    SET NEW.idReservation = get_next_id_reservation();
END$$
DELIMITER $$


-- TOP CRENEAUX
-- heure debut seulementn
create or replace view topcreneaux as
SELECT heureDebut, COUNT(*) AS nombreReservations
        FROM reservation
        GROUP BY heureDebut
        ORDER BY nombreReservations DESC
        LIMIT 3;

CREATE TABLE nombres (heure INT);

INSERT INTO nombres (heure)
VALUES (0), (1), (2), (3), (4), (5), (6), (7), (8), (9), (10), (11),
       (12), (13), (14), (15), (16), (17), (18), (19), (20), (21), (22), (23);

-- entre intervalle heure debut et heure fin
CREATE OR REPLACE VIEW topcreneaux AS
WITH heures_reservations AS (
    SELECT
        r.idReservation,
        n.heure
    FROM
        reservation r
    JOIN
        nombres n
    ON
        n.heure >= r.heureDebut AND n.heure < r.heureFin -- Exclut heureFin
)
SELECT
    heure,
    COUNT(*) AS nombreReservations
FROM
    heures_reservations
GROUP BY
    heure
ORDER BY
    nombreReservations DESC
LIMIT 3;

select * from reservation;

--

-- VIEW SPLIT PAR VIRGULE
-- -- FORMULE ANAH

-- CREATE OR REPLACE VIEW splitOptiongetEspaceview AS

-- SELECT
--     optr.`refReservation`,
--     ebr.`idClient`,
--     ebr.`nomClient`,
--     ebr.`numeroTelephoneClient`,
--     ebr.`idespaceTravail`,
--     ebr.`nomEspaceTravail`,
--     ebr.`prixEspaceTravail`,
--     ebr.id_status,
--     ebr.`nomStatut`,
--     ebr.`heureDebut`,
--     ebr.`heureFin`,
--     -- Utilisation de COALESCE pour s'assurer que les options sont affichées même si NULL
--     COALESCE(GROUP_CONCAT(lesoptions.`nomOption` SEPARATOR ', '), '') AS allOption,
--     COALESCE(GROUP_CONCAT(lesoptions.`idlesOptions` SEPARATOR ', '), '') AS idlesOptionsList,
--     COALESCE(GROUP_CONCAT(lesoptions.`codes` SEPARATOR ', '), '') AS codeOptions,
--     -- Calcul du prix total : si aucune option, seulement (prix espace * durée), sinon somme des options + (prix espace * durée)
--     CASE
--         WHEN SUM(lesoptions.`prixOption`) IS NULL THEN FORMAT((ebr.`prixEspaceTravail` * ebr.duree), 0)
--         ELSE FORMAT(SUM(lesoptions.`prixOption`) + (ebr.`prixEspaceTravail` * ebr.duree), 0)
--     END AS totalPrice,
--     ebr.duree,
--     ebr.dates
-- FROM optionreservation AS optr
-- JOIN espacetravailbydate AS ebr
--     ON optr.`refReservation` = ebr.`idReservation`
-- LEFT JOIN lesoptions
--     ON lesoptions.`idlesOptions` = optr.`idlesOptions`
-- GROUP BY
--     optr.`refReservation`,
--     ebr.`idClient`,
--     ebr.`nomClient`,
--     ebr.`numeroTelephoneClient`,
--     ebr.`idespaceTravail`,
--     ebr.`nomEspaceTravail`,
--     ebr.`prixEspaceTravail`,
--     ebr.id_status,
--     ebr.`nomStatut`,
--     ebr.`heureDebut`,
--     ebr.`heureFin`,
--     ebr.duree,
--     ebr.dates;

-- FORMULE HAFA
CREATE OR REPLACE VIEW splitOptiongetEspaceview AS
SELECT
    ebr.`idReservation`,
    ebr.`idClient`,
    ebr.`nomClient`,
    ebr.`idclientConnectez`,
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
    -- Calcul du prix total : (somme des options * durée corrigée) + (prix espace * durée corrigée)
    COALESCE(SUM(lesoptions.`prixOption` *
        CASE
            WHEN ebr.heureDebut > 18 THEN (18 - ebr.heureDebut)
            ELSE ebr.duree
        END
    ), 0)
    + (ebr.`prixEspaceTravail` *
        CASE
            WHEN ebr.heureDebut > 18 THEN (18 - ebr.heureDebut)
            ELSE ebr.duree
        END
    ) AS totalPrice,

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

select * from splitoptiongetespaceview where id_status=2;
SELECT DISTINCT(clients)
FROM reservationcsv;

-- INSERTION RESERVEVATION

-- INSERT INTO reservation(`idReservation`, `idClient`, `idespaceTravail`, `heureDebut`, `heureFin`, `duree`, `dates`)
-- SELECT
--     r.refs,
--     c.idClient,
--     e.idEspaceTravail,
--     HOUR(r.heureDebut) AS `heureDebut`,  -- Convertir l'heure en entier (ex: 14:00:00 -> 14)
--     HOUR(r.heureDebut) + r.duree AS `heureFin`,  -- Additionner la durée en heures
--     r.duree,  -- Valeur par défaut de durée
--     r.dates
-- FROM reservationcsv r
-- JOIN clientcoworker c ON c.numeroTelephoneClient = r.clients  -- Vérification par numéro de téléphone
-- JOIN espacetravail e ON e.nomEspaceTravail = r.espace;  -- Vérification par nomEspaceTravail



-- FAIT
DELIMITER $$

CREATE OR REPLACE EVENT update_reservation_status_event
ON SCHEDULE EVERY 10 SECOND
DO
BEGIN
    UPDATE reservation
    SET id_status = 5
    WHERE id_status = 2
    AND NOW() >= DATE_ADD(dates, INTERVAL heureFin HOUR);
END;

DELIMITER ;


SET GLOBAL event_scheduler = OFF;

ALTER EVENT update_reservation_status_event DISABLE;






-- UPDATE reservation
-- SET id_status = 5
-- WHERE id_status = 2
-- AND NOW() >= DATE_ADD(dates, INTERVAL heureFin HOUR);


SHOW VARIABLES LIKE 'event_scheduler';



-- SELECT
--     dates,
--     SUM(totalPrice) AS totalSumPrice
-- FROM splitoptiongetespaceview
-- WHERE dates BETWEEN '2025-01-11' AND '2025-02-15'
--   AND id_status IN (2, 5)
-- GROUP BY dates


-- select * from splitoptiongetespaceview

ALTER TABLE attentepaiement DROP FOREIGN KEY attentepaiement_ibfk_1;
ALTER TABLE optionreservation DROP FOREIGN KEY optionreservation_ibfk_1;
-- Ajouter la contrainte avec la suppression en cascade
ALTER TABLE attentepaiement
ADD CONSTRAINT attentepaiement_ibfk_1
FOREIGN KEY (idReservation) REFERENCES reservation(idReservation)
ON DELETE CASCADE;


ALTER TABLE `clientcoworker`
	CHANGE `nomClient` `nomClient` varchar(30) NOT NULL AUTO_INCREMENT DEFAULT 'UNKNOWN' ;
ALTER TABLE `clientcoworker`
    CHANGE `nomClient` `nomClient` varchar(30) AUTO_INCREMENT DEFAULT 'UNKNOWN' ;





CREATE or REPLACE VIEW splitOptiongetEspaceview as
SELECT
    optr.`refReservation`,
    ebr.`idClient`,
    ebr.`nomClient`,
    ebr.`idclientConnectez`,
    c.`nomClient` AS nomClientConnecte,
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
    -- Calcul du prix total : (somme des options * durée corrigée) + (prix espace * durée corrigée)
    COALESCE(SUM(lesoptions.`prixOption` *
        CASE
            WHEN ebr.heureDebut > 18 THEN (18 - ebr.heureDebut)
            ELSE ebr.duree
        END
    ), 0)
    + (ebr.`prixEspaceTravail` *
        CASE
            WHEN ebr.heureDebut > 18 THEN (18 - ebr.heureDebut)
            ELSE ebr.duree
        END
    ) AS totalPrice,
    ebr.duree,
    ebr.dates
FROM optionreservation AS optr
JOIN espacetravailbydate AS ebr
    ON optr.`refReservation` = ebr.`idReservation`
LEFT JOIN lesoptions
    ON lesoptions.`idlesOptions` = optr.`idlesOptions`
LEFT JOIN clientcoworker AS c
    ON ebr.`idclientConnectez` = c.`idClient` -- Jointure sur la table des clients pour obtenir le nom
GROUP BY
    optr.`refReservation`,
    ebr.`idClient`,
    ebr.`nomClient`,
    ebr.`idclientConnectez`,
    c.`nomClient`, -- Ajout de cette ligne
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

SELECT SUM(duree) as totalDuree,dates from splitoptiongetespaceview where dates='2025-02-12';


SELECT SUM(duree) as totalDuree,dates from splitoptiongetespaceview ;
SELECT SUM(duree) as totalDuree,dates from splitoptiongetespaceview where dates='2025-02-14' GROUP BY dates

select * from splitoptiongetespaceview WHERE dates='2025-02-14';
select * from reservation WHERE dates='2024-02-15'

select * from reservation;
