<?php
/**
 * Classe Client. Enfant de Utilisateur.
 * Contient des méthodes Get et Set
 * pour tous les attributs
 * communs aux clients.
 *
 * Nom :         Client
 * Catégorie :   Classe
 * Auteur :      Maxime Lussier
 * Version :     1.0
 * Date de la dernière modification : 2019-09-29
 */

 class Client extends Utilisateur{

   function __construct($id, $nom, $prenom, $dateInscription,
                       $courriel, $dateNaissance, $telephone){
     parent::__construct($id, $nom, $prenom, $dateInscription
                        $courriel, $dateNaissance, $telephone);

   }
 }

 ?>
