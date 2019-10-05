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
nb_ligne INT NOT NULL,
FOREIGN KEY (id_type_question) REFERENCES type_question(id)
);

CREATE TABLE questionnaire_reservation (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nom_questionnaire  VARCHAR(100) NOT NULL
);

CREATE TABLE ta_questionnaire_reservation_question (
id_questionnaire_res INT NOT NULL,
id_question INT NOT NULL,

PRIMARY KEY (id_questionnaire_res, id_question),
FOREIGN KEY (id_questionnaire_res) REFERENCES questionnaire_reservation(id),
FOREIGN KEY (id_question) REFERENCES question(id)
);


CREATE TABLE type_activite (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nom VARCHAR(50) NOT NULL
);

CREATE TABLE activite (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_type_activite INT NOT NULL,
nom VARCHAR(100) NOT NULL,
description_breve VARCHAR(500) NOT NULL,
description_longue VARCHAR(1500) NOT NULL,
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


CREATE TABLE reservation (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_paiement INT NOT NULL,
id_emplacement INT NOT NULL,
id_suivi INT NOT NULL,
id_activite INT NOT NULL,
date_rendez_vous DATE NOT NULL,
heure_debut INT NOT NULL,
heure_fin INT NOT NULL,
FOREIGN KEY (id_paiement) REFERENCES paiement(id),
FOREIGN KEY (id_emplacement) REFERENCES emplacement(id),
FOREIGN KEY (id_suivi) REFERENCES suivi(id),
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
ville VARCHAR(100),
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


CREATE TABLE jour (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nom VARCHAR(15) NOT NULL
);

CREATE TABLE disponibilite (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_jour INT NOT NULL,
heure_debut date NOT NULL,
heure_fin date NOT NULL,
FOREIGN KEY (id_jour) REFERENCES jour(id)
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

FOREIGN KEY (id_type_utilisateur) REFERENCES type_utilisateur(id),
FOREIGN KEY (id_type_etat_dispo) REFERENCES type_etat_dispo(id),
FOREIGN KEY (fk_id_adresse) REFERENCES adresse(id)
);

ALTER TABLE compte_utilisateur
ADD FOREIGN KEY (fk_utilisateur) REFERENCES utilisateur(id);

CREATE TABLE inscription (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_utilisateur INT NOT NULL,
date_inscription date NOT NULL,
FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id)
);

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
id_inscription INT,
nom_entreprise VARCHAR(100) NOT NULL,
nom_organisateur VARCHAR(50) NOT NULL,
nb_participant INT NOT NULL,
FOREIGN KEY (id_type_groupe) REFERENCES type_groupe(id),
FOREIGN KEY (id_inscription) REFERENCES inscription(id)

);


INSERT INTO province(id, nom) VALUES (1, "Québec");
INSERT INTO province(id, nom) VALUES (2, "Ontario");
INSERT INTO province(id, nom) VALUES (3, "Nouvelle Écosse");
INSERT INTO province(id, nom) VALUES (4, "Nouveau Brunswick");

INSERT INTO ville(id, nom) VALUES (1, "Sherbrooke");
INSERT INTO ville(id, nom) VALUES (2, "Bromont");
INSERT INTO ville(id, nom) VALUES (3, "Montréal");
INSERT INTO ville(id, nom) VALUES (4, "Québec");

INSERT INTO adresse(id, id_province, ville, no_civique, rue, code_postal, pays) VALUES (1, 1, 'Sherbrooke', 454, "Terril", "J1J 1J1", "Canada");

INSERT INTO type_paiement(id, nom, description) VALUES (1, "Paypal", "Payer à l'aide de Paypal");

INSERT INTO paiement(id, id_type_paiement, montant, date_paiement) VALUES (1, 1, 45.25, '2019-01-01');
INSERT INTO paiement(id, id_type_paiement, montant, date_paiement) VALUES (2, 1, 50.00, '2019-05-13');
INSERT INTO paiement(id, id_type_paiement, montant, date_paiement) VALUES (3, 1, 25.00, '2019-06-21');

