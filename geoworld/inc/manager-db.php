<?php
/**
 * Ce script est composé de fonctions d'exploitation des données
 * détenues pas le SGBDR MySQL utilisées par la logique de l'application.
 *
 * C'est le seul endroit dans l'application où a lieu la communication entre
 * la logique métier de l'application et les données en base de données, que
 * ce soit en lecture ou en écriture.
 *
 * PHP version 7
 *
 * @category  Database_Access_Function
 * @package   Application
 * @author    SIO-SLAM <sio@ldv-melun.org>
 * @copyright 2019-2021 SIO-SLAM
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      https://github.com/sio-melun/geoworld
 */

/**
 *  Les fonctions dépendent d'une connection à la base de données,
 *  cette fonction est déportée dans un autre script.
 */
 

/**
 * Obtenir la liste de tous les pays référencés d'un continent donné
 *
 * @param string $continent le nom d'un continent
 * 
 * @return array tableau d'objets (des pays)
 */

require_once('connect-db.php');

function getCountriesByContinent($continent)
{
    // pour utiliser la variable globale dans la fonction
    global $pdo;
    $query = 'SELECT * FROM Country WHERE Continent = :cont;';
    $prep = $pdo->prepare($query);
    // on associe ici (bind) le paramètre (:cont) de la req SQL,
    // avec la valeur reçue en paramètre de la fonction ($continent)
    // on prend soin de spécifier le type de la valeur (String) afin
    // de se prémunir d'injections SQL (des filtres seront appliqués)
    $prep->bindValue(':cont', $continent, PDO::PARAM_STR);
    $prep->execute();
    // var_dump($prep);  pour du debug
    // var_dump($continent);

    // on retourne un tableau d'objets (car spécifié dans connect-db.php)
    return $prep->fetchAll();
}

/**
 * Obtenir la liste des pays
 *
 * @return liste d'objets
 */
function getAllCountries()
{
    global $pdo;
    $query = 'SELECT * FROM Country;';
    return $pdo->query($query)->fetchAll();
}
/**
 * Obtenir la liste des continents
 * 
 * @return liste d'objets
 */
function getContinents()
{
    global $pdo;
    $query='SELECT DISTINCT Continent FROM country';
    try {       
        $result = $pdo->query($query)->fetchAll();
        return $result; 
    }    
    catch ( Exception $e ) {
        die("erreur dans la requete ".$e->getMessage());
    }
    $prep = $pdo->prepare($query);
    $prep->execute();
    return $prep->fetchAll();
}

/**
 * Obtenir la liste de tous les utilisateurs
 * 
 * @return liste d'objets
 */
function getAllUsers()
{
    global $pdo;
    $query='SELECT * FROM utilisateur';
    try {
        $result = $pdo->query($query)->fetchAll();
        return $result;
    }
    catch (Exeption $e) {
        die("erreur dans la requete ".$e->getMessage());
    }
    $prep = $pdo->prepare($query);
    $prep->execute();
    return $prep->fetchAll();
}

/**
 * Obtenir les paramètres d'un utilisateur précis
 * 
 * @return liste de paramètres d'un objet .
 */
function getUser($idUser)
{
    global $pdo;
    $query='SELECT * FROM utilisateur WHERE iduser = :id ;';
    try{
        $prep = $pdo->prepare($query);
        $prep->bindValue(':id', $idUser);
    }
    catch ( Exception $e ) {
        die ("erreur dans la requête ".$e->getMessage());
    }
    $prep = $pdo->prepare($query);
    $prep->bindValue(':id', $idUser);
    $prep->execute();
    return $prep->fetchAll();
}


/**
 * Supprimer un utilisateur
 * 
 * Envoie une requête SQL à la base de donnée pour supprimer l'utilisateur dont l'id correspond à celui entré en paramètre
 */
function deleteUser($idUser)
{
    global $pdo;
    $query='DELETE FROM utilisateur WHERE iduser = :id;';
    try {
        $prep = $pdo->prepare($query);
        $prep->bindValue(':id', $idUser);
        $prep->execute();
    }
    catch ( Exception $e ) {
        die ("erreur dans la requete ".$e->getMessage());
    }    
}


/**
 * Modifier un utilisateur
 * 
 * Récupère les paramètres entrées dans le formulaire de 'user-edit.php'
 * pour générer puis exécuter une requête de modification.
 */
function updateUser($params)
{
    global $pdo;
    $nom = $params['nom'];
    $prenom = $params['prenom'];
    $login = $params['login'];
    $pwd = $params['pwd'];
    $role = $params['role'];
    $idUser = $params['iduser'];
    $query = "UPDATE utilisateur SET Nom='$nom', Prenom='$prenom', Login='$login', Pwd='$pwd', Role='$role' WHERE iduser=$idUser;";
    try{
        $prep = $pdo->prepare($query);
        $prep->execute();
    }
    catch ( Exeption $e ) {
        die ("erreur dans la requête ".$e->getMessage());
    }
}function getAuthentification($login,$pwd){
    global $pdo;
    $query = "SELECT * FROM utilisateur where login=:login and pwd=:pwd";
    $prep = $pdo->prepare($query);
    $prep->bindValue(':login', $login);
    $prep->bindValue(':pwd', $pwd);
    $prep->execute();
    // on vérifie que la requête ne retourne qu'une seule ligne
    if($prep->rowCount() == 1){
    $result = $prep->fetch();
    return $result;
    }
    else
    return false;
   }