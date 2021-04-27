<?php
/**
 * Users pages
 *
 * PHP version 7
 *
 * @category  Page
 * @package   Application
 * @author    SIO-SLAM <sio@ldv-melun.org>
 * @copyright 2019-2021 SIO-SLAM
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      https://github.com/sio-melun/geoworld
 */

?>

<?php  
require_once('header.php');
require_once('inc/manager-db.php');

if(isset($_GET['delete'])){
    $idUser = $_GET['delete'];
    deleteUser($idUser);
}

if (isset($_POST['update'])){
    $params = $_POST;
    unset($params['update']);
    updateUser($params);
   
}

if (isset($_POST['addUser'])){
    $user = $_POST;
    addUser($user);

}
 $usersList = getAllUsers($pdo);
?>
<DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css" />
</head>



<center>
<form method="post" action="register.php">
	<input type="submit" name="register" value="Ajouter un Utilisateur">
</form>
<p>MODIFIER OU SUPPRIMER DES UTILISATEURS</p>
<table border="2">
    <th>ID</th>
    <th>NOM</th>
    <th>PRENOM</th>
    <th>LOGIN</th>
    <th>MOT DE PASSE</th>
    <th>ROLE</th>
    <th>MODIFIER</th> 
    <th>SUPPRIMER</th> 

<?php foreach ($usersList as $user): ?> 
    <tr> 
	
        <td><?php echo $user->iduser ?></td> 
        <td><?php echo $user->Nom ?></td> 
        <td><?php echo $user->Prenom ?></td>
        <td><?php echo $user->Login ?></td>
        <td><?php echo $user->Pwd ?></td>
        <td><?php echo $user->Role ?></td>
        <td><a href="users-edit.php?edit=<?php echo $user->iduser ?> ">MODIFIER</a></td> 
        <td><a href="users.php?delete=<?php echo $user->iduser ?>" onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?php echo $user->Nom ?> ?'));">SUPPRIMER</a></td> 
   
    </tr>
<?php endforeach ; ?>
 
</table>
</center>