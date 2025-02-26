DELIMITER $$

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

DELIMITER ;


SELECT idReservation FROM reservation ORDER BY idReservation DESC;


--  trriger next generation Id
DELIMITER $$

CREATE TRIGGER trig_reservation_insert
BEFORE INSERT ON reservation
FOR EACH ROW
BEGIN
    SET NEW.idReservation = get_next_id_reservation();
END$$
DELIMITER $$
DELIMITER ;



INSERT INTO reservation
    (idClient, idEspaceTravail, heureDebut, heureFin, duree, dates, idoption)
VALUES
    (1, 1, 9, 12, 3, '2025-02-13', 1);

    INSERT INTO reservation
    (idClient, idEspaceTravail, heureDebut, heureFin, duree, dates, idoption)
VALUES
    (1, 2, 14, 17, 3, '2025-02-10', 1);

ALTER TABLE `attentepaiement`
CHANGE `datePaiement` `datePaiement` DATE DEFAULT CURRENT_DATE;

-- autres tets du color

CREATE OR REPLACE VIEW getEspaceTravailbyDateView AS
SELECT
    ebr.`idReservation`,                -- Référence de la réservation
    et.`idEspaceTravail`,                -- ID de l'espace de travail
    et.`nomEspaceTravail`,               -- Nom de l'espace de travail
    et.`prixEspaceTravail`,              -- Prix de l'espace de travail
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

select * from getespacetravailbydateview where `idClient`=1;

select * from reservation where dates= '2026-02-02';


    SHOW TRIGGERS LIKE 'reservation';


SELECT *
FROM reservation
WHERE dates = '2025-02-10'  -- Remplace par la date donnée
  AND (
    (9 >= heureDebut AND 9 < heureFin)   -- Remplace '10' par l'heure de début de la nouvelle réservation
    OR
    (9 + 2 > heureDebut AND 10 + 2 <= heureFin)  -- Remplace '10' par l'heure de début, et '2' par la durée de la nouvelle réservation
  );



SELECT *
FROM reservation
WHERE dates = '2025-02-10'  -- Remplace par la date donnée
  AND idEspaceTravail = 2  -- Remplace '1' par l'ID de l'espace de travail choisi
  AND (
    (9 >= heureDebut AND 9 < heureFin)   -- Remplace '9' par l'heure de début de la nouvelle réservation
    OR
    (9 + 2 > heureDebut AND 9 + 2 <= heureFin)  -- Remplace '9' par l'heure de début, et '2' par la durée de la nouvelle réservation
  );


 insert into `attentepaiement` (`referencePaiement`, `idReservation`, `datePaiement`) values (190029, r001, 2025-01);


select * from reservationcsv;
insert into optionreservation(`refReservation`,`idlesOptions`)
select refs,theOptions from reservationcsv;

select clients from reservationcsv;

INSERT INTO optionreservation (refReservation, idlesOptions)

SELECT refs, theOptions
FROM reservationcsv;
select * from lesoptions;

select * from reservationcsv;

SELECT r.refs, r.theOptions, o.idlesOptions
FROM reservationcsv AS r
LEFT JOIN lesOptions AS o ON r.theOptions = o.codes;

select * from splitoptiongetespaceview;
select *,sum(`totalPrice`) as filtreReservation from splitoptiongetespaceview where id_status=3;
select *,sum(`totalPrice`) as montantNonpayee from splitoptiongetespaceview where id_status=2;

select sum(`totalPrice`) from splitoptiongetespaceview where id_status=3;



create or replace view topcreneaux as
SELECT heureDebut, COUNT(*) AS nombreReservations
        FROM reservation
        GROUP BY heureDebut
        ORDER BY nombreReservations DESC
        LIMIT 3;

select * from reservation;
SELECT * from reservationcsv;

INSERT INTO clientcoworker (numeroTelephoneClient)
SELECT DISTINCT(clients)
FROM reservationcsv;


select * from clientcoworker;
select * from reservationcsv;

-- INSERTION RESERVATIONCSV VERS RESERVATION

INSERT INTO reservation(`idReservation`, `idClient`, `idespaceTravail`, `heureDebut`, `heureFin`, `duree`, `dates`)
SELECT
    r.refs,
    c.idClient,
    e.idEspaceTravail,
    HOUR(r.heureDebut) AS `heureDebut`,  -- Convertir l'heure en entier (ex: 14:00:00 -> 14)
    HOUR(r.heureDebut) + r.duree AS `heureFin`,  -- Additionner la durée en heures
    r.duree,  -- Valeur par défaut de durée
    r.dates
