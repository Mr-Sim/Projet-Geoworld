<?php
/**
 * Home Page
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
<head>
	<meta charset="utf-8">
	<title>Geoworld</title>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="assets/library/jquery.maphilight.min.js"></script>
	<script type="text/javascript">$(function() {
		$('.map').maphilight({fade: false});
	});</script>
</head>


<?php  require_once 'header.php'; ?>
<?php
require_once 'inc/manager-db.php';

$pays=$_GET['pays'];?>

<center>
    <h1> <?php echo "$pays"; ?></h1><br>
</center>

<?php $infoPays=getInfoCountries($pays); ?>

<div class="container">
    <table class="table">
        <?php foreach($infoPays as $infos):?>
        <tr>
            <th>Continent</th>
            <td> <?php echo $infos->Continent ?></td>
            <?php if (isset($_SESSION['role']) && $_SESSION['role']=="professeur"):?>
            <a href="country-edit.php?pays=<?php echo $infos->id ?> ">Modifier les infos du pays</a>
            <?php endif;?>
        </tr>
        <tr>
            <th>Région</th>
            <td> <?php echo $infos->Region ?></td>
        </tr>
        <tr>
            <th>Superficie</th>
            <td> <?php echo $infos->SurfaceArea ?></td>
        </tr>
        <tr>
            <?php if ($infos->IndepYear != "") :?>
            <th>Année d'indépendance</th>
            <td> <?php echo $infos->IndepYear ?></td>
            <?php endif; ?>
        </tr>
        <tr>
            <th>Population</th>
            <td> <?php echo $infos->Population ?></td>
        </tr>
        <tr>
            <?php if ($infos->LifeExpectancy != "") :?>
            <th>Espérence de vie</th>
            <td> <?php echo $infos->LifeExpectancy ?></td>
            <?php endif; ?>
        </tr>
        <tr>
            <th>PNB</th>
            <td> <?php echo $infos->GNP ?></td>
        </tr>
        <tr>
            <?php if ($infos->GNPOld != "") :?>
            <th>Ancien PNB</th>
            <td> <?php echo $infos->GNPOld ?></td>
            <?php endif; ?>
        </tr>
        <tr>
            <th>Type de régime</th>
            <td> <?php echo $infos->GovernmentForm ?></td>
        </tr>
        <tr>
            <?php if ($infos->HeadOfState!=""):?>
            <th>Chef d'Etat</th>
            <td> <?php echo $infos->HeadOfState ?></td>
            <?php endif;?>
        </tr>
        <tr>
            <?php if ($infos->Capital!=""):?>
            <th>Capitale</th>
            <?php $capital=$infos->Capital;
            $cap=getCapital($capital);
            foreach($cap as $ncap):?>
                <td> <?php echo $ncap->Name;?></td>
            <?php endforeach;?>
            <?php endif;?>
        </tr>
        <?php endforeach;?>
    </table>
</div>
<?php foreach($infoPays as $infos){
    $idCountry=$infos->id;
    $continent=$infos->Continent;
    $infoCity=getCity($idCountry);
    $infoLanguage=getLanguage($idCountry);
    $continent=$infos->Continent;
}?>

<?php if ($continent!="Antarctica"):?>
<center>
    <h2> <?php echo "Langues de $pays";?> </h2></br>
</center>
<div class="container">
    <table class="table">
        <tr>
            <th>Langue</th>
            <th>Pourcentage</th>
            <th>Langue officiel</th>
            <?php if (isset($_SESSION['role']) && $_SESSION['role']=="professeur"):?>
            <th>Modifier</th>
            <?php endif;?>
        </tr>
        <?php foreach($infoLanguage as $language):?>
        <tr>
            <td> <?php echo $language->Name;?></td>
            <td> <?php echo $language->Percentage;?></td>
            <?php if ($language->IsOfficial=="T"):?>
            <td> <?php echo "Oui";?></td>
            <?php else:?>
            <td> <?php echo "Non";?></td>
            <?php endif;?>
            <?php if (isset($_SESSION['role']) && $_SESSION['role']=="professeur"):?>
            <td><a href="language-edit.php?pays=<?php echo $idCountry?>&amp;langage=<?php echo $language->id ?> ">MODIFIER</a></td>
            <?php endif;?>
        </tr>
        <?php endforeach;?>
    </table>
</div>
</br>
<center>
    <h2> <?php echo "Ville(s) de $pays";?> </h2></br>
</center>
<div class="container">
    <table class="table">
        <tr>
          <th>Nom</th>
          <th>Région</th>
          <th>Population</th>
          <?php if (isset($_SESSION['role']) && $_SESSION['role']=="professeur"):?>
          <th>Modifier<th>
          <?php endif;?>
        </tr>
        <?php foreach($infoCity as $city):?>
        <tr>
          <td> <?php echo $city->Name; ?></td>
          <?php if ($city->District!="–"):?>
          <td> <?php echo $city->District; ?></td>
          <?php else:?>
          <td> <?php echo "Aucune région"; ?></td>
          <?php endif;?>
          <td> <?php echo $city->Population; ?></td>
          <?php if (isset($_SESSION['role']) && $_SESSION['role']=="professeur"):?>
          <td><a href="city-edit.php?edit=<?php echo $city->id ?> ">MODIFIER</a></td>
          <?php endif;?>
        </tr>       
        <?php endforeach;?>
    </table>
</div>
<?php endif;?>
<?php
require_once 'javascripts.php';
require_once 'footer.php';
?>