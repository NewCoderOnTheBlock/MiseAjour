<?php
	include("verifAuth.php");
    include("connection.php");


    if(isset($_GET['action']) && $_GET['action'] == "supprimer")
    {
        if(isset($_GET['id']))
            mysql_query("DELETE FROM aeroport_partenaire WHERE id_partner = " . intval($_GET['id'])) or die(mysql_error());

        header("Location: index.php?p=15");
        exit();
    }
    elseif(isset($_GET['action']) && $_GET['action'] == "modifier")
    {
        if(isset($_GET['id']))
        {
            $id = intval($_GET['id']);

            $sql = "SELECT * FROM aeroport_partenaire WHERE id_partner = " . $id;

            $ret = mysql_query($sql);

            $nb = mysql_num_rows($ret);

            $tab_header = array();

            $i = 0;
            $row = mysql_fetch_row($ret);

            for($i = 0; $i < count($row); $i++)
            {
                $fn = mysql_field_name($ret, $i);
                $tab_header[] = array($fn, str_replace("_", " ", $fn), $row[$i]);
            }

            if($_GET['type'] == "partner")
                $t_ajout = "partenaire";
            else
                $t_ajout = "client";

        ?>

            <br />
            <span style="text-align:center"><h2>Modification d'un <?php echo $t_ajout; ?></h2></span>
            <br />
            <span style="color:red;">Tous les champs sont obligatoires !</span>
            <br /><br />

            <form method="post" action="partenaire_action.php" enctype="multipart/form-data">

                <input type="hidden" name="form_action" value="act_modifier" />
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />

                <?php

                    echo "<table>";

                    for($i = 1; $i < count($tab_header); $i++)
                    {
                        if($i != 2)
                        {
                            echo '<tr>
                                       <td><label for="' . $tab_header[$i][0] . '">' . $tab_header[$i][1] . '</label></td>';

                            if($i == 3)
                                echo '<td><input type="file" name="' . $tab_header[$i][0] . '" id="' . $tab_header[$i][0] . '" value="' . stripslashes($tab_header[$i][2]) . '" /></td>';
                            elseif(!preg_match("/(.*)description(.*)/", $tab_header[$i][0]))
                                echo '<td><input type="text" size="50" name="' . $tab_header[$i][0] . '" id="' . $tab_header[$i][0] . '" value="' . stripslashes($tab_header[$i][2]) . '" /></td>';
                            else
                                echo '<td><textarea name="' . $tab_header[$i][0] . '" id="' . $tab_header[$i][0] . '" cols="50" rows="4">' . stripslashes($tab_header[$i][2]) . '</textarea></td>';

                           echo "</tr>";
                        }
                    }

                    echo "</table>";
                ?>

                <br />
                <label for="lst_type">Changer le type : </label>
                <select name="lst_type" id="lst_type">

                    <?php if($_GET['type'] == "partner")
                    {
                    ?>
                        <option value="partner" selected="selected">Partenaire</option>
                        <option value="client">Client</option>
                    <?php
                    }
                    else
                    {
                    ?>
                        <option value="client" selected="selected">Client</option>
                        <option value="partner">Partenaire</option>
                    <?php
                    }
                    ?>
                </select>

                <br />
                <br />
                <input type="submit" value="Modifier" />

            </form>

            <?php
        }
    }
    elseif(isset($_GET['action']) && $_GET['action'] == "ajout")
    {
        $sql = "SELECT * FROM aeroport_partenaire ORDER BY id_partner";

        $ret = mysql_query($sql);

        $nb = mysql_num_fields($ret);

        $tab_header = array();

        for($i = 0; $i < $nb; $i++)
        {
            $fn = mysql_field_name($ret, $i);
            $tab_header[] = array($fn, str_replace("_", " ", $fn));
        }

        if($_GET['type'] == "partner")
            $t_ajout = "partenaire";
        else
            $t_ajout = "client";

        ?>

            <br />
            <span style="text-align:center"><h2>Ajout d'un <?php echo $t_ajout; ?></h2></span>
            <br />
            <span style="color:red;">Tous les champs sont obligatoires !</span>
            <br /><br />

            <form method="post" action="partenaire_action.php" enctype="multipart/form-data">

                <input type="hidden" name="form_action" value="act_ajout" />
                <input type="hidden" name="type_ajout" value="<?php echo $_GET['type']; ?>" />

                <?php

                    echo "<table>";

                    for($i = 1; $i < count($tab_header); $i++)
                    {
                        if($i != 2)
                        {
                            echo '<tr>
                                       <td><label for="' . $tab_header[$i][0] . '">' . $tab_header[$i][1] . '</label></td>';

                            if($i == 3)
                                echo '<td><input type="file" name="' . $tab_header[$i][0] . '" id="' . $tab_header[$i][0] . '" /></td>';
                            elseif(!preg_match("/(.*)description(.*)/", $tab_header[$i][0]))
                                echo '<td><input type="text" size="50" name="' . $tab_header[$i][0] . '" id="' . $tab_header[$i][0] . '" /></td>';
                            else
                                echo '<td><textarea name="' . $tab_header[$i][0] . '" id="' . $tab_header[$i][0] . '" cols="50" rows="4"></textarea></td>';

                            echo '</tr>';
                        }
                    }

                    echo "</table>";
                ?>

                <br />
                <input type="submit" value="Créer" />

            </form>


        <?php
    }
    elseif(isset($_POST['form_action']))
    {
        if($_POST['form_action'] == "act_ajout")
        {
            if(isset($_FILES['nom_image']) && $_FILES['nom_image']['error'] == 0)
            {
                $infosfichier = pathinfo($_FILES['nom_image']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array(strtolower($extension_upload), $extensions_autorisees))
                {
                    $nom_image = basename($_FILES['nom_image']['name']);

                    move_uploaded_file($_FILES['nom_image']['tmp_name'], '../aeroport/images/' . $nom_image);

                    $sql = "SELECT * FROM aeroport_partenaire ORDER BY id_partner";

                    $ret = mysql_query($sql);

                    $nb = mysql_num_fields($ret);

                    $tab_header = array();

                    for($i = 0; $i < $nb; $i++)
                    {
                        $fn = mysql_field_name($ret, $i);
                        $tab_header[] = array($fn, str_replace("_", " ", $fn));
                    }

                    $sql = "INSERT INTO aeroport_partenaire VALUES
                            (''";

                    for($i = 1; $i < count($tab_header); $i++)
                    {
                        if($i == 3)
                            $sql .= ", '" . $nom_image . "'";
                        elseif($i != 2)
                            $sql .= ", '" . addslashes(htmlspecialchars($_POST[$tab_header[$i][0]])) . "'";
                        else
                            $sql .= ", '" . $_POST['type_ajout'] . "'";
                    }

                    $sql .= ")";

                    mysql_query($sql) or die(mysql_error());

                    header("Location: index.php?p=15");
                    exit();
                }
                else
                    exit("Extension d'image non autorisée !");
            }
            else
                exit("Il manque l'image !");
        }
        elseif($_POST['form_action'] == "act_modifier")
        {
            $modif_image = "";
            
            if(isset($_FILES['nom_image']) && $_FILES['nom_image']['error'] == 0)
            {
                $infosfichier = pathinfo($_FILES['nom_image']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array(strtolower($extension_upload), $extensions_autorisees))
                {
                    $nom_image = basename($_FILES['nom_image']['name']);

                    move_uploaded_file($_FILES['nom_image']['tmp_name'], '../aeroport/images/' . $nom_image);

                    $modif_image = $nom_image;
                }
                else
                    exit("Extension d'image non autorisée !");
            }


            $sql = "SELECT * FROM aeroport_partenaire ORDER BY id_partner";

            $ret = mysql_query($sql);

            $nb = mysql_num_fields($ret);

            $tab_header = array();

            for($i = 0; $i < $nb; $i++)
            {
                $fn = mysql_field_name($ret, $i);
                $tab_header[] = array($fn, str_replace("_", " ", $fn));
            }

            $sql = "UPDATE aeroport_partenaire SET type = '" . $_POST['lst_type'] . "'";

            for($i = 1; $i < count($tab_header); $i++)
            {
                if($i != 2 && $i != 3)
                    $sql .= ", " . $tab_header[$i][0] . " = '" . addslashes(htmlspecialchars($_POST[$tab_header[$i][0]])) . "'";
            }

            if($modif_image != '')
                $sql .= ", nom_image = '" . $modif_image . "'";

            $sql .= " WHERE id_partner = " . intval($_POST['id']);
            
            mysql_query($sql) or die(mysql_error());

            header("Location: index.php?p=15");
            exit();
        }
    }

   
?>