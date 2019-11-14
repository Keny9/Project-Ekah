DROP DATABASE IF EXISTS ekah;
CREATE DATABASE ekah;
USE ekah;


CREATE TABLE type_paiement (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nom VARCHAR(30) NOT NULL,
description VARCHAR(400)
);

CREATE TABLE paiement (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_type_paiement INTEGER NOT NULL,
	montant decimal(10,2) NOT NULL,
    date_paiement date NOT NULL,
	FOREIGN KEY (id_type_paiement) REFERENCES type_paiement(id)
);


CREATE TABLE type_emplacement (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
type_emplacement VARCHAR(50) NOT NULL
);

CREATE TABLE emplacement (
id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_type_emplacement INTEGER NOT NULL,
nom_lieu  VARCHAR(100) NOT NULL,
FOREIGN KEY (id_type_emplacement) REFERENCES type_emplacement(id)
);

CREATE TABLE suivi (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
fait  VARCHAR(500) NOT NULL,
commentaire  VARCHAR(500) NOT NULL
);


CREATE TABLE type_question (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nom  VARCHAR(30) NOT NULL
);

CREATE TABLE question (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_type_question INT NOT NULL,
question VARCHAR(100) NOT NULL,
nb_ligne INT,
FOREIGN KEY (id_type_question) REFERENCES type_question(id)
);

CREATE TABLE questionnaire_reservation (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nom_questionnaire  VARCHAR(100) NOT NULL
);

CREATE TABLE ta_questionnaire_reservation_question (
id_questionnaire_res INT NOT NULL,
id_question INT NOT NULL,
ordre INT NOT NULL,

PRIMARY KEY (id_questionnaire_res, id_question),
FOREIGN KEY (id_questionnaire_res) REFERENCES questionnaire_reservation(id),
FOREIGN KEY (id_question) REFERENCES question(id)
);


CREATE TABLE type_activite (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nom VARCHAR(50) NOT NULL,
description VARCHAR(100)
);

CREATE TABLE activite (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_type_activite INT NOT NULL,
nom VARCHAR(100) NOT NULL,
description_breve VARCHAR(500) NOT NULL,
description_longue VARCHAR(1500) NOT NULL,
cout DECIMAL(6,2),
FOREIGN KEY (id_type_activite) REFERENCES type_activite(id)
);

CREATE TABLE ta_activite_questionnaire_reservation (
id_activite INT NOT NULL AUTO_INCREMENT,
id_questionnaire_res INT NOT NULL,
PRIMARY KEY (id_activite, id_questionnaire_res),
FOREIGN KEY (id_questionnaire_res) REFERENCES questionnaire_reservation(id),
FOREIGN KEY (id_activite) REFERENCES activite(id)
);

CREATE TABLE duree (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
temps INT NOT NULL
);

CREATE TABLE ta_duree_activite (
id_duree INT NOT NULL,
id_activite INT NOT NULL,
PRIMARY KEY (id_duree, id_activite),
FOREIGN KEY (id_duree) REFERENCES duree(id),
FOREIGN KEY (id_activite) REFERENCES activite(id)
);





CREATE TABLE type_groupe (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
type_groupe VARCHAR(50) NOT NULL
);


CREATE TABLE type_utilisateur (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nom VARCHAR(40) NOT NULL,
description VARCHAR(300) NOT NULL
);

CREATE TABLE compte_utilisateur (
fk_utilisateur INT NOT NULL ,
courriel VARCHAR(40) NOT NULL UNIQUE,
mot_de_passe VARCHAR(100) NOT NULL,
PRIMARY KEY (fk_utilisateur)
);


CREATE TABLE fichier_perso (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
fichier  BLOB NOT NULL,
description VARCHAR(1000) NOT NULL
);

CREATE TABLE questionnaire_remplit (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
fichier  BLOB NOT NULL,
description VARCHAR(500) NOT NULL
);

CREATE TABLE profil (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_questionnaire_remplit INT NOT NULL,
id_fichier_perso INT NOT NULL,
test_psychometrique BLOB NOT NULL,
parlez_nous_de_vous VARCHAR(1000) NOT NULL,
FOREIGN KEY (id_questionnaire_remplit) REFERENCES questionnaire_remplit(id),
FOREIGN KEY (id_fichier_perso) REFERENCES fichier_perso(id)
);


CREATE TABLE province (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nom  VARCHAR(100) NOT NULL
);

CREATE TABLE ville (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nom  VARCHAR(100) NOT NULL
);

CREATE TABLE adresse (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_province INT,
ville varchar(100),
no_civique INT,
rue VARCHAR(100),
code_postal VARCHAR(10),
pays VARCHAR(100),
FOREIGN KEY (id_province) REFERENCES province(id)
);


CREATE TABLE type_etat_dispo (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
etat_disponible VARCHAR(10) NOT NULL
);


CREATE TABLE etat_disponible (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nom VARCHAR(15) NOT NULL
);

CREATE TABLE disponibilite (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_etat INT NOT NULL,
heure_debut datetime NOT NULL,
heure_fin datetime NOT NULL,
FOREIGN KEY (id_etat) REFERENCES etat_disponible(id)
);


CREATE TABLE utilisateur (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_type_utilisateur INT NOT NULL,
id_type_etat_dispo INT,
fk_id_adresse INT,
nom VARCHAR(40) NOT NULL,
prenom VARCHAR(40) NOT NULL,
telephone VARCHAR(15),
date_naissance date,
date_inscription datetime default CURRENT_TIMESTAMP,
photo VARCHAR(255), -- path vers la photo
FOREIGN KEY (id_type_utilisateur) REFERENCES type_utilisateur(id),
FOREIGN KEY (id_type_etat_dispo) REFERENCES type_etat_dispo(id),
FOREIGN KEY (fk_id_adresse) REFERENCES adresse(id)
);



ALTER TABLE compte_utilisateur
ADD FOREIGN KEY (fk_utilisateur) REFERENCES utilisateur(id);



CREATE TABLE specialite (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nom VARCHAR(40) NOT NULL
);

CREATE TABLE ta_specialite_utilisateur (
id_specialite INT NOT NULL,
id_utilisateur INT NOT NULL,
PRIMARY KEY (id_specialite, id_utilisateur),
FOREIGN KEY (id_specialite) REFERENCES specialite(id),
FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id)
);

