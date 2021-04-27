<!DOCTYPE html>
<html lang="fr">
<?php
/**
 * Users edition page
 *S
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


if (isset($_GET['edit'])){
    //print_r($_GET);
    $idUser = $_GET['edit'];
    $user = getUser($idUser);
}
else{
    header('location:users.php');
}
$idUser = $idUser;
$user = getUser($idUser);
foreach ($user as $param):
    $nom=$param->Nom;
    $prenom=$param->Prenom;
    $login=$param->Login;
    $pwd=$param->Pwd;
    $role=$param->Role;
endforeach;

?>

<form method="post" action="users.php">
     	ID Utilisateur : <input readonly="readonly" type="text" id="idUser" name="iduser" value="<?php echo $idUser?>"><br>
        Nom :   <input type="text"  name="nom"    value="<?php echo $nom?>"><br>
     	Prenom :<input type="text"  name="prenom" value="<?php echo $prenom?>"><br>
		Login : <input type="text"  name="login"  value="<?php echo $login?>"><br>
		MDP :   <input type="text"  name="pwd"    value="<?php echo $pwd?>"><br>
		Role :  <input type="radio" name="role"   value="user" <?php if($role=='user'){echo'checked';}?>> Utilisateur<br>
		        <input type="radio" name="role"   value="admin" <?php if($role=='admin'){echo'checked';}?>> Administrateur<br>   

		        <input type="submit" name="update" value="update">
	</form>




