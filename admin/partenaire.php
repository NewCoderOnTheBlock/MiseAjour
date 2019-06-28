<?php
	include("verifAuth.php");
?>
<br />
<span style="text-align:center"><h2>Gestion des clients et partenaires</h2></span>
<br />

<?php
    include("connection.php");

    
    $sql = "SELECT * FROM aeroport_partenaire ORDER BY id_partner";

    $ret = mysql_query($sql);

    $nb = mysql_num_fields($ret);

    $tab_header = array();

    for($i = 0; $i < $nb; $i++)
    {
        $fn = mysql_field_name($ret, $i);
        $tab_header[] = array($fn, str_replace("_", " ", $fn));
    }


    function affiche_tab($type)
    {
        global $tab_header, $ret;
        
        $res = "<table style=\"collapse=collapse\" border=\"1\">
                <tr>
                    <th>Actions</th>";

        for($i = 1; $i < count($tab_header); $i++)
        {
            if($i != 2)
                $res .= "<th>" . $tab_header[$i][1] . "</th>";
        }
                   
        $res .= "</tr>";

        mysql_data_seek($ret, 0);

        while($row = mysql_fetch_row($ret))
        {
            if($row[2] == $type)
            {
                $res .= "<tr>";

                $res .= "<td style=\"text-align:center;\"><a href=\"partenaire_action.php?action=supprimer&amp;id=" . $row[0] . "\" onclick=\"return confirm('Etes-vous sûr de vouloir supprimer ?');\" style=\"text-decoration:none;\"><img src=\"images/poubelle.jpg\" alt=\"Supprimer\" style=\"cursor:pointer;border:none;\" /></a>
                <hr />
                <a href=\"index.php?p=16&amp;action=modifier&amp;type=" . $type . "&amp;id=" . $row[0] . "\" style=\"text-decoration:none;\"><img src=\"images/modifier.png\" alt=\"Modifier\" style=\"cursor:pointer;border:none;\" /></a>
                </td>";

                for($i = 1; $i < count($row); $i++)
                {
                    if($i == 3)
                        $res .= "<td><img src=\"../aeroport/images/" . $row[$i] . "\" alt=\"icone\" /></td>";
                    elseif($i == 1)
                        $res .= "<td><a href=\"" . $row[$i] . "\">" . $row[$i] . "</a></td>";
                    elseif($i != 2)
                        $res .= "<td>" . stripslashes($row[$i]) . "</td>";
                }

                $res .= "</tr>";
            }
        }


        $res .= "</table>";

        return $res;
    }
    
?>

<h3>Liste des partenaires</h3>

<br />
<a href="index.php?p=16&action=ajout&amp;type=partner">Ajouter un partenaire</a>
 - <a href="index.php?p=16&action=ajout&amp;type=client">Ajouter un client</a>
<br /><br />

<?php
    echo affiche_tab("partner");
?>

<br />
<h3>Liste des clients</h3>

<br />
<a href="index.php?p=16&action=ajout&amp;type=client">Ajouter un client</a>
<br /><br />

<?php
    echo affiche_tab("client");
?>

<br />
