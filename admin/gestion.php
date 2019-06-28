<?php
include("verifAuth.php");
 
include("connection.php");

?>
<div style="text-align:center; margin-top:20px">
<form action="generate.php" method="post">
    Année : <input name="annee" type="text" size="4" maxlength="4">
    <input name="choix" type="hidden" value="conducteur">
    <select name="periode">
        <option value="m">Détails Mensuels</option>
        <option value="s">Détails hebdomadaires</option>
    </select>
    <input type="submit" value="Voir le bilan des conducteurs"/>

</form>

<br />
<br />

<form action="generate.php" method="post">
    Année : <input name="annee" type="text" size="4" maxlength="4">
    <input name="choix" type="hidden" value="navette">
    <select name="periode">
        <option value="m">Détails Mensuels</option>
        <option value="s">Détails hebdomadaires</option>
    </select>
    <input type="submit" value="Voir le bilan des navettes"/>

</form>

</div>

	