CREATE TABLE groupe (
no_groupe INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_type_groupe INT NOT NULL,
nom_entreprise VARCHAR(100),
nom_organisateur VARCHAR(50),
nb_participant INT,
FOREIGN KEY (id_type_groupe) REFERENCES type_groupe(id)
);


CREATE TABLE inscription (
id_utilisateur INT NOT NULL,
id_groupe INT NOT NULL,
date_inscription datetime default CURRENT_TIMESTAMP,
PRIMARY KEY (id_utilisateur, id_groupe),
FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id),
FOREIGN KEY (id_groupe) REFERENCES groupe(no_groupe)
);

CREATE TABLE etat_reservation (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nom VARCHAR(40) NOT NULL
);

CREATE TABLE reservation (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_paiement INT,
id_emplacement INT,
id_suivi INT,
id_activite INT,
id_groupe INT,
id_facilitateur INT,
date_rendez_vous DATETIME NOT NULL,
heure_debut INT NOT NULL,
heure_fin INT NOT NULL,
id_etat INT NOT NULL,
FOREIGN KEY (id_paiement) REFERENCES paiement(id),
FOREIGN KEY (id_emplacement) REFERENCES emplacement(id),
FOREIGN KEY (id_suivi) REFERENCES suivi(id),
FOREIGN KEY (id_activite) REFERENCES activite(id),
FOREIGN KEY (id_groupe) REFERENCES groupe(no_groupe),
FOREIGN KEY (id_facilitateur) REFERENCES utilisateur(id),
FOREIGN KEY (id_etat) REFERENCES etat_reservation(id)
);

CREATE TABLE region (
id INT NOT NULL,
nom varchar(30),
PRIMARY KEY (id)
);

CREATE TABLE ta_disponibilite_specialiste (
id_specialiste INT NOT NULL,
id_disponibilite INT NOT NULL,
id_region INT,
PRIMARY KEY (id_specialiste, id_disponibilite),
FOREIGN KEY (id_disponibilite) REFERENCES disponibilite(id),
FOREIGN KEY (id_specialiste) REFERENCES utilisateur(id),
FOREIGN KEY (id_region) REFERENCES region(id)
);

CREATE TABLE fichier_client(
id INT NOT NULL AUTO_INCREMENT,
name VARCHAR(30) NOT NULL,
type VARCHAR(30) NOT NULL,
size INT NOT NULL,
content MEDIUMBLOB NOT NULL,
PRIMARY KEY(id)
);


INSERT INTO region(id, nom) VALUES (1, "Estrie");
INSERT INTO region(id, nom) VALUES (2, "Montérégie");
INSERT INTO region(id, nom) VALUES (3, "Québec");

INSERT INTO province(id, nom) VALUES (1, "Québec");
INSERT INTO province(id, nom) VALUES (2, "Ontario");
INSERT INTO province(id, nom) VALUES (3, "Nouvelle Écosse");
INSERT INTO province(id, nom) VALUES (4, "Nouveau Brunswick");

-- INSERT INTO ville(id, nom) VALUES (1, "Sherbrooke");
-- INSERT INTO ville(id, nom) VALUES (2, "Bromont");
-- INSERT INTO ville(id, nom) VALUES (3, "Montréal");
-- INSERT INTO ville(id, nom) VALUES (4, "Québec");

INSERT INTO adresse(id, id_province, ville, no_civique, rue, code_postal, pays) VALUES (1, 1, "Sherbrooke", 454, "Terril", "J1J 1J1", "Canada");
INSERT INTO adresse(id, id_province, ville, no_civique, rue, code_postal, pays) VALUES (2, 1, "Magog", 454, "Magog St", "J1J 1J1", "Canada");
INSERT INTO adresse(id, id_province, ville, no_civique, rue, code_postal, pays) VALUES (3, 1, "Montreal", 454, "Boul Montreal", "J1J 1J1", "Canada");
INSERT INTO adresse(id, id_province, ville, no_civique, rue, code_postal, pays) VALUES (4, 1, "Québec", 454, "Quebec St", "J1J 1J1", "Canada");


INSERT INTO type_paiement(id, nom, description) VALUES (1, "Paypal", "Payer à l'aide de Paypal");

INSERT INTO paiement(id, id_type_paiement, montant, date_paiement) VALUES (1, 1, 45.25, '2019-01-01');
INSERT INTO paiement(id, id_type_paiement, montant, date_paiement) VALUES (2, 1, 50.00, '2019-05-13');
INSERT INTO paiement(id, id_type_paiement, montant, date_paiement) VALUES (3, 1, 25.00, '2019-06-21');
INSERT INTO paiement(id, id_type_paiement, montant, date_paiement) VALUES (4, 1, 28.00, '2019-06-26');
INSERT INTO paiement(id, id_type_paiement, montant, date_paiement) VALUES (5, 1, 35.00, '2019-06-28');
INSERT INTO paiement(id, id_type_paiement, montant, date_paiement) VALUES (6, 1, 45.25, '2019-01-01');
INSERT INTO paiement(id, id_type_paiement, montant, date_paiement) VALUES (7, 1, 50.00, '2019-05-13');
INSERT INTO paiement(id, id_type_paiement, montant, date_paiement) VALUES (8, 1, 25.00, '2019-06-21');
INSERT INTO paiement(id, id_type_paiement, montant, date_paiement) VALUES (9, 1, 28.00, '2019-06-26');
INSERT INTO paiement(id, id_type_paiement, montant, date_paiement) VALUES (10, 1, 35.00, '2019-06-28');
INSERT INTO paiement(id, id_type_paiement, montant, date_paiement) VALUES (11, 1, 45.25, '2019-01-01');
INSERT INTO paiement(id, id_type_paiement, montant, date_paiement) VALUES (12, 1, 50.00, '2019-05-13');
INSERT INTO paiement(id, id_type_paiement, montant, date_paiement) VALUES (13, 1, 25.00, '2019-06-21');
INSERT INTO paiement(id, id_type_paiement, montant, date_paiement) VALUES (14, 1, 28.00, '2019-06-26');
INSERT INTO paiement(id, id_type_paiement, montant, date_paiement) VALUES (15, 1, 35.00, '2019-06-28');

