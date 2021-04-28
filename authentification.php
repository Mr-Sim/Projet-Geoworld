<?php  require_once 'header.php'; ?>
<html>
<style>
form {
  /* Uniquement centrer le formulaire sur la page */
  margin: 0 auto;
  width: 400px;
  /* Encadré pour voir les limites du formulaire */
  padding: 1em;
  border: 1px solid #CCC;
  border-radius: 1em;
}
input {
  font: 1em sans-serif;
  width: 300px;
  box-sizing: border-box;
  border: 1px solid #999;
}

</style>

<center>
<p> AUTHENTIFICATION <p>
<form action="login.php" method="post">
    Votre login : <input type="text" name="login"><br />
    Votre mot de passe : <input type="password" name="pwd"><br />
    <input type="submit" value="Connexion">
</form>
</center>