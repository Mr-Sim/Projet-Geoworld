<?php
/**
 * Register page
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

if (isset($_POST['register'])){
    #Good
}
else{
    header('location:users.php');
}

?>

<form method="post" action="users.php">
     	<input type="text"  name="nom"    value="Nom"><br>
     	<input type="text"  name="prenom" value="Prénom"><br>
		<input type="text"  name="login"  value="Login"><br>
		<input type="text"  name="pwd"    value="Mot de passe"><br>
		Role :  <input type="radio" name="role"   value="user" checked> Utilisateur<br>
		        <input type="radio" name="role"   value="admin"> Administrateur<br>   

		        <input type="submit" name="addUser" value="Ajouter membre">
	</form>