FROM reservationcsv r
JOIN clientcoworker c ON c.numeroTelephoneClient = r.clients  -- Vérification par numéro de téléphone
JOIN espacetravail e ON e.nomEspaceTravail = r.espace;  -- Vérification par nomEspaceTravail

-- INSERTION CLIENT DEPUIS RESERVATION CSV
INSERT INTO clientcoworker (numeroTelephoneClient)
SELECT DISTINCT(clients)
FROM reservationcsv;



INSERT INTO optionReservation (refReservation, idlesOptions) VALUES ('r001', 1);
INSERT INTO optionReservation (refReservation, idlesOptions) VALUES ('r001', 2);
INSERT INTO optionReservation (refReservation, idlesOptions) VALUES ('', 3);



UPDATE reservation SET id_status=6 WHERE `idReservation`='r001';

select * from reservation;

-- delete reservation where idreservation = 'r001';

-- Supprimer la contrainte existante
ALTER TABLE attentepaiement DROP FOREIGN KEY attentepaiement_ibfk_1;

-- Ajouter la contrainte avec la suppression en cascade
ALTER TABLE attentepaiement
ADD CONSTRAINT attentepaiement_ibfk_1
FOREIGN KEY (idReservation) REFERENCES reservation(idReservation)
ON DELETE CASCADE;


-- Supprimer la contrainte existante (si nécessaire)
ALTER TABLE optionreservation DROP FOREIGN KEY optionreservation_ibfk_1;

-- Ajouter la contrainte avec la suppression en cascade
ALTER TABLE optionreservation
ADD CONSTRAINT optionreservation_ibfk_1
FOREIGN KEY (refReservation) REFERENCES reservation(idReservation)
ON DELETE CASCADE;

-- delete from reservation where `idReservation`='r001';

        -- SELECT id_status, SUM(totalPrice) AS filtreReservation
        -- FROM splitoptiongetespaceview
        -- WHERE id_status = 3
        -- GROUP BY id_status

select sum(`totalPrice`) from splitoptiongetespaceview where id_status=3;
  SELECT *
            FROM splitoptiongetespaceview
            WHERE dates >= '2025-01-11'
              AND dates <= '2025-02-23'

CREATE TABLE jourFeries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mois INT,
    jour INT,
    UNIQUE INDEX mois_jour (mois, jour)
);

INSERT INTO jourFeries (mois, jour) VALUES
(1, 1),   -- Jour de l'an (1er janvier)
(5, 1),   -- Fête du travail (1er mai)
(2, 14),  -- Saint-Valentin (14 février)
(8, 15),  -- Assomption (15 août)
(11, 1),  -- Toussaint (1er novembre)
(12, 25);
 -- Noël (25 décembre)
INSERT INTO jourFeries (mois, jour) VALUES
(03, 29),   -- Jour de l'an (1er janvier)
(06, 26);   -- Jour de l'an (1er janvier)
-- Ajoutez d'autres jours fériés ici si nécessaire




php artisan migrate:rollback --path=database/migrations/2025_02_26_191019_create_les_options_table.php

php artisan migrate --path=database/migrations/2025_02_26_191019_create_les_options_table.php


-- code migrations
-- <?php

-- use Illuminate\Database\Migrations\Migration;
-- use Illuminate\Database\Schema\Blueprint;
-- use Illuminate\Support\Facades\Schema;

-- return new class extends Migration
-- {
--     public function up(): void
--     {
--         Schema::create('optionReservation', function (Blueprint $table) {
--             $table->id('idOptionReservation'); // Clé primaire auto-incrémentée
--             $table->string('refReservation', 255); // Clé étrangère vers reservation(idReservation)
--             $table->unsignedBigInteger('idlesOptions'); // Clé étrangère vers lesOptions(idlesOptions)

--             // Clés étrangères
--             $table->foreign('refReservation')->references('idReservation')->on('reservation')->onDelete('cascade');
--             $table->foreign('idlesOptions')->references('idlesOptions')->on('lesOptions')->onDelete('cascade');
--             $table->unsignedBigInteger('idlesOptions')->nullable();
--             $table->timestamps(); // Colonnes `created_at` et `updated_at`
--         });
--     }

--     /**
--      * Reverse the migrations.
--      */
--     public function down(): void
--     {
--         Schema::dropIfExists('optionReservation');
--     }

-- };