INSERT INTO type_emplacement(id, type_emplacement) VALUES (1, "Café");
INSERT INTO type_emplacement(id, type_emplacement) VALUES (2, "Maison");

INSERT INTO emplacement(id, id_type_emplacement, nom_lieu) VALUES (1, "1", "Le bon Café");
INSERT INTO emplacement(id, id_type_emplacement, nom_lieu) VALUES (2, "2", "Maison du client");

INSERT INTO suivi(id, fait, commentaire) VALUES (1, "Aujourd'hui, nous avons fait un message", "Je recommende de faire un massage thai lors de la prochaine rencontre");

INSERT INTO type_question(id, nom) VALUES (1, "Texte");
INSERT INTO type_question(id, nom) VALUES (2, "Case à chocher");

INSERT INTO question(id, id_type_question, question, nb_ligne) VALUES (1, 2, "Cocher cette case si vous avez deja fait du Yoga",1 );

INSERT INTO questionnaire_reservation(id, nom_questionnaire) VALUES (1, "Questionnaire médical");
INSERT INTO questionnaire_reservation(id, nom_questionnaire) VALUES (2, "Questionnaire Entrainement en équipe");

INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question) VALUES (1, 1);
INSERT INTO ta_questionnaire_reservation_question(id_questionnaire_res, id_question) VALUES (2, 1);

INSERT INTO type_activite(id, nom) VALUES (1, "En Atelier");
INSERT INTO type_activite(id, nom) VALUES (2, "Services à domicile");
INSERT INTO type_activite(id, nom) VALUES (3, "En En ligne");
INSERT INTO type_activite(id, nom) VALUES (4, "En groupe");


INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (1, 1, "Soins à domicile", "Pour apprendre à se détendre, respirer, prendre soin de soi, écouter son corps, guérir ses blessures et améliorer sa posture, nous offrons des services à domicile en kinésiologie-kinésithérapie, ostéopathie, orthothérapie massothérapie et aromathérapie.", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (2, 1, "Entraînement à domicile", "Pour prendre en main sa santé, cultiver un mode de vie sain, préparer son corps pour une discipline ou adopter une pratique adaptée à ses besoins, nous offrons des services d’accompagnement, de préparation physique et d’entraînement à domicile.", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (3, 1, "Habitudes de vies à domicile", "Pour être accompagné dans l’adoption d’un mode de vie adapté à ses besoins, être aligné avec notre alimentation, apprendre à manger et cuisiner sainement, nous offrons des services d’orientation des habitudes de vie et de création culinaires personnalisés à domicile.", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (4, 1, "Yoga et méditation à domicile", "Pour vivre des séances sur mesure, être accompagné dans l’intégration des asanas et de la méditation dans sa vie, développer une pratique sécuritaire et adaptée à ses besoins ou approfondir son expérience du yoga, nous offrons des séances individuelles et en groupe à domicile.", "LONGUE");

INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (5, 2, "L’Ennéagramme", "Pour prendre pleine possession de ses forces, mieux aborder ses défis, connaître la structure de sa \"personnalité\", mieux connaître la nature humaine, découvrir ses différentes intelligences, filtres de perception, motivations profondes, comportements typiques, mécanismes réactionnels. Nous offrons un atelier d’introduction d’une journée sur les différents types d'humains et de leur \"personnalité\".", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (6, 2, "Réflexion créative: Flow design", "Pour réellement s'aligner et s’engager vers la version la plus enrichissante de nous-même, pour renouveler sa façon d’évoluer, pour transcender des limitations qui nous empêchent d’avancer, pour utiliser tout son potentiel afin d’orienter sa propre vie, dans notre cursus de formation à l’Ennéagramme, nous offrons des séances individuelles et des ateliers d’une journée en groupe de flow design.", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (7, 2, "L’art de la facilitation", "Pour apprendre à tenir l’espace, développer un savoir-être avec nous-même et les autres, pour intégrer des notions de gestion de groupe et apprendre à diriger par l’écoute, nous offrons des ateliers d’une journée en groupe sur l’art de la facilitation.", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (8, 2, "Trouver sa voix", "Pour cultiver une expression authentique, apprendre à avoir confiance dans ses manifestations et son discours en public, pour explorer l’épanouissement que nous amène le chant et le travail vocal, nous offrons des ateliers d’une demi-journée en groupe sur trouver sa voix.", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (9, 2, "Art intuitif", "Pour explorer son potentiel créatif, apprendre à utiliser l’art pour s’exprimer, s’initier à de nouvelles façons de jouer, de s’amuser, de réfléchir, de et de se découvrir, nous offrons des ateliers d’une demi-journée en expression intuitive.", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (10, 2, "Mouvement intuitif", "Pour cultiver la fluidité corporelle, , découvrir de nouvelles façons de bouger, apprendre à méditer en mouvement et pour s’amuser en groupe, nous offrons des ateliers d’une demi-journée de mouvements intuitifs.", "LONGUE");

INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (11, 3, "Séances de Flow Design", "Pour réellement s'aligner et s’engager vers la version la plus enrichissante de nous-même, pour utiliser sa créativité afin d’établir des objectifs concrets pour évoluer, nous offrons une série de 8 rencontres à distance durant lesquels le flow design est utilisé pour se ramener à l’essentiel et poser des actions conscientes dans sa vie.", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (12, 3, "Orientation MPO", "Cette rencontre d'orientation permet de conscientiser ses besoins motivationnels, se positionner et de se rapprocher du contexte idéal dans lequel s'épanouir grâce à l’outil psychométrique MPO. Le test s'effectue en ligne en 20 minutes, la séance d'orientation dure 90 minutes en vidéoconférence", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (13, 3, "Mentorat", "Pour vous accompagner dans votre développement personnel, professionnel et spirituel, nous partageons des réflexions, pistes de solutions, pratiques personnelles, nouvelles expériences ainsi que de devoirs à accomplir dans des rencontres de 60 minutes en ligne. L’encadrement est adapté à vos besoins et inclu un suivi par courriel hebdomadaire.", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (14, 3, "Programmes d’entraînement", "Pour vous encadrer dans votre mode de vie actif, préparer votre corps pour une discipline sportive, prévenir vos blessures et adopter une pratique adaptée à vos besoins, nous offrons des services de préparation de programme sur mesure en ligne. la rencontre d’évaluation dure 30 minutes en ligne et la prescription du programme d’entraînement 90 minutes.", "LONGUE");

INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (15, 4, "COACHING PROFESSIONNEL", "Ces séances individuelles visent à orienter  chaque  membre de l’équipe à travers une pratique qui fait émerger et cultive un leadership authentique.", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (16, 4, "ATELIERS ET FACILITATION", "Nos ateliers visent à  intégrer des outils et des pratiques qui enrichissent les dynamiques personnelles et  interpersonnelles dans les équipes ", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (17, 4, "CONSOLIDATION EN PLEIN-AIR", "Nos défis d’équipe visent à tester et transformer les dynamiques d’équipe,  supportés par des outils psychométriques nous expérimentons des épreuves dans un environnement inconnu. ", "LONGUE");
INSERT INTO activite(id, id_type_activite, nom, description_breve, description_longue) VALUES (18, 4, "ENTRAÎNEMENTS EN ÉQUIPE", "Nos entraînements de groupe permettent de cultiver la dynamique d’équipe dans une atmosphère ludique et énergisante. Séances  privés au bureau et en plein-air..", "LONGUE");


INSERT INTO ta_activite_questionnaire_reservation(id_activite, id_questionnaire_res) VALUES (1, 1);

INSERT INTO duree(id, temps) VALUES (1, 1);
INSERT INTO duree(id, temps) VALUES (2, 2);
INSERT INTO duree(id, temps) VALUES (3, 3);
INSERT INTO duree(id, temps) VALUES (4, 4);

INSERT INTO ta_duree_activite(id_activite, id_duree) VALUES (1, 1);
INSERT INTO ta_duree_activite(id_activite, id_duree) VALUES (1, 3);
INSERT INTO ta_duree_activite(id_activite, id_duree) VALUES (2, 2);
INSERT INTO ta_duree_activite(id_activite, id_duree) VALUES (3, 1);
INSERT INTO ta_duree_activite(id_activite, id_duree) VALUES (3, 2);



INSERT INTO reservation(id, id_paiement, id_emplacement, id_suivi, id_activite, date_rendez_vous, heure_debut, heure_fin) VALUES (1, 1, 1, 1, 1, '2019-12-12', 8, 9);
INSERT INTO reservation(id, id_paiement, id_emplacement, id_suivi, id_activite, date_rendez_vous, heure_debut, heure_fin) VALUES (2, 2, 1, 1, 1, '2020-02-02', 13, 14);
INSERT INTO reservation(id, id_paiement, id_emplacement, id_suivi, id_activite, date_rendez_vous, heure_debut, heure_fin) VALUES (3, 3, 2, 1, 1, '2020-02-02', 13, 14);

INSERT INTO type_groupe(id, type_groupe) VALUES (1, "individuel");
INSERT INTO type_groupe(id, type_groupe) VALUES (2, "groupe");

INSERT INTO type_utilisateur(id, nom, description) VALUES (1, "Client", "Le client");
INSERT INTO type_utilisateur(id, nom, description) VALUES (2, "Facilitateur", "Un facilitateur");

INSERT INTO utilisateur(id_type_utilisateur, fk_id_adresse, nom, prenom, date_inscription) VALUES (1, 1, "Test", "Client", NOW());

INSERT INTO compte_utilisateur(fk_utilisateur, courriel, mot_de_passe) VALUES (1, "test@client.ca", "abc123");
/*INSERT INTO compte_utilisateur(fk_utilisateur, courriel, mot_de_passe) VALUES (2, "client", "client");
*/
INSERT INTO fichier_perso(id, fichier, description) VALUES (1, "abc123", "Fichier");

INSERT INTO questionnaire_remplit(id, fichier, description) VALUES (1, "abc123", "Fichier");

INSERT INTO profil(id, id_questionnaire_remplit, id_fichier_perso, test_psychometrique, parlez_nous_de_vous) VALUES (1, 1, 1, "BLOB", "Je suis quelqu'un de tr;s actif.");


INSERT INTO type_etat_dispo(id, etat_disponible) VALUES (1, "Disponible");
INSERT INTO type_etat_dispo(id, etat_disponible) VALUES (2, "Non Disponible");

INSERT INTO jour(id, nom) VALUES (1, "Lundi");
INSERT INTO jour(id, nom) VALUES (2, "Mardi");
INSERT INTO jour(id, nom) VALUES (3, "Mercredi");
INSERT INTO jour(id, nom) VALUES (4, "Jeudi");
INSERT INTO jour(id, nom) VALUES (5, "Vendredi");
INSERT INTO jour(id, nom) VALUES (6, "Samedi");
INSERT INTO jour(id, nom) VALUES (7, "Dimanche");

INSERT INTO disponibilite(id, id_jour, heure_debut, heure_fin) VALUES (1, 1, 9,10);
INSERT INTO disponibilite(id, id_jour, heure_debut, heure_fin) VALUES (2, 1, 13,14);
INSERT INTO disponibilite(id, id_jour, heure_debut, heure_fin) VALUES (3, 2, 9,10);
INSERT INTO disponibilite(id, id_jour, heure_debut, heure_fin) VALUES (4, 2, 19,20);
INSERT INTO disponibilite(id, id_jour, heure_debut, heure_fin) VALUES (5, 3, 10,11);
INSERT INTO disponibilite(id, id_jour, heure_debut, heure_fin) VALUES (6, 3, 12,13);


INSERT INTO inscription(id, id_utilisateur, date_inscription) VALUES (1, 1, '2020-02-22');


INSERT INTO specialite(id, nom) VALUES (1, "Meditation");

INSERT INTO ta_specialite_utilisateur(id_specialite, id_utilisateur) VALUES (1, 1);

INSERT INTO groupe(no_groupe, id_type_groupe, id_inscription, nom_entreprise, nom_organisateur, nb_participant) VALUES (1, 1, 1, "APPLE", "Steve Jobs", 45);