INSERT INTO type_emplacement(id, type_emplacement) VALUES (1, "Café");
INSERT INTO type_emplacement(id, type_emplacement) VALUES (2, "Maison");

INSERT INTO emplacement(id, id_type_emplacement, nom_lieu) VALUES (1, "1", "123 rue Galt");
INSERT INTO emplacement(id, id_type_emplacement, nom_lieu) VALUES (2, "1", "405 rue Sherbrooke");
INSERT INTO emplacement(id, id_type_emplacement, nom_lieu) VALUES (3, "1", "30 Linden Ave.Bear, DE 19701");
INSERT INTO emplacement(id, id_type_emplacement, nom_lieu) VALUES (4, "1", "480 Walnut StreetEvansville, IN 47711");
INSERT INTO emplacement(id, id_type_emplacement, nom_lieu) VALUES (5, "1", "33 Glenridge Ave.Taylor, MI 48180");
INSERT INTO emplacement(id, id_type_emplacement, nom_lieu) VALUES (6, "1", "494 Fawn Ave.Warwick, RI 02886");
INSERT INTO emplacement(id, id_type_emplacement, nom_lieu) VALUES (7, "1", "7122 Mountainview StreetStatesville, NC 28625");
INSERT INTO emplacement(id, id_type_emplacement, nom_lieu) VALUES (8, "1", "9360 Myrtle Ave.Simpsonville, SC 29680");
INSERT INTO emplacement(id, id_type_emplacement, nom_lieu) VALUES (9, "1", "7274 South Lakewood Ave.Lynchburg, VA 24502");
INSERT INTO emplacement(id, id_type_emplacement, nom_lieu) VALUES (10, "1", "8036 Academy Ave.Syosset, NY 11791");
INSERT INTO emplacement(id, id_type_emplacement, nom_lieu) VALUES (11, "1", "7335 Shub Farm St.Lawrenceville, GA 30043");
INSERT INTO emplacement(id, id_type_emplacement, nom_lieu) VALUES (12, "1", "8099 Rockledge LaneBenton Harbor, MI 49022");
INSERT INTO emplacement(id, id_type_emplacement, nom_lieu) VALUES (13, "1", "9546 Third St.King Of Prussia, PA 19406");
INSERT INTO emplacement(id, id_type_emplacement, nom_lieu) VALUES (14, "1", "75 Beechwood LaneBrighton, MA 02135");
INSERT INTO emplacement(id, id_type_emplacement, nom_lieu) VALUES (15, "1", "787 Edgewood DriveClifton Park, NY 12065");


INSERT INTO type_question(id, nom) VALUES (1, "Texte");
INSERT INTO type_question(id, nom) VALUES (2, "Case à chocher");

INSERT INTO question(id, id_type_question, question, nb_ligne)
VALUES (1,1, "Autres informations pertinentes en préparation au rendez-vous", 6);
INSERT INTO question(id,id_type_question, question, nb_ligne)
VALUES (2,1, "Souffrez-vous de problèmes de santé ou des maladies? Si oui, lesquelles?", 3);
INSERT INTO question(id,id_type_question, question, nb_ligne)
VALUES (3,1, "Prenez-vous des médicaments? Si oui, lesquels et pour quelles raisons?", 3);
INSERT INTO question(id,id_type_question, question, nb_ligne)
VALUES (4,1, "Avez-vous actuellement des douleurs ou des blessures? Si oui, lesquelles?", 3);
INSERT INTO question(id,id_type_question, question, nb_ligne)
VALUES (5,1, "Avez-vous des antécédants de douleurs ou de blessures? Si oui, lesquels?", 3);
INSERT INTO question(id,id_type_question, question, nb_ligne)
VALUES (6,1, "Faites-vous affaires avec d'autres professionnels de la santé? Si oui, lesquels? (nom, coordonnées)", 3);
INSERT INTO question(id,id_type_question, question, nb_ligne)
VALUES (7,1, "Quels sont vos objectifs d’entraînement?", 4);
INSERT INTO question(id,id_type_question, question, nb_ligne)
VALUES (8,1, "Combien de fois par semaine pratiquez-vous de l’activité physique?", 1);
INSERT INTO question(id,id_type_question, question, nb_ligne)
VALUES (9,1, "En moyenne, combien de temps par séance?", 1);
INSERT INTO question(id,id_type_question, question, nb_ligne)
VALUES (10,1, "Avez-vous des allergies (alimentaires, médicaments, autres) ? Si oui, lesquelles?", 3);
INSERT INTO question(id,id_type_question, question, nb_ligne)
VALUES (11,1, "Quels sont vos objectifs de changement d’habitudes?", 4);
INSERT INTO question(id,id_type_question, question, nb_ligne)
VALUES (12,1, "Combien d’heures en moyenne passez-vous en position assise par jour? (travail, transport, ordinateur, lecture, etc.)", 1);
INSERT INTO question(id,id_type_question, question, nb_ligne)
VALUES (13,1, "Combien d’heures en moyenne passez-vous en nature par semaine?", 1);
INSERT INTO question(id,id_type_question, question, nb_ligne)
VALUES (14,1, "Combien de repas mangez-vous par jour?", 1);
INSERT INTO question(id,id_type_question, question, nb_ligne)
VALUES (15,1, "Consommez-vous du tabac ou de l’alcool?", 2);
INSERT INTO question(id,id_type_question, question, nb_ligne)
VALUES (16,1, "Avez-vous de la difficulté à dormir, vous endormir, récupérer suite aux nuits de sommeil?", 2);
INSERT INTO question(id,id_type_question, question, nb_ligne)
VALUES (17,1, "Avez-vous déjà pratiqué la méditation et/ou diverses postures de yoga?", 1);

INSERT INTO questionnaire_reservation(id,nom_questionnaire) VALUES (1,"Questionnaire médical");
INSERT INTO questionnaire_reservation(id,nom_questionnaire) VALUES (2,"Soins à domicile");
INSERT INTO questionnaire_reservation(id,nom_questionnaire) VALUES (3,"Entraînement à domicile");
INSERT INTO questionnaire_reservation(id,nom_questionnaire) VALUES (4,"Habitudes de vie à domicile");
INSERT INTO questionnaire_reservation(id,nom_questionnaire) VALUES (5,"Yoga et méditation à domicile");
INSERT INTO questionnaire_reservation(id,nom_questionnaire) VALUES (6,"Programme d'entraînement (en ligne)");

INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (2, 2, 1);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (2, 3, 2);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (2, 4, 3);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (2, 5, 4);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (2, 6, 5);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (2, 1, 6);

INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (3, 2,1);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (3, 3,2);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (3, 4,3);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (3, 5,4);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (3, 6, 5);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (3, 7, 6);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (3, 8, 7);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (3, 9, 8);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (3, 1, 9);

INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (4, 2, 1);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (4, 3, 2);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (4, 10, 3);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (4, 6, 4);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (4, 11, 5);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (4, 8, 6);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (4, 9, 7);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (4, 12, 8);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (4, 13, 9);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (4, 14, 10);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (4, 15, 11);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (4, 16, 12);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (4, 1, 13);

INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (5, 2, 1);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (5, 3, 2);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (5, 4, 3);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (5, 5, 4);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (5, 6, 5);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (5, 17, 6);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (5, 1, 7);

INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (6, 2, 1);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (6, 3, 2);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (6, 4, 3);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (6, 5, 4);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (6, 6, 5);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (6, 7, 6);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (6, 8, 7);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (6, 9, 8);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question, ordre) VALUES (6, 1, 9);



INSERT INTO type_activite(id, nom, description) VALUES (1, "En atelier", "Se donne dans un lieu donné par les facilitateurs. Contient souvent plusieurs clients.");
INSERT INTO type_activite(id, nom, description) VALUES (2, "À domicile", "Se donne généralement chez le client. Le client décide donc du lieu de rendez-vous. Par défaut, ce sera son adresse personnelle, mais il peut aussi en décider une autre.");
INSERT INTO type_activite(id, nom, description) VALUES (3, "En ligne", "Se donne par conférence webcam. Donc, pas de lieu.");
INSERT INTO type_activite(id, nom, description) VALUES (4, "En groupe", "Cette activité est à revoir.");


INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue, cout) VALUES (1, 2, "Soins à domicile", "Pour apprendre à se détendre, respirer, prendre soin de soi, écouter son corps, guérir ses blessures et améliorer sa posture, nous offrons des services à domicile en kinésiologie-kinésithérapie, ostéopathie, orthothérapie massothérapie et aromathérapie.", "LONGUE", 100);
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue, cout) VALUES (2, 2, "Entraînement à domicile", "Pour prendre en main sa santé, cultiver un mode de vie sain, préparer son corps pour une discipline ou adopter une pratique adaptée à ses besoins, nous offrons des services d’accompagnement, de préparation physique et d’entraînement à domicile.", "LONGUE", 100.99);
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue, cout) VALUES (3, 2, "Habitudes de vies à domicile", "Pour être accompagné dans l’adoption d’un mode de vie adapté à ses besoins, être aligné avec notre alimentation, apprendre à manger et cuisiner sainement, nous offrons des services d’orientation des habitudes de vie et de création culinaires personnalisés à domicile.", "LONGUE", 25);
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue, cout) VALUES (4, 2, "Yoga et méditation à domicile", "Pour vivre des séances sur mesure, être accompagné dans l’intégration des asanas et de la méditation dans sa vie, développer une pratique sécuritaire et adaptée à ses besoins ou approfondir son expérience du yoga, nous offrons des séances individuelles et en groupe à domicile.", "LONGUE", 19.99);

INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (5, 1, "L’Ennéagramme", "Pour prendre pleine possession de ses forces, mieux aborder ses défis, connaître la structure de sa \"personnalité\", mieux connaître la nature humaine, découvrir ses différentes intelligences, filtres de perception, motivations profondes, comportements typiques, mécanismes réactionnels. Nous offrons un atelier d’introduction d’une journée sur les différents types d'humains et de leur \"personnalité\".", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (6, 1, "Réflexion créative: Flow design", "Pour réellement s'aligner et s’engager vers la version la plus enrichissante de nous-même, pour renouveler sa façon d’évoluer, pour transcender des limitations qui nous empêchent d’avancer, pour utiliser tout son potentiel afin d’orienter sa propre vie, dans notre cursus de formation à l’Ennéagramme, nous offrons des séances individuelles et des ateliers d’une journée en groupe de flow design.", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (7, 1, "L’art de la facilitation", "Pour apprendre à tenir l’espace, développer un savoir-être avec nous-même et les autres, pour intégrer des notions de gestion de groupe et apprendre à diriger par l’écoute, nous offrons des ateliers d’une journée en groupe sur l’art de la facilitation.", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (8, 1, "Trouver sa voix", "Pour cultiver une expression authentique, apprendre à avoir confiance dans ses manifestations et son discours en public, pour explorer l’épanouissement que nous amène le chant et le travail vocal, nous offrons des ateliers d’une demi-journée en groupe sur trouver sa voix.", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (9, 1, "Art intuitif", "Pour explorer son potentiel créatif, apprendre à utiliser l’art pour s’exprimer, s’initier à de nouvelles façons de jouer, de s’amuser, de réfléchir, de et de se découvrir, nous offrons des ateliers d’une demi-journée en expression intuitive.", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (10, 1, "Mouvement intuitif", "Pour cultiver la fluidité corporelle, , découvrir de nouvelles façons de bouger, apprendre à méditer en mouvement et pour s’amuser en groupe, nous offrons des ateliers d’une demi-journée de mouvements intuitifs.", "LONGUE");

INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (11, 3, "Séances de Flow Design", "Pour réellement s'aligner et s’engager vers la version la plus enrichissante de nous-même, pour utiliser sa créativité afin d’établir des objectifs concrets pour évoluer, nous offrons une série de 8 rencontres à distance durant lesquels le flow design est utilisé pour se ramener à l’essentiel et poser des actions conscientes dans sa vie.", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (12, 3, "Orientation MPO", "Cette rencontre d'orientation permet de conscientiser ses besoins motivationnels, se positionner et de se rapprocher du contexte idéal dans lequel s'épanouir grâce à l’outil psychométrique MPO. Le test s'effectue en ligne en 20 minutes, la séance d'orientation dure 90 minutes en vidéoconférence", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (13, 3, "Mentorat", "Pour vous accompagner dans votre développement personnel, professionnel et spirituel, nous partageons des réflexions, pistes de solutions, pratiques personnelles, nouvelles expériences ainsi que de devoirs à accomplir dans des rencontres de 60 minutes en ligne. L’encadrement est adapté à vos besoins et inclu un suivi par courriel hebdomadaire.", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (14, 3, "Programmes d’entraînement", "Pour vous encadrer dans votre mode de vie actif, préparer votre corps pour une discipline sportive, prévenir vos blessures et adopter une pratique adaptée à vos besoins, nous offrons des services de préparation de programme sur mesure en ligne. la rencontre d’évaluation dure 30 minutes en ligne et la prescription du programme d’entraînement 90 minutes.", "LONGUE");

INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (15, 4, "Coaching Professionnel", "Ces séances individuelles visent à orienter  chaque  membre de l’équipe à travers une pratique qui fait émerger et cultive un leadership authentique.", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (16, 4, "Ateliers et Facilitation", "Nos ateliers visent à  intégrer des outils et des pratiques qui enrichissent les dynamiques personnelles et  interpersonnelles dans les équipes ", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (17, 4, "Consolidation en Plein-air", "Nos défis d’équipe visent à tester et transformer les dynamiques d’équipe,  supportés par des outils psychométriques nous expérimentons des épreuves dans un environnement inconnu. ", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (18, 4, "Entraînements en Équipe", "Nos entraînements de groupe permettent de cultiver la dynamique d’équipe dans une atmosphère ludique et énergisante. Séances  privés au bureau et en plein-air..", "LONGUE");


INSERT INTO ta_activite_questionnaire_reservation(id_activite, id_questionnaire_res) VALUES (1, 2);
INSERT INTO ta_activite_questionnaire_reservation(id_activite, id_questionnaire_res) VALUES (2, 3);
INSERT INTO ta_activite_questionnaire_reservation(id_activite, id_questionnaire_res) VALUES (3, 4);
INSERT INTO ta_activite_questionnaire_reservation(id_activite, id_questionnaire_res) VALUES (4, 5);
INSERT INTO ta_activite_questionnaire_reservation(id_activite, id_questionnaire_res) VALUES (14, 6);


INSERT INTO duree(id, temps) VALUES (1, 30);
INSERT INTO duree(id, temps) VALUES (2, 60);
INSERT INTO duree(id, temps) VALUES (3, 90);
INSERT INTO duree(id, temps) VALUES (4, 120);
INSERT INTO duree(id, temps) VALUES (5, 150);

INSERT INTO ta_duree_activite(id_activite, id_duree) VALUES (1, 1);
INSERT INTO ta_duree_activite(id_activite, id_duree) VALUES (1, 3);
INSERT INTO ta_duree_activite(id_activite, id_duree) VALUES (2, 2);
INSERT INTO ta_duree_activite(id_activite, id_duree) VALUES (3, 1);
INSERT INTO ta_duree_activite(id_activite, id_duree) VALUES (3, 2);


INSERT INTO type_groupe(id, type_groupe) VALUES (1, "Réservation individuelle");
INSERT INTO type_groupe(id, type_groupe) VALUES (2, "Rassemblateur");
INSERT INTO type_groupe(id, type_groupe) VALUES (3, "Groupe");

INSERT INTO type_utilisateur(id, nom, description) VALUES (1, "Client", "Le client");
INSERT INTO type_utilisateur(id, nom, description) VALUES (2, "Facilitateur", "Un facilitateur");

INSERT INTO type_etat_dispo(id, etat_disponible) VALUES (1, "Disponible");
INSERT INTO type_etat_dispo(id, etat_disponible) VALUES (2, "Non Disponible");

INSERT INTO utilisateur(id_type_utilisateur, id_type_etat_dispo, fk_id_adresse, nom, prenom, date_inscription, photo) VALUES (2, 1, 1, "Facilitateur", "Gabriel", NOW(), "img1.jpg");
INSERT INTO utilisateur(id_type_utilisateur, id_type_etat_dispo, fk_id_adresse, nom, prenom, date_inscription, photo) VALUES (2, 1, 2, "Facilitateur", "Raphaël", NOW(), "img2.jpg");
INSERT INTO utilisateur(id_type_utilisateur, id_type_etat_dispo, fk_id_adresse, nom, prenom, date_inscription, photo) VALUES (2, 1, 3, "Facilitateur", "Claudie", NOW(), "img3.jpg");
INSERT INTO utilisateur(id_type_utilisateur, id_type_etat_dispo, fk_id_adresse, nom, prenom, date_inscription, date_naissance) VALUES (1, null, 4, "Client", "Annie", NOW(), "1995-09-01");
INSERT INTO utilisateur(id_type_utilisateur, id_type_etat_dispo, fk_id_adresse, nom, prenom, date_inscription) VALUES (1, null, 1, "Client", "Beatrice", NOW());
INSERT INTO utilisateur(id_type_utilisateur, id_type_etat_dispo, fk_id_adresse, nom, prenom, date_inscription) VALUES (1, null, 2, "Client", "Charlotte", NOW());
INSERT INTO utilisateur(id_type_utilisateur, id_type_etat_dispo, fk_id_adresse, nom, prenom, date_inscription) VALUES (1, null, 3, "Client", "David", NOW());

INSERT INTO compte_utilisateur(fk_utilisateur, courriel, mot_de_passe) VALUES (1, "admin1@ekah.ca", '$argon2i$v=19$m=1024,t=2,p=2$Z2ZYQ0RyWU5JYWxCZ3ZKbA$Htc8SVQQh++zeYvyjYwQCLUCyrSLhIlzsskG6f4Euos');
INSERT INTO compte_utilisateur(fk_utilisateur, courriel, mot_de_passe) VALUES (2, "admin2@ekah.ca", '$argon2i$v=19$m=1024,t=2,p=2$Z2ZYQ0RyWU5JYWxCZ3ZKbA$Htc8SVQQh++zeYvyjYwQCLUCyrSLhIlzsskG6f4Euos');
INSERT INTO compte_utilisateur(fk_utilisateur, courriel, mot_de_passe) VALUES (3, "admin3@ekah.ca", '$argon2i$v=19$m=1024,t=2,p=2$Z2ZYQ0RyWU5JYWxCZ3ZKbA$Htc8SVQQh++zeYvyjYwQCLUCyrSLhIlzsskG6f4Euos');
INSERT INTO compte_utilisateur(fk_utilisateur, courriel, mot_de_passe) VALUES (4, "annie@ekah.ca", '$argon2i$v=19$m=1024,t=2,p=2$Z2ZYQ0RyWU5JYWxCZ3ZKbA$Htc8SVQQh++zeYvyjYwQCLUCyrSLhIlzsskG6f4Euos');
INSERT INTO compte_utilisateur(fk_utilisateur, courriel, mot_de_passe) VALUES (5, "beatrice@ekah.ca", '$argon2i$v=19$m=1024,t=2,p=2$Z2ZYQ0RyWU5JYWxCZ3ZKbA$Htc8SVQQh++zeYvyjYwQCLUCyrSLhIlzsskG6f4Euos');
INSERT INTO compte_utilisateur(fk_utilisateur, courriel, mot_de_passe) VALUES (6, "charlotte@ekah.ca", '$argon2i$v=19$m=1024,t=2,p=2$Z2ZYQ0RyWU5JYWxCZ3ZKbA$Htc8SVQQh++zeYvyjYwQCLUCyrSLhIlzsskG6f4Euos');
INSERT INTO compte_utilisateur(fk_utilisateur, courriel, mot_de_passe) VALUES (7, "david@ekah.ca", '$argon2i$v=19$m=1024,t=2,p=2$Z2ZYQ0RyWU5JYWxCZ3ZKbA$Htc8SVQQh++zeYvyjYwQCLUCyrSLhIlzsskG6f4Euos');

INSERT INTO fichier_perso(id, fichier, description) VALUES (1, "abc123", "Fichier");

INSERT INTO questionnaire_remplit(id, fichier, description) VALUES (1, "abc123", "Fichier");

INSERT INTO profil(id, id_questionnaire_remplit, id_fichier_perso, test_psychometrique, parlez_nous_de_vous) VALUES (1, 1, 1, "BLOB", "Je suis quelqu'un de tr;s actif.");


INSERT INTO etat_disponible(id, nom) VALUES (1, "Actif");
INSERT INTO etat_disponible(id, nom) VALUES (2, "Reserve");
INSERT INTO etat_disponible(id, nom) VALUES (3, "Annule");

INSERT INTO disponibilite(id, id_etat, heure_debut, heure_fin) VALUES (1, 1, '2059-10-11 11:00:00','2059-10-11 12:00:00');
INSERT INTO disponibilite(id, id_etat, heure_debut, heure_fin) VALUES (2, 1, '2019-10-11 14:00:00','2019-10-11 16:30:00');
INSERT INTO disponibilite(id, id_etat, heure_debut, heure_fin) VALUES (3, 1, '2019-10-12 11:00:00','2019-10-12 13:00:00');
INSERT INTO disponibilite(id, id_etat, heure_debut, heure_fin) VALUES (4, 2, '2019-10-12 07:00:00','2019-10-12 11:30:00');
INSERT INTO disponibilite(id, id_etat, heure_debut, heure_fin) VALUES (5, 2, '2019-10-13 08:30:00','2019-10-13 12:00:00');
INSERT INTO disponibilite(id, id_etat, heure_debut, heure_fin) VALUES (6, 3, '2010-10-13 11:00:00','2010-10-13 17:00:00');

INSERT INTO disponibilite(id, id_etat, heure_debut, heure_fin) VALUES (7, 1, '2019-11-29 11:00:00','2019-11-29 12:30:00');
INSERT INTO disponibilite(id, id_etat, heure_debut, heure_fin) VALUES (8, 1, '2019-11-29 11:30:00','2019-11-29 12:00:00');

INSERT INTO disponibilite(id, id_etat, heure_debut, heure_fin) VALUES (9, 1, '2019-11-29 14:00:00','2019-11-29 14:30:00');
INSERT INTO disponibilite(id, id_etat, heure_debut, heure_fin) VALUES (10, 1, '2019-11-29 14:30:00','2019-11-29 15:00:00');
INSERT INTO disponibilite(id, id_etat, heure_debut, heure_fin) VALUES (11, 1, '2019-11-29 15:00:00','2019-11-29 15:30:00');

INSERT INTO disponibilite(id, id_etat, heure_debut, heure_fin) VALUES (12, 1, '2019-12-16 11:00:00','2019-12-16 11:30:00');
INSERT INTO disponibilite(id, id_etat, heure_debut, heure_fin) VALUES (13, 1, '2019-12-16 11:30:00','2019-12-16 12:00:00');
INSERT INTO disponibilite(id, id_etat, heure_debut, heure_fin) VALUES (14, 1, '2019-12-16 12:00:00','2019-12-16 12:30:00');
INSERT INTO disponibilite(id, id_etat, heure_debut, heure_fin) VALUES (15, 1, '2019-12-16 12:30:00','2019-12-16 13:00:00');



INSERT INTO specialite(id, nom) VALUES (1, "Meditation");




INSERT INTO suivi(id, fait, commentaire) VALUES (1, "Vide", "Vide");
INSERT INTO suivi(id, fait, commentaire) VALUES (2, "Vide", "Vide");
INSERT INTO suivi(id, fait, commentaire) VALUES (3, "Vide", "Vide");
INSERT INTO suivi(id, fait, commentaire) VALUES (4, "Vide", "Vide");
INSERT INTO suivi(id, fait, commentaire) VALUES (5, "Vide", "Vide");
INSERT INTO suivi(id, fait, commentaire) VALUES (6, "Vide", "Vide");
INSERT INTO suivi(id, fait, commentaire) VALUES (7, "Vide", "Vide");
INSERT INTO suivi(id, fait, commentaire) VALUES (8, "Vide", "Vide");
INSERT INTO suivi(id, fait, commentaire) VALUES (9, "Vide", "Vide");
INSERT INTO suivi(id, fait, commentaire) VALUES (10, "Vide", "Vide");
INSERT INTO suivi(id, fait, commentaire) VALUES (11, "Vide", "Vide");
INSERT INTO suivi(id, fait, commentaire) VALUES (12, "Vide", "Vide");
INSERT INTO suivi(id, fait, commentaire) VALUES (13, "Vide", "Vide");
INSERT INTO suivi(id, fait, commentaire) VALUES (14, "Vide", "Vide");
INSERT INTO suivi(id, fait, commentaire) VALUES (15, "Vide", "Vide");

INSERT INTO groupe(no_groupe, id_type_groupe, nom_entreprise, nom_organisateur, nb_participant) VALUES (1, 1, null, null, null);
INSERT INTO groupe(no_groupe, id_type_groupe, nom_entreprise, nom_organisateur, nb_participant) VALUES (2, 1, null, null, null);
INSERT INTO groupe(no_groupe, id_type_groupe, nom_entreprise, nom_organisateur, nb_participant) VALUES (3, 1, null, null, null);
INSERT INTO groupe(no_groupe, id_type_groupe, nom_entreprise, nom_organisateur, nb_participant) VALUES (4, 1, null, null, null);
INSERT INTO groupe(no_groupe, id_type_groupe, nom_entreprise, nom_organisateur, nb_participant) VALUES (5, 1, null, null, null);
INSERT INTO groupe(no_groupe, id_type_groupe, nom_entreprise, nom_organisateur, nb_participant) VALUES (6, 1, null, null, null);
INSERT INTO groupe(no_groupe, id_type_groupe, nom_entreprise, nom_organisateur, nb_participant) VALUES (7, 1, null, null, null);
INSERT INTO groupe(no_groupe, id_type_groupe, nom_entreprise, nom_organisateur, nb_participant) VALUES (8, 1, null, null, null);
INSERT INTO groupe(no_groupe, id_type_groupe, nom_entreprise, nom_organisateur, nb_participant) VALUES (9, 1, null, null, null);
INSERT INTO groupe(no_groupe, id_type_groupe, nom_entreprise, nom_organisateur, nb_participant) VALUES (10, 1, null, null, null);
INSERT INTO groupe(no_groupe, id_type_groupe, nom_entreprise, nom_organisateur, nb_participant) VALUES (11, 1, null, null, null);
INSERT INTO groupe(no_groupe, id_type_groupe, nom_entreprise, nom_organisateur, nb_participant) VALUES (12, 1, null, null, null);
INSERT INTO groupe(no_groupe, id_type_groupe, nom_entreprise, nom_organisateur, nb_participant) VALUES (13, 1, null, null, null);
INSERT INTO groupe(no_groupe, id_type_groupe, nom_entreprise, nom_organisateur, nb_participant) VALUES (14, 1, null, null, null);
INSERT INTO groupe(no_groupe, id_type_groupe, nom_entreprise, nom_organisateur, nb_participant) VALUES (15, 1, null, null, null);

INSERT INTO inscription(id_utilisateur, id_groupe, date_inscription) VALUES (4, 1, '2020-01-05');
INSERT INTO inscription(id_utilisateur, id_groupe, date_inscription) VALUES (5, 2, '2020-01-17');
INSERT INTO inscription(id_utilisateur, id_groupe, date_inscription) VALUES (6, 3, '2020-01-18');
INSERT INTO inscription(id_utilisateur, id_groupe, date_inscription) VALUES (7, 4, '2020-02-10');
INSERT INTO inscription(id_utilisateur, id_groupe, date_inscription) VALUES (4, 5, '2020-02-22');
INSERT INTO inscription(id_utilisateur, id_groupe, date_inscription) VALUES (5, 6, '2020-02-30');
INSERT INTO inscription(id_utilisateur, id_groupe, date_inscription) VALUES (6, 7, '2020-03-01');
INSERT INTO inscription(id_utilisateur, id_groupe, date_inscription) VALUES (7, 8, '2020-03-10');
INSERT INTO inscription(id_utilisateur, id_groupe, date_inscription) VALUES (4, 9, '2020-03-11');
INSERT INTO inscription(id_utilisateur, id_groupe, date_inscription) VALUES (5, 10, '2020-03-22');
INSERT INTO inscription(id_utilisateur, id_groupe, date_inscription) VALUES (6, 11, '2020-03-28');
INSERT INTO inscription(id_utilisateur, id_groupe, date_inscription) VALUES (7, 12, '2020-04-03');
INSERT INTO inscription(id_utilisateur, id_groupe, date_inscription) VALUES (4, 13, '2020-05-09');
INSERT INTO inscription(id_utilisateur, id_groupe, date_inscription) VALUES (5, 14, '2020-05-15');
INSERT INTO inscription(id_utilisateur, id_groupe, date_inscription) VALUES (6, 15, '2020-05-23');

INSERT INTO etat_reservation(id,nom) VALUES(1, 'actif');
INSERT INTO etat_reservation(id,nom) VALUES(2, 'inactif');

INSERT INTO reservation(id, id_paiement, id_emplacement, id_suivi, id_activite, id_groupe, id_facilitateur, date_rendez_vous, heure_debut, heure_fin, id_etat) VALUES (1, 1, 1, 1, 1, 1, 1, '2019-01-05 19:00', 8, 9, 1);
INSERT INTO reservation(id, id_paiement, id_emplacement, id_suivi, id_activite, id_groupe, id_facilitateur, date_rendez_vous, heure_debut, heure_fin, id_etat) VALUES (2, 2, 2, 2, 1, 2, 2, '2019-02-02 13:00', 13, 14, 1);
INSERT INTO reservation(id, id_paiement, id_emplacement, id_suivi, id_activite, id_groupe, id_facilitateur, date_rendez_vous, heure_debut, heure_fin, id_etat) VALUES (3, 3, 3, 3, 1, 3, 3, '2020-02-10 13:30', 13, 14, 1);
INSERT INTO reservation(id, id_paiement, id_emplacement, id_suivi, id_activite, id_groupe, id_facilitateur, date_rendez_vous, heure_debut, heure_fin, id_etat) VALUES (4, 4, 4, 4, 2, 4, 1, '2020-02-24 07:00', 13, 14, 1);
INSERT INTO reservation(id, id_paiement, id_emplacement, id_suivi, id_activite, id_groupe, id_facilitateur, date_rendez_vous, heure_debut, heure_fin, id_etat) VALUES (5, 5, 5, 5, 3, 5, 2, '2020-02-29 09:30', 13, 14, 1);
INSERT INTO reservation(id, id_paiement, id_emplacement, id_suivi, id_activite, id_groupe, id_facilitateur, date_rendez_vous, heure_debut, heure_fin, id_etat) VALUES (6, 6, 6, 6, 1, 6, 1, '2020-03-01 19:30', 8, 9, 1);
INSERT INTO reservation(id, id_paiement, id_emplacement, id_suivi, id_activite, id_groupe, id_facilitateur, date_rendez_vous, heure_debut, heure_fin, id_etat) VALUES (7, 7, 7, 7, 4, 7, 2, '2019-03-11 12:30', 13, 14, 1);
INSERT INTO reservation(id, id_paiement, id_emplacement, id_suivi, id_activite, id_groupe, id_facilitateur, date_rendez_vous, heure_debut, heure_fin, id_etat) VALUES (8, 8, 8, 8, 1, 8, 3, '2020-03-15 09:30', 13, 14, 1);
INSERT INTO reservation(id, id_paiement, id_emplacement, id_suivi, id_activite, id_groupe, id_facilitateur, date_rendez_vous, heure_debut, heure_fin, id_etat) VALUES (9, 9, 9, 9, 2, 9, 1, '2020-03-20 10:00', 13, 14, 1);
INSERT INTO reservation(id, id_paiement, id_emplacement, id_suivi, id_activite, id_groupe, id_facilitateur, date_rendez_vous, heure_debut, heure_fin, id_etat) VALUES (10, 10, 10, 10, 3, 10, 2, '2020-03-24 11:30', 13, 14, 1);
INSERT INTO reservation(id, id_paiement, id_emplacement, id_suivi, id_activite, id_groupe, id_facilitateur, date_rendez_vous, heure_debut, heure_fin, id_etat) VALUES (11, 11, 11, 11, 1, 11, 1, '2020-03-24 17:00', 8, 9, 1);
INSERT INTO reservation(id, id_paiement, id_emplacement, id_suivi, id_activite, id_groupe, id_facilitateur, date_rendez_vous, heure_debut, heure_fin, id_etat) VALUES (12, 12, 12, 12, 5, 12, 2, '2019-04-02 13:30', 13, 14, 1);
INSERT INTO reservation(id, id_paiement, id_emplacement, id_suivi, id_activite, id_groupe, id_facilitateur, date_rendez_vous, heure_debut, heure_fin, id_etat) VALUES (13, 13, 13, 13, 6, 13, 3, '2020-04-12 06:00', 13, 14, 1);
INSERT INTO reservation(id, id_paiement, id_emplacement, id_suivi, id_activite, id_groupe, id_facilitateur, date_rendez_vous, heure_debut, heure_fin, id_etat) VALUES (14, 14, 14, 14, 2, 14, 1, '2019-04-15 14:30', 13, 14, 1);
INSERT INTO reservation(id, id_paiement, id_emplacement, id_suivi, id_activite, id_groupe, id_facilitateur, date_rendez_vous, heure_debut, heure_fin, id_etat) VALUES (15, 15, 15, 15, 3, 15, 2, '2020-04-15 15:40', 13, 14, 1);

/*
INSERT INTO reservation(id, id_paiement, id_emplacement, id_suivi, id_activite, id_groupe, id_facilitateur, date_rendez_vous, heure_debut, heure_fin) VALUES (6, 2, 1, 6, 1, 2, 2, '2020-02-02', 13, 14);
INSERT INTO reservation(id, id_paiement, id_emplacement, id_suivi, id_activite, id_groupe, id_facilitateur, date_rendez_vous, heure_debut, heure_fin) VALUES (7, 3, 2, 7, 1, 3, 3, '2020-02-02', 13, 14);
INSERT INTO reservation(id, id_paiement, id_emplacement, id_suivi, id_activite, id_groupe, id_facilitateur, date_rendez_vous, heure_debut, heure_fin) VALUES (8, 4, 2, 3, 2, 4, 1, '2020-02-02', 13, 14);
INSERT INTO reservation(id, id_paiement, id_emplacement, id_suivi, id_activite, id_groupe, id_facilitateur, date_rendez_vous, heure_debut, heure_fin) VALUES (9, 5, 2, 3, 3, 5, 2, '2020-02-02', 13, 14);
*/



INSERT INTO ta_specialite_utilisateur(id_specialite, id_utilisateur) VALUES (1, 1);



INSERT INTO ta_disponibilite_specialiste(id_specialiste, id_disponibilite) VALUES (1,1);
-- INSERT INTO ta_disponibilite_specialiste(id_specialiste, id_disponibilite) VALUES (1,2);
-- INSERT INTO ta_disponibilite_specialiste(id_specialiste, id_disponibilite) VALUES (2,3);
-- INSERT INTO ta_disponibilite_specialiste(id_specialiste, id_disponibilite) VALUES (2,4);
-- INSERT INTO ta_disponibilite_specialiste(id_specialiste, id_disponibilite) VALUES (3,5);
-- INSERT INTO ta_disponibilite_specialiste(id_specialiste, id_disponibilite) VALUES (3,6);

INSERT INTO ta_disponibilite_specialiste(id_specialiste, id_disponibilite) VALUES (1,7);
INSERT INTO ta_disponibilite_specialiste(id_specialiste, id_disponibilite) VALUES (1,8);
INSERT INTO ta_disponibilite_specialiste(id_specialiste, id_disponibilite) VALUES (2,9);
INSERT INTO ta_disponibilite_specialiste(id_specialiste, id_disponibilite) VALUES (2,10);
INSERT INTO ta_disponibilite_specialiste(id_specialiste, id_disponibilite) VALUES (2,11);
INSERT INTO ta_disponibilite_specialiste(id_specialiste, id_disponibilite) VALUES (1,12);
INSERT INTO ta_disponibilite_specialiste(id_specialiste, id_disponibilite) VALUES (1,13);
INSERT INTO ta_disponibilite_specialiste(id_specialiste, id_disponibilite) VALUES (1,14);
INSERT INTO ta_disponibilite_specialiste(id_specialiste, id_disponibilite) VALUES (1,15);
