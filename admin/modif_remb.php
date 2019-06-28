<?php
// include("verifAuth.php");

include('connection.php');


if(isset($_POST['action']) && $_POST['action'] == "maj")
{
    $id_ligne = $_POST['id_ligne'];

    mysql_query("UPDATE aeroport_ligne_resa SET remboursement = " . $_POST['remb'] . " WHERE id_ligne = " . $id_ligne);
    

    ?>

    <script type="text/javascript">

        var prix = opener.document.getElementById("<?php echo $_POST['id_affiche']; ?>");

        prix.innerHTML = "<?php echo $_POST['remb']; ?> €";

        self.close();

    </script>

    <?php

}
else
{
    // majoration navette à la demande
    $sql_1 = mysql_query("SELECT remboursement FROM aeroport_ligne_resa WHERE id_ligne = " . $_GET['id_ligne']) or die(mysql_error());
    $row_1 = mysql_fetch_assoc($sql_1);

    $mnt_a_rembourser = $row_1['remboursement'];

}

?>


<html>
<head>
    <title>Modification du prix d'une réservation</title>
</head>

<body>
    <form method="post" action="modif_remb.php">

        <p>


        <p>
            <label for="remb">Montant à rembourser : </label>
            <input type="text" name="remb" id="remb" value="<?php echo $mnt_a_rembourser; ?>" size="3" />
            €
        </p>


        <input type="hidden" name="action" value="maj" />
        <input type="hidden" name="id_ligne" value="<?php echo $_GET['id_ligne']; ?>" />
        <input type="hidden" name="id_affiche" value="<?php echo $_GET['id_affiche']; ?>" />
        <input type="submit" value="Modifier" />

    </form>

</body>


</html>