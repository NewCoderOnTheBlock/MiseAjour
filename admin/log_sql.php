<?php
	include("verifAuth.php");
	require("connection.php");


function pagination($page, $nb_page, $nb = 4)
{
	$list_page = array();
	
	for ($i = 1; $i <= $nb_page; $i++)
	{
		if (($i < $nb) || ($i > $nb_page - $nb) || (($i < $page + $nb) && ($i > $page - $nb)))
			$list_page[] = $i;
		else
		{
			if ($i >= $nb && $i <= ($page - $nb))
				$i = $page - $nb;
			elseif ($i >= ($page + $nb) && $i <= ($nb_page - $nb))
				$i = $nb_page - $nb;
				
			$list_page[] = '...';
		}
	}
	
	return $list_page;
}


$date = mysql_query("SELECT DATE_FORMAT(date, '%d-%m-%Y à %Hh%im%ss') as date FROM aeroport_logs_sql WHERE id_log = (SELECT MIN(id_log) FROM aeroport_logs_sql)");
$date_r = mysql_fetch_assoc($date);
$date = $date_r['date'];

$nb_log = mysql_query("SELECT COUNT(id_log) AS nb FROM aeroport_logs_sql") or die(mysql_error());
$nb_r = mysql_fetch_assoc($nb_log);
$nb = $nb_r['nb'];

$nb_par_page = 30;
$nb_pages = ceil($nb / $nb_par_page);

$nb_pages = ($nb_pages == 0) ? 1 : $nb_pages;


$page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? intval($_GET['page']) : 1;

$page = ($page > $nb_pages) ? 1 : $page;

$fin = $nb - ($page - 1) * $nb_par_page; 
$deb = $fin - $nb_par_page + 1;

$p_courante = (isset($_GET['page'])) ? intval($_GET['page']) : 1;

$tab_pagination = pagination($p_courante, $nb_pages);


echo "<h2>Historique des requêtes d'insertions</h2>";

echo $nb . " requêtes trouvées depuis le " . $date . "<br /><br />";

$txt_page = "Page : ";

if($page > 1)
	$txt_page .= '<a href="index.php?p=9&amp;page=' . ($page - 1) . '">Précédente </a>';
	
foreach($tab_pagination as $pagge)
{
	if($pagge == $page)
		$txt_page .= '<span style="color:red;">' . $pagge . ' </span>';
	elseif($pagge == "...")
		$txt_page .= " ... ";
	else
		$txt_page .= '<a href="index.php?p=9&amp;page=' . $pagge . '">' . $pagge . '</a> ';
}


if($page < $nb_pages)
	$txt_page .= '<a href="index.php?p=9&amp;page=' . ($page + 1) . '">Suivante </a>';
	
$txt_page .= "<br /><br />";



$log = mysql_query("SELECT id_log, DATE_FORMAT(date, '%d-%m-%Y à %Hh%im%ss') as date, `sql`, ip_log
					FROM aeroport_logs_sql
					ORDER BY id_log DESC
					LIMIT ".(($page-1)*20).", 20") or die(mysql_error());
					
/*
	Affichage
*/
echo $txt_page;

echo "
<table width='100%'>
	<tr>
		<th width='15%'>Date</th>
		<th width='10%'>IP</th>
		<th width='75%'>Requête</th>
	</tr>";

while($r_log = mysql_fetch_assoc($log))
	echo "
	<tr>
		<td style='text-align:center;'>".$r_log['date']."</td>
		<td style='text-align:center;'>".$r_log['ip_log']."</td>
		<td style='font-size:10px;'>".$r_log['sql']."</td>
	</tr>";
	
echo "</table>";

echo $txt_page;

?>