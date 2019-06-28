<?php
  /**************************************************************************\
  * Phenix Agenda                                                            *
  * http://phenix.gapi.fr                                                    *
  * Written by    Stephane TEIL            <phenix-agenda@laposte.net>       *
  * Contributors  Christian AUDEON (Omega) <christian.audeon@gmail.com>      *
  *               Maxime CORMAU (MaxWho17) <maxwho17@free.fr>                *
  *               Mathieu RUE (Frognico)   <matt_rue@yahoo.fr>               *
  *               Bernard CHAIX (Berni69)  <ber123456@free.fr>               *
  * --------------------------------------------                             *
  *  This program is free software; you can redistribute it and/or modify it *
  *  under the terms of the GNU General Public License as published by the   *
  *  Free Software Foundation; either version 2 of the License, or (at your  *
  *  option) any later version.                                              *
  \**************************************************************************/

// Gestion des rapports d'erreurs
error_reporting (E_ALL ^ E_NOTICE);

if (!isset($_SERVER) && isset($HTTP_SERVER_VARS)) {
  $_POST   = $HTTP_POST_VARS;
  $_GET    = $HTTP_GET_VARS;
  $_FILES  = $HTTP_POST_FILES;
  $_SERVER = $HTTP_SERVER_VARS;
}

// ----------------------------------------------------------------------------
// Extraction des noms et des valeurs des variables passees en URL ou postees
// via un formulaire. Generation de variables globales.
// ----------------------------------------------------------------------------
function pxiExtract($array, &$target) {
  if (!is_array($array)) {
    return false;
  }
  $is_magic_quotes = get_magic_quotes_gpc();
  reset($array);
  while (list($key, $value) = each($array)) {
    if (is_array($value)) {
      pxiExtract($value, $target[$key]);
    } else if (!$is_magic_quotes) {
      $target[$key] = addslashes(trim(strip_tags($value)));
    } else {
      $target[$key] = trim(strip_tags($value));
    }
  }
  reset($array);
  return true;
}

function listeLangue($selectLangue) {
  // Recuperation des noms de langue directement dans les fichiers du repertoire "lang"
  $rep = opendir("../lang");
  while ($file = readdir($rep)) {
    if ($file!=".." && $file!="." && $file!="" && $file!="index.htm") {
      if (!is_dir("../lang/".$file) && $fd = @fopen("../lang/".$file, "r")) {
        while (!@feof($fd)) {
          $ligne = @fgets($fd);
          if (@strpos($ligne,"['COMMUN_NOM_LANGUE']")!==false) {
            $pos1 = @strpos($ligne,"\"");
            $pos2 = @strpos(substr($ligne,$pos1+1),"\"");
            break;
          }
        }
        $tabLangue[substr($file,0,@strpos($file,"."))] = @substr($ligne,$pos1+1,$pos2);
        fclose($fd);
      }
    }
  }
  closedir($rep);
  clearstatcache();
  $str = "";
  foreach ($tabLangue as $key=>$val) {
    $selected = ($selectLangue == $key) ? " selected" : "";
    $str .= "<OPTION value=\"".$key."\"".$selected.">".$val."</OPTION>";
  }
  return $str;
}

if (!empty($_GET)) {
  pxiExtract($_GET, $GLOBALS);
}

if (!empty($_POST)) {
  pxiExtract($_POST, $GLOBALS);
}

if (!empty($_FILES)) {
  while (list($name, $value) = each($_FILES)) {
    $$name = $value['tmp_name'];
    ${$name . '_name'} = $value['name'];
  }
}

// Langue d'affichage
if (!isset($inst_lang) || empty($inst_lang)) {
  $inst_lang = "fr";
}
include("./lang/$inst_lang.php");

/* Traduction d'un libelle */
function trad($libelle) {
  global $LG;
  if ($LG[$libelle]!="") return $LG[$libelle];
  else return "undefined";
}

function trad2($libelle,$index) {
  global $LG;
  if ($LG[$libelle][$index]!="") return $LG[$libelle][$index];
  else return "undefined";
}

$APPLI_VERSION_NEW = "5.51";

$NOM_PAGE = basename($_SERVER['PHP_SELF']);

$etape   += 0;
$update  += 0;
$config  += 0;
$backup  += 0;
$choix   += 0;

if ($choix==1)
  $etape=1;
else if ($choix==2)
  $update=1;
else if ($choix==3)
  $backup=1;

$file_param  = "../inc/param.inc.php";
$file_config  = "../inc/conf.inc.php";
$file_couleur =  "../inc/couleur.inc.php";
$file_calendarcss =  "../css/calendar_css.php";
$file_calendarjs =  "../inc/calendar.js";
$file_calendarsetup =  "../inc/calendar-setup.js.php";
$file_checkdatejs =  "../inc/checkdate.js.php";
$file_xtdump = "../inc/xtdump_cfg.inc.php";
$file_fonctions = "../inc/fonctions.inc.php";
$default_timezone="Europe/Paris";
?>
<!DOCTYPE html public "-//w3c//dtd html 4.0 transitional//en">
<HTML>
<HEAD>
  <META http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <META http-equiv="Cache-Control" content="no-cache">
  <META name="Author" content="<?php echo trad("INSTALL_COPYRIGHT"); ?>">
  <META name="robots" content="noindex">
  <TITLE><?php echo trad("INSTALL_TITRE_PAGE"); ?></TITLE>
  <STYLE type="text/css">
  <!--
    Body {
      font-family: Verdana, Arial, Tahoma;
      font-size : 12px;
      background-color : #FFFFFF;
      color : #000000;
      text-align : justify;
      margin-left : 20px;
      margin-right : 20px;
    }
    Table {
      font-family: Verdana, Arial, Tahoma;
      font-size : 12px;
      text-align : justify;
    }
    FORM {
      PADDING: 0px;
      MARGIN: 0px;
    }
    A {
      COLOR: #3333FF;
      TEXT-DECORATION: none;
    }
    A:link {
      COLOR: #3333FF;
      TEXT-DECORATION: none;
    }
    A:visited {
      COLOR: #3333FF;
      TEXT-DECORATION: none;
    }
    A:hover {
      COLOR: #3333FF;
      TEXT-DECORATION: underline;
    }
<?php if ($backup) { ?>
    .link {
      font: italic 8pt;
      font-family: verdana;
      TEXT-DECORATION: none;
      color: #000066
    }
    .link:hover {
      TEXT-DECORATION: underline
    }
    .texte {
      font: 8pt;
      font-family: verdana;
    }
    .form {
      font-family: verdana;
      font-size: 10px;
      font-weight: normal;
      color: #16246C;
      text-decoration: none;
      background-color: #FFFFFF;
      border-bottom-color: #666666;
      border-bottom-width: 1px;
      border-left-width: 1px;
      border-left-color: #666666;
      border-right-color: #666666;
      border-right-width: 1px;
      border-top-color: #666666;
      border-top-width: 1px;
    }
<?php } ?>
  -->
  </STYLE>
  <SCRIPT language="JavaScript" type="text/javascript">
  <!--
    //Barre de progression durant la creation des tables
    var w3c=(document.getElementById)?true:false;
    var ie=(document.all)?true:false;
    var N=-1;
    var progressBar;

    function afficheAttente() {
      var blocErreur = (ie)?document.all['msgErreur']:document.getElementById('msgErreur');
      blocErreur.style.display = "none";
      progressBar.showBar();
    }

    function CreateProgressBar(w,h,bgc,brdW,brdC,blkC,speed,blocks,count,action){
      if(ie||w3c){
        var t='<br><div id="_xpbar'+(++N)+'" style="display:none; position:relative; overflow:hidden;">';
        t+='<B><?php echo trad("INSTALL_TRAITEMENT"); ?></B>';
        t+='<div style=" position:relative; overflow:hidden; width:'+w+'px; height:'+h+'px; background-color:'+bgc+'; border-color:'+brdC+'; border-width:'+brdW+'px; border-style:solid; font-size:1px;">';
        t+='<span id="blocks'+N+'" style="left:-'+(h*2+1)+'px; position:absolute; font-size:1px">';
        for(i=0;i<blocks;i++){
          t+='<span style="background-color:'+blkC+'; left:-'+((h*i)+i)+'px; font-size:1px; position:absolute; width:'+h+'px; height:'+h+'px; '
          t+=(ie)?'filter:alpha(opacity='+(100-i*(100/blocks))+')':'-Moz-opacity:'+((100-i*(100/blocks))/100);
          t+='"></span>';
        }
        t+='</span></div></div>';
        document.write(t);
        var bA=(ie)?document.all['blocks'+N]:document.getElementById('blocks'+N);
        bA.bar=(ie)?document.all['_xpbar'+N]:document.getElementById('_xpbar'+N);
        bA.blocks=blocks;
        bA.N=N;
        bA.w=w;
        bA.h=h;
        bA.speed=speed;
        bA.ctr=0;
        bA.count=count;
        bA.action=action;
        bA.togglePause=togglePause;
        bA.showBar=function(){
          this.bar.style.display="block";
        }
        bA.hideBar=function(){
          this.bar.style.display="none";
        }
        bA.tid=setInterval('startBar('+N+')',speed);
        return bA;
      }
    }

    function startBar(bn){
      var t=(ie)?document.all['blocks'+bn]:document.getElementById('blocks'+bn);
      if(parseInt(t.style.left)+t.h+1-(t.blocks*t.h+t.blocks)>t.w){
        t.style.left=-(t.h*2+1)+'px';
        t.ctr++;
        if(t.ctr>=t.count){
          eval(t.action);
          t.ctr=0;
        }
      } else
        t.style.left=(parseInt(t.style.left)+t.h+1)+'px';
    }

    function togglePause(){
      if(this.tid==0){
        this.tid=setInterval('startBar('+this.N+')',this.speed);
      } else {
        clearInterval(this.tid);
        this.tid=0;
      }
    }
  //-->
  </SCRIPT>
</HEAD>

<BODY onLoad="window.focus();">
<?php
  echo "<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor=\"#06679F\" align=\"center\" width=\"100%\"><TR><TD>\n";
  echo "<TABLE cellspacing=2 cellpadding=5 border=0 width=\"100%\">\n";
  $piedPage  = "</TABLE></TD></TR></TABLE><TABLE border=0 cellspacing=0 cellpadding=0 width=\"100%\"><TR><TD align=\"right\"><A href=\"../index.php\" style=\"font-size:10px;\"><B>".sprintf(trad("INSTALL_LIEN_ACCUEIL"), ${APPLI_VERSION_NEW})."</B></A> || <A href=\"${NOM_PAGE}?inst_lang=".$inst_lang."\" style=\"font-size:10px;\"><B>".trad("INSTALL_LIEN_MENU_ADMIN")."</B></A></TD</TR></TABLE>\n";
  // Recuperation des noms de langue directement dans les fichiers du repertoire "lang"
  $rep = opendir("./lang");
  while ($file = readdir($rep)) {
    if ($file!=".." && $file!="." && $file!="" && $file!="index.htm") {
      if (!is_dir("./lang/".$file) && $fd = @fopen("./lang/".$file, "r")) {
        while (!@feof($fd)) {
          $ligne = @fgets($fd);
          if (@strpos($ligne,"['INSTALL_NOM_LANGUE']")!==false) {
            $pos1 = @strpos($ligne,"\"");
            $pos2 = @strpos(substr($ligne,$pos1+1),"\"");
            break;
          }
        }
        $tabLangue[substr($file,0,@strpos($file,"."))] = @substr($ligne,$pos1+1,$pos2);
        fclose($fd);
      }
    }
  }
  closedir($rep);
  clearstatcache();
  $piedPage .= "<TABLE bgcolor=\"#FFFFFF\" align=\"center\" border=0 cellspacing=2 cellpadding=2><TR><TD align=\"center\">".trad("INSTALL_LANG")."<br>";
  foreach ($tabLangue as $key=>$val) {
    $piedPage .= "<a href=\"install.php?inst_lang=".$key."\"><img src=\"../image/flags/".$key.".gif\" alt=\"".$val."\" border=\"0\" /> ".$val."</a>&nbsp;&nbsp;";
  }
  $piedPage .= "</TD></TR></TABLE><BR>\n";
  $piedPage .= ("<CENTER><FORM action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\" target=\"_blank\">
  <INPUT type=\"hidden\" name=\"cmd\" value=\"_s-xclick\">
  <INPUT type=\"image\" src=\"paypal.gif\" border=\"0\" name=\"submit\" title=\"".trad("INSTALL_PAYPAL")."\">
  <INPUT type=\"hidden\" name=\"hosted_button_id\" value=\"908608\">
</FORM><SCRIPT type=text/javascript> progressBar=CreateProgressBar(250,15,'white',1,'#06679F','#06679F',85,7,3,''); </SCRIPT></CENTER></BODY></HTML>");

if (!$etape && !$update && !$backup ) {
  echo "<TR><TD bgcolor=\"#D7DFE7\" align=\"center\">".sprintf(trad("INSTALL_TITRE"), ${APPLI_VERSION_NEW})."</TD></TR>\n";
  echo "<TR><TD bgcolor=\"#EFEFEF\"><BR>";

  echo "<TABLE align=\"center\" border=0 cellspacing=2 cellpadding=2 width=\"450\" bgcolor=\"red\">\n";
  echo "<TR><TD><FONT color=\"white\"><B>".trad("INSTALL_SECU")."</B></FONT></TD></TR>\n";
  echo "</TABLE><BR>\n";

  echo "<TABLE align=\"center\" border=0 cellspacing=2 cellpadding=2 width=\"450\" bgcolor=\"red\">\n";
  echo "<TR><TD><FONT color=\"white\"><B>".trad("INSTALL_SAVE")."</B></FONT></TD></TR>\n";
  echo "</TABLE><BR>\n";

  echo "<FORM method=\"post\" action=\"${NOM_PAGE}?inst_lang=".$inst_lang."\">\n";
  echo "<TABLE align=\"center\" border=0 cellspacing=2 cellpadding=2>\n";

  // On preselectionne la liste suivant si le fichier de config existe et/ou que la version differe
  $selected["Install"] = " selected";
  $selected["MAJ"] = "";
  $selected["SaveDB"] = "";
  $_GET['msg'] = 6; //Empeche la connexion a la base de donnees
  if (file_exists($file_config)) {
    include($file_config);
    if ($APPLI_VERSION!=$APPLI_VERSION_NEW) {
      $selected["Install"] = "";
      $selected["MAJ"] = " selected";
    } else {
      $selected["Install"] = "";
      $selected["SaveDB"] = " selected";
    }
  }
  echo "<TR><TD>".trad("INSTALL_QUESTION1")."</TD><TD><SELECT name=\"choix\"><OPTION value=\"1\"".$selected["Install"].">".trad("INSTALL_PHENIX")."</OPTION><OPTION value=\"2\"".$selected["MAJ"].">".trad("INSTALL_MAJ")."</OPTION><OPTION value=\"3\"".$selected["SaveDB"].">".trad("INSTALL_SAVE_DB")."</OPTION></SELECT></TD></TR>\n";
  echo "<TR><TD colspan=2 align=\"center\"><INPUT type=\"submit\" name=\"envoyer\" value=\"".trad("INSTALL_BT_VALIDER")."\"></TD></TR>\n";
  echo "</TABLE>\n";
  echo "</FORM>";

  echo "</TD></TR>\n";
}

//config 1
//Enregistrement des parametres de configuration (fin de creation ou de mise a jour)
elseif ($config==1) {
  if ($update) {
    echo "<TR><TD bgcolor=\"#D7DFE7\" align=\"center\"><B>".sprintf(trad("INSTALL_ETAPE"), 5)."</B><BR>".trad("INSTALL_TITRE5_MAJ_CFG")."</TD></TR>\n";
    echo "<TR><TD bgcolor=\"#EFEFEF\">";
  } elseif ($etape) {
    echo "<TR><TD bgcolor=\"#D7DFE7\" align=\"center\"><B>".sprintf(trad("INSTALL_ETAPE"), 4)."</B><BR>".trad("INSTALL_TITRE4_MAJ_CFG")."</TD></TR>\n";
    echo "<TR><TD bgcolor=\"#EFEFEF\">";
  }
  ($db = @mysql_connect($serveur, $utilisateur, $motdepasse)) or die("<IMG border=0 src=\"actionko.gif\"><FONT color=\"#ff0000\"><B>".trad("INSTALL_MAJCFG_CNXSRV")."</B>".trad("INSTALL_MAJCFG_ERRCNXSRV")."</FONT><BR><BR><CENTER><FORM method=\"post\" action=\"${NOM_PAGE}?inst_lang=".$inst_lang."&update=2&version=$version\"><INPUT type=\"submit\" name=\"envoyer\" value=\"".trad("INSTALL_RETOUR")."\"></FORM></CENTER><BR></TD></TR>".$piedPage);
  @mysql_select_db($nomdb,$db) or die("<IMG border=0 src=\"actionko.gif\"><FONT color=\"#ff0000\"><B>".trad("INSTALL_MAJCFG_CNXBDD")."</B>".trad("INSTALL_MAJCFG_ERRCNXBDD")."</FONT><BR><BR><CENTER><FORM method=\"post\" action=\"${NOM_PAGE}?inst_lang=".$inst_lang."&update=2&version=$version\"><INPUT type=\"submit\" name=\"envoyer\" value=\"".trad("INSTALL_RETOUR")."\"></FORM></CENTER><BR></TD></TR>".$piedPage);
  @mysql_query("SELECT COUNT(age_id) FROM ${prefix}agenda;") or die("<IMG border=0 src=\"actionko.gif\"><FONT color=\"#ff0000\"><B>".trad("INSTALL_MAJCFG_BDDPFX")."</B>".sprintf(trad("INSTALL_ERRPFX"), ${prefix}."agenda")."</FONT><BR><BR><CENTER><A href=\"${NOM_PAGE}?inst_lang=".$inst_lang."&update=2&version=$version\"><B>".trad("INSTALL_RETOUR")."</B></A></CENTER><BR></TD></TR>".$piedPage);

  // Mise a jour des notes existentes en fonction du fuseau horaire choisi
  if ($update && $version<550 && @include($file_fonctions)) {
    if ($version<500) {
      // Recuperation des infos du fuseau horaire selectionne
      $res = @mysql_query("SELECT tzn_gmt, tzn_date_ete, tzn_heure_ete, tzn_date_hiver, tzn_heure_hiver FROM ${prefix}timezone WHERE tzn_zone='".$timezone."';");
      $tzGmt = @mysql_result($res,0,"tzn_gmt");
      $tzDateEte = @mysql_result($res,0,"tzn_date_ete");
      $tzHeureEte = @mysql_result($res,0,"tzn_heure_ete");
      $tzDateHiver = @mysql_result($res,0,"tzn_date_hiver");
      $tzHeureHiver = @mysql_result($res,0,"tzn_heure_hiver");
      // Calcul du decalage et mise a jour des notes
      $res = @mysql_query("SELECT age_id, age_aty_id, age_date, age_heure_debut, age_heure_fin, age_date_creation, age_date_modif FROM ${prefix}agenda;");
      while ($enr = @mysql_fetch_array($res)) {
        list($enr['age_heure_debut'],$enr['age_heure_fin'],$enr['age_date_creation'],$enr['age_date_modif'],$enr['age_date']) = decaleNote($tzGmt,$tzDateEte,$tzHeureEte,$tzDateHiver,$tzHeureHiver,$dateJour,$enr['age_date'],$enr['age_heure_debut'],$enr['age_heure_fin'],$enr['age_date_creation'],$enr['age_date_modif'],1,1,1);
        // Mise a jour des dates et heures de notes (pour les anniversaires uniquement la date de creation)
        if ($enr['age_aty_id']!=1) {
          $res2 = @mysql_query("UPDATE ${prefix}agenda SET age_date='".$enr['age_date']."', age_heure_debut=".$enr['age_heure_debut'].", age_heure_fin=".$enr['age_heure_fin'].", age_date_creation='".$enr['age_date_creation']."', age_date_modif='".$enr['age_date_modif']."' WHERE age_id=".$enr['age_id'].";");
        } else {
          $res2 = @mysql_query("UPDATE ${prefix}agenda SET age_date_creation='".$enr['age_date_creation']."' WHERE age_id=".$enr['age_id'].";");
        }
      }
      // Enregistrement du timezone pour les utilisateurs existants
      @mysql_query("UPDATE ${prefix}utilisateur SET util_timezone='".$timezone."';");
    } else if ($version<550) {
      // Mise a jour des notes erronees pour appliquer un decalage horaire correct
      // On verifie la version
      $res = @mysql_query("SELECT valeur FROM ${prefix}configuration WHERE param='APPLI_VERSION';");
      $APPLI_VERSION_BASE = @mysql_result($res,0,0);
      if ($APPLI_VERSION_BASE=="5.00" || $APPLI_VERSION_BASE=="5.01") {
        // Recuperation des fuseaux de chaque utilisateur
        $res = @mysql_query("SELECT util_id, tzn_zone, tzn_gmt, tzn_date_ete, tzn_heure_ete, tzn_date_hiver, tzn_heure_hiver FROM ${prefix}utilisateur, ${prefix}timezone WHERE tzn_zone=util_timezone AND tzn_date_ete!='';");
        while ($enr = @mysql_fetch_array($res)) {
          $tabTzZone[$enr['util_id']] = $enr['tzn_zone'];
          $tabTzGmt[$enr['util_id']] = $enr['tzn_gmt'];
          $tabTzDateEte[$enr['util_id']] = $enr['tzn_date_ete'];
          $tabTzHeureEte[$enr['util_id']] = $enr['tzn_heure_ete'];
          $tabTzDateHiver[$enr['util_id']] = $enr['tzn_date_hiver'];
          $tabTzHeureHiver[$enr['util_id']] = $enr['tzn_heure_hiver'];
        }
        // On groupe par fuseau
        foreach (array_unique($tabTzZone) as $key=>$tzZone) {
          $idUtils = implode(",",array_keys($tabTzZone, $tzZone));
          // Recuperation des bornes de traitement
          $res = @mysql_query("SELECT DATE_FORMAT(MIN(age_date),'%Y'), DATE_FORMAT(MAX(age_date),'%Y') FROM ${prefix}agenda WHERE age_aty_id!=1 AND age_util_id IN (".$idUtils.");");
          $anneeMin = @mysql_result($res,0,0);
          $anneeMax = @mysql_result($res,0,1);
          // Traitement du re-decalage
          for ($annee=$anneeMin;$annee<=$anneeMax;$annee++) {
            // On exclu l'annee en cours qui est ok
            if ($annee!=gmdate("Y")) {
              // Calcul des dates de bascule pour chaque annee
              $tzEte = calculBasculeDST($tabTzDateEte[$key],$annee,$tabTzHeureEte[$key],$tzGmt,0);
              $tzHiver = calculBasculeDST($tabTzDateHiver[$key],$annee,$tabTzHeureHiver[$key],$tzGmt,1);
              if (!empty($tzEte) && !empty($tzHiver)) {
                // On choisi le test en fonction de l'hemisphere
                if ($tzHiver > $tzEte) {  // hemisphere nord
                  $where = "age_date>='".date("Y-m-d",$tzEte)."' AND age_date<'".date("Y-m-d",$tzHiver)."'";
                } else {  // hemisphere sud
                  $where = "(age_date>='".date("Y-m-d",$tzEte)."' OR age_date<'".date("Y-m-d",$tzHiver)."') AND DATE_FORMAT(age_date,'%Y')=".$annee;
                }
                // Recuperation des infos des notes concernees
                $res = @mysql_query("SELECT age_id, age_date, age_heure_debut, age_heure_fin, age_date_creation, age_date_modif FROM ${prefix}agenda WHERE ".$where." AND age_aty_id!=1 AND age_util_id IN (".$idUtils.");");
                $cnt=0;
                while ($enr=@mysql_fetch_array($res)) {
                  $cnt++;
                  $tabDate = explode("-",$enr['age_date']);
                  $enr['age_heure_debut'] -= 1;
                  $enr['age_heure_fin'] -= 1;
                  // Normalisation de la date et de l'heure de debut
                  if ($enr['age_heure_debut'] < 0) {
                    $enr['age_heure_debut'] += 24;
                    $enr['age_date'] = date("Y-m-d",mktime(12,0,0,$tabDate[1],$tabDate[2]-1,$tabDate[0]));
                  }
                  if ($enr['age_heure_debut'] >= 24) {
                    $enr['age_heure_debut'] -= 24;
                    $enr['age_date'] = date("Y-m-d",mktime(12,0,0,$tabDate[1],$tabDate[2]+1,$tabDate[0]));
                  }
                  // Normalisation de l'heure de fin
                  if ($enr['age_heure_fin'] <= 0) $enr['age_heure_fin'] += 24;
                  if ($enr['age_heure_fin'] > 24) $enr['age_heure_fin'] -= 24;
                  // Normalisation de l'heure de creation
                  $ageDateCrt = explode(" ",$enr['age_date_creation']);
                  if ($ageDateCrt[1]!="00:00:00") {
                    $dtCrt = explode("-",$ageDateCrt[0]);
                    $hrCrt = explode(":",$ageDateCrt[1]);
                    $enr['age_date_creation'] = date("Y-m-d H:i:s",mktime($hrCrt[0]-1,$hrCrt[1],$hrCrt[2],$dtCrt[1],$dtCrt[2],$dtCrt[0]));
                  }
                  // Normalisation de l'heure de modification
                  $ageDateMdf = explode(" ",$enr['age_date_modif']);
                  if ($ageDateMdf[1]!="00:00:00") {
                    $dtMdf = explode("-",$ageDateMdf[0]);
                    $hrMdf = explode(":",$ageDateMdf[1]);
                    $enr['age_date_modif'] = date("Y-m-d H:i:s",mktime($hrMdf[0]-1,$hrMdf[1],$hrMdf[2],$hrMdf[1],$hrMdf[2],$hrMdf[0]));
                  }
                  // Mise a jour des dates et heures de notes
                  $res2 = @mysql_query("UPDATE ${prefix}agenda SET age_date='".$enr['age_date']."', age_heure_debut=".$enr['age_heure_debut'].", age_heure_fin=".$enr['age_heure_fin'].", age_date_creation='".$enr['age_date_creation']."', age_date_modif='".$enr['age_date_modif']."' WHERE age_id=".$enr['age_id']);
                }
              }
            }
          }
        }
        // Optimisation de la table agenda
        @mysql_query("OPTIMIZE TABLE ${prefix}agenda;");
      }
    }
  }
  // Mise a jour de la langue par defaut
  @mysql_query("UPDATE ${prefix}configuration SET valeur='".$langue."' WHERE param='APPLI_LANGUE';");
  // Mise a jour du numero de version
  @mysql_query("UPDATE ${prefix}configuration SET valeur='".$APPLI_VERSION_NEW."' WHERE param='APPLI_VERSION';");

  //Test d'ouverture en ecriture du fichier de configuration
  ($fc=fopen($file_config,"w")) or die ("<IMG border=0 src=\"actionko.gif\"><FONT color=\"#ff0000\">".trad("INSTALL_MAJCFG_ERRFIC")."</FONT><BR>&nbsp;</TD></TR>".$piedPage);
  fputs($fc,"<?php\n");
  fputs($fc,"  /**************************************************************************\\\n");
  fputs($fc,"  * Phenix Agenda                                                            *\n");
  fputs($fc,"  * http://phenix.gapi.fr                                                    *\n");
  fputs($fc,"  * Written by    Stephane TEIL            <phenix-agenda@laposte.net>       *\n");
  fputs($fc,"  * Contributors  Christian AUDEON (Omega) <christian.audeon@gmail.com>      *\n");
  fputs($fc,"  *               Maxime CORMAU (MaxWho17) <maxwho17@free.fr>                *\n");
  fputs($fc,"  *               Mathieu RUE (Frognico)   <matt_rue@yahoo.fr>               *\n");
  fputs($fc,"  *               Bernard CHAIX (Berni69)  <ber123456@free.fr>               *\n");
  fputs($fc,"  * --------------------------------------------                             *\n");
  fputs($fc,"  *  This program is free software; you can redistribute it and/or modify it *\n");
  fputs($fc,"  *  under the terms of the GNU General Public License as published by the   *\n");
  fputs($fc,"  *  Free Software Foundation; either version 2 of the License, or (at your  *\n");
  fputs($fc,"  *  option) any later version.                                              *\n");
  fputs($fc,"  \**************************************************************************/\n\n");
  fputs($fc,"// ----------------------------------------------------------------------------\n");
  fputs($fc,"// ".trad("INSTALL_CONFIG_INC_LG17")."\n");
  fputs($fc,"// ----------------------------------------------------------------------------\n");
  fputs($fc,"  \$APPLI_VERSION = \"${APPLI_VERSION_NEW}\";\n");
  fputs($fc,"  \$APPLI_LANGUE  = \"$langue\"; // ".trad("INSTALL_CONFIG_INC_LG20")."\n\n");
  fputs($fc,"// ----------------------------------------------------------------------------\n");
  fputs($fc,"// ".trad("INSTALL_CONFIG_INC_LG23")."\n");
  fputs($fc,"// ----------------------------------------------------------------------------\n");
  fputs($fc,"  \$cfgHote       = \"".$serveur."\"; // ".trad("INSTALL_CONFIG_INC_LG25")."\n");
  fputs($fc,"  \$cfgUser       = \"".$utilisateur."\"; // ".trad("INSTALL_CONFIG_INC_LG26")."\n");
  fputs($fc,"  \$cfgPass       = \"".$motdepasse."\"; // ".trad("INSTALL_CONFIG_INC_LG27")."\n");
  fputs($fc,"  \$cfgBase       = \"".$nomdb."\"; // ".trad("INSTALL_CONFIG_INC_LG28")."\n");
  fputs($fc,"  \$PREFIX_TABLE  = \"".$prefix."\"; // ".trad("INSTALL_CONFIG_INC_LG29")."\n");
  fputs($fc,"  \$CHEMIN_ABSOLU = ".$cheminabsolu.";\n");
  if ($cheminabsolu=="true") {
    $path_file_class = realpath("../inc/db_class.inc.php");
    $path_file_class = str_replace("\\","/",$path_file_class);
  } else {
    $path_file_class="inc/db_class.inc.php";
  }
  fputs($fc,"  if (\$_GET['msg']!=\"6\") {\n    // ".trad("INSTALL_CONFIG_INC_LG32")."\n");
  fputs($fc,"    include(\"".$path_file_class."\");\n");
  fputs($fc,"  }\n\n");
  fputs($fc,"  define(\"_CONF_INC_LOADED\",true);\n");
  fputs($fc,"?>");
  fclose($fc);

  //etape 4
  //Fin de l'installation
  if ($etape==4) {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_MAJCFG2_OK"), "<B>conf.inc.php</B>")."<BR><BR>\n";
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".trad("INSTALL_TERMINEE")."<BR><BR>\n";
    echo "<IMG border=0 src=\"actionwarning.gif\" alt=\"\" align=\"left\" vspace=\"10\" hspace=\"0\">".trad("INSTALL_FIN_INF")."<BR><BR>\n";
  }
  //update 5
  //Fin de la mise a jour
  elseif ($update==5) {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_MAJCFG2_OK"), "<B>conf.inc.php</B>")."<BR><BR>\n";
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_MAJ_VER_OK"), ${APPLI_VERSION_NEW})."<BR><BR>\n";
  }
  // Info pour se connecter avec un compte administrateur pour mettre a jour les parametres de configuration
  if ($version < 500) {
    if ($UtilAdmin or $AdminUtil)
      echo "<IMG border=0 src=\"actionwarning.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_MOD_TOTAL_MODIF"), $UtilAdmin, $AdminUtil)."<BR><BR>";
    else
      echo "<IMG border=0 src=\"actionwarning.gif\" alt=\"\" align=\"left\" vspace=\"10\" hspace=\"0\">".trad("INSTALL_MOD_TOTAL")."<BR><BR>";
  }
  // Info de securite
  echo "<BR><TABLE align=\"center\" border=0 cellspacing=2 cellpadding=2 width=\"400\" bgcolor=\"red\">\n";
  echo "<TR><TD><FONT color=\"white\"><B>".trad("INSTALL_SECU")."</B></FONT></TD></TR>\n";
  echo "</TABLE><BR><BR>\n";
  // S'il existe un utilisateur admin/admin on le connecte, sinon affichage de la page d'accueil de Phenix
  $res = @mysql_query("SELECT util_id FROM ${prefix}utilisateur WHERE util_login='admin' AND util_passwd='".md5('admin')."';");
  if (@mysql_num_rows($res)) {
    $infoLogin = "../phenix.php?ztLogin=admin&ztPasswdMD5=".md5('admin')."&fromInstall=1";
  } else {
    $infoLogin = "../index.php";
  }
  echo "<CENTER><FORM method=\"post\" action=\"".$infoLogin."\">\n";
  echo "<INPUT type=\"submit\" name=\"envoyer\" value=\"".trad("INSTALL_CONTINUER")."\">\n";
  echo "</FORM></CENTER>";
  echo "</TD></TR>\n";
}

//update 1
//Choix de la version actuelle de Phenix
elseif ($update==1) {
  echo "<TR><TD bgcolor=\"#D7DFE7\" align=\"center\"><B>".sprintf(trad("INSTALL_ETAPE"), 1)."</B><BR>".trad("INSTALL_MAJVER_TITRE1")."</TD></TR>\n";
  echo "<TR><TD bgcolor=\"#EFEFEF\">";

  // Preselection de la version actuelle
  // Initialisation du tableau
  $tabVersions = array(
  array(100,"1.0 ".trad("INSTALL_MAJVER_OU")." 1.1"),
  array(120,"1.2 ".trad("INSTALL_MAJVER_OU")." 1.2a"),
  array(122,"1.2b"),
  array(123,"1.2c ".trad("INSTALL_MAJVER_OU")." 1.2d"),
  array(130,"1.3 ".trad("INSTALL_MAJVER_OU")." 1.3a"),
  array(140,"1.4"),
  array(150,"1.5"),
  array(160,"1.6 ".trad("INSTALL_MAJVER_OU")." 1.6a"),
  array(200,"2.0"),
  array(210,"2.1"),
  array(220,"2.2"),
  array(300,"3.0 ".trad("INSTALL_MAJVER_OU")." 3.0a ".trad("INSTALL_MAJVER_OU")." 3.0b"),
  array(350,"3.5 ".trad("INSTALL_MAJVER_OU")." 3.5a ".trad("INSTALL_MAJVER_OU")." 3.5b"),
  array(400,"4.0"),
  array(450,"4.5 ".trad("INSTALL_MAJVER_OU")." 4.5a"),
  array(500,"5.00 ".trad("INSTALL_MAJVER_OU")." 5.01"),
  array(550,"5.50"));

  $_GET['msg'] = 6; //Empeche la connexion a la base de donnees
  if (@include($file_config)) {
    $version = preg_replace(array("/\./","'([a-iA-I])'e"),array("","ord(strtolower('\\1'))-96"),$APPLI_VERSION);
    if ($version<100) {
      $version *= 10;
    }
  }
  echo "<FORM method=\"post\" action=\"${NOM_PAGE}?inst_lang=".$inst_lang."&update=2\">\n";
  echo "<TABLE align=\"center\" border=0 cellspacing=2 cellpadding=2>\n";
  echo "<TR><TD>".trad("INSTALL_MAJVER_QUESTION1")."</TD><TD><SELECT name=\"version\">";
  // Recherche de la version
  foreach($tabVersions as $k => $v1) {
    $sel = ($version>=$tabVersions[$k][0]) ? " selected" : "";
    echo "<OPTION value=\"".$tabVersions[$k][0]."\"".$sel.">".$tabVersions[$k][1]."</OPTION>";
  }
  echo "</SELECT></TD></TR>\n";
  echo "<TR><TD colspan=2 align=\"center\"><INPUT type=\"submit\" name=\"envoyer\" value=\"".trad("INSTALL_BT_VALIDER")."\"></TD></TR>\n";
  echo "</TABLE>\n";
  echo "</FORM>";

  echo "</TD></TR>\n";
}

//update 2
//Informations de connexion a la base de donnees
elseif ($update==2) {
  echo "<TR><TD bgcolor=\"#D7DFE7\" align=\"center\"><B>".sprintf(trad("INSTALL_ETAPE"), 2)."</B><BR>".trad("INSTALL_MAJVER_TITRE2")."</TD></TR>\n";
  echo "<TR><TD bgcolor=\"#EFEFEF\">";

  $_GET['msg'] = 6; //Empeche la connexion a la base de donnees
  if (!@include($file_config)) {
    $cfgHote = "localhost";
    $cfgBase = "phenix";
  }

  echo "<FORM method=\"post\" action=\"${NOM_PAGE}?inst_lang=".$inst_lang."&update=3\">\n";
  echo "<TABLE align=\"center\" border=0 cellspacing=2 cellpadding=2>\n";
  echo "<INPUT type=\"hidden\" name=\"version\" value=\"$version\">\n";
  echo "<TR><TD>".trad("INSTALL_MAJCFG_SRVMYSQL")."</TD><TD><INPUT type=\"text\" name=\"serveur\" size=\"30\" value=\"$cfgHote\"></TD><TD><I>".trad("INSTALL_INFO_CONFIG")."</I></TD></TR>\n";
  echo "<TR><TD nowrap>".trad("INSTALL_MAJCFG_BDD")."</TD><TD><INPUT type=\"text\" name=\"nomdb\" size=\"30\" value=\"$cfgBase\"></TD><TD></TD></TR>\n";
  echo "<TR><TD>".trad("INSTALL_MAJCFG_BDDUSER")."</TD><TD><INPUT type=\"text\" name=\"utilisateur\" size=\"30\" value=\"$cfgUser\"></TD><TD></TD></TR>\n";
  echo "<TR><TD>".trad("INSTALL_MAJCFG_BDDMDP")."</TD><TD><INPUT type=\"password\" name=\"motdepasse\" size=\"30\" value=\"$cfgPass\"></TD><TD></TD></TR>\n";
  echo "<TR valign=\"top\"><TD>".trad("INSTALL_MAJCFG_BDDPFX")."</TD><TD><INPUT type=\"text\" name=\"prefix\" size=\"30\" value=\"${PREFIX_TABLE}\"></TD><TD><I>".trad("INSTALL_INFO_CONFIG1")."</I></TD></TR>\n";
  echo "<TR><TD colspan=3 align=\"center\"><BR><INPUT type=\"submit\" name=\"envoyer\" value=\"".trad("INSTALL_BT_VALIDER")."\" onclick=\"javascript: progressBar.showBar();\"></TD></TR>\n";
  echo "</TABLE>\n";
  echo "</FORM><BR>";

  echo "</TD></TR>\n";
}

//update 3
//Application des mises a jour sur la base de donnees
elseif ($update==3) {
  echo "<TR><TD bgcolor=\"#D7DFE7\" align=\"center\"><B>".sprintf(trad("INSTALL_ETAPE"), 3)."</B><BR>".trad("INSTALL_MAJBDD_TITRE1")."</TD></TR>\n";
  echo "<TR><TD bgcolor=\"#EFEFEF\">";

  echo trad("INSTALL_SERVEUR")." : <B>$serveur</B><BR>".trad("INSTALL_BDD")." : <B>$nomdb</B><BR>".trad("INSTALL_USER")." : <B>$utilisateur</B><BR>".trad("INSTALL_MAJCFG_BDDPFX")." : <B>$prefix</B><BR><BR>";
  ($db = @mysql_connect($serveur, $utilisateur, $motdepasse)) or die("<IMG border=0 src=\"actionko.gif\"><FONT color=\"#ff0000\"><B>".trad("INSTALL_MAJCFG_CNXSRV")."</B>".trad("INSTALL_MAJCFG_ERRCNXSRV")."</FONT><BR><BR><CENTER><FORM method=\"post\" action=\"${NOM_PAGE}?inst_lang=".$inst_lang."&update=2&version=$version\"><INPUT type=\"submit\" name=\"envoyer\" value=\"".trad("INSTALL_RETOUR")."\"></FORM></CENTER><BR></TD></TR>".$piedPage);
  echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".trad("INSTALL_MAJCFG_CNXSRV")."<BR>";
  @mysql_select_db($nomdb,$db) or die("<IMG border=0 src=\"actionko.gif\"><FONT color=\"#ff0000\"><B>".trad("INSTALL_MAJCFG_CNXBDD")."</B>".trad("INSTALL_MAJCFG_ERRCNXBDD")."</FONT><BR><BR><CENTER><FORM method=\"post\" action=\"${NOM_PAGE}?inst_lang=".$inst_lang."&update=2&version=$version\"><INPUT type=\"submit\" name=\"envoyer\" value=\"".trad("INSTALL_RETOUR")."\"></FORM></CENTER><BR></TD></TR>".$piedPage);
  echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".trad("INSTALL_MAJCFG_CNXBDD")."<BR>";
  //Requete de test pour le prefixe
  @mysql_query("SELECT COUNT(age_id) FROM ${prefix}agenda;") or die("<IMG border=0 src=\"actionko.gif\"><FONT color=\"#ff0000\"><B>".trad("INSTALL_MAJCFG_BDDPFX")."</B>".sprintf(trad("INSTALL_ERRPFX"), ${prefix}."agenda")."</FONT><BR><BR><CENTER><FORM method=\"post\" action=\"${NOM_PAGE}?inst_lang=".$inst_lang."&update=2&version=$version\"><INPUT type=\"submit\" name=\"envoyer\" value=\"".trad("INSTALL_RETOUR")."\"></FORM></CENTER><BR></TD></TR>".$piedPage);
  echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".trad("INSTALL_MAJCFG_BDDPFX")."<BR>";

  if ($version<120) {
    @mysql_query("CREATE TABLE ${prefix}calepin (
      cal_id int(11) NOT NULL auto_increment,
      cal_societe varchar(50) NOT NULL default '',
      cal_nom varchar(50) NOT NULL default '',
      cal_prenom varchar(30) NOT NULL default '',
      cal_adresse text NOT NULL,
      cal_cp varchar(5) NOT NULL default '',
      cal_ville varchar(100) NOT NULL default '',
      cal_pays varchar(100) NOT NULL default '',
      cal_domicile varchar(20) NOT NULL default '',
      cal_travail varchar(20) NOT NULL default '',
      cal_portable varchar(20) NOT NULL default '',
      cal_fax varchar(20) NOT NULL default '',
      cal_email varchar(50) NOT NULL default '',
      cal_icq int(10) unsigned NOT NULL default '0',
      cal_util_id smallint(5) unsigned NOT NULL default '0',
      PRIMARY KEY  (cal_id),
      KEY cal_nom (cal_nom),
      KEY cal_util_id (cal_util_id)
    );");
  }
  if ($version<122) {
    @mysql_query("ALTER TABLE ${prefix}calepin ADD cal_icq INT UNSIGNED NOT NULL AFTER cal_email;");
    @mysql_query("ALTER TABLE ${prefix}calepin ADD cal_adresse TEXT NOT NULL AFTER cal_prenom;");
    @mysql_query("UPDATE ${prefix}calepin SET cal_adresse = TRIM(CONCAT(cal_rue,'\\\n',cal_complement));");
    @mysql_query("ALTER TABLE ${prefix}calepin DROP cal_rue;");
    @mysql_query("ALTER TABLE ${prefix}calepin DROP cal_complement;");
  }
  if ($version<123) {
    @mysql_query("ALTER TABLE ${prefix}calepin ADD cal_pays VARCHAR(100) NOT NULL AFTER cal_ville;");
  }
  if ($version<130) {
    @mysql_query("ALTER TABLE ${prefix}calepin CHANGE cal_id cal_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;");
    @mysql_query("CREATE TABLE ${prefix}calepin_groupe (
      cgr_id int(10) unsigned NOT NULL auto_increment,
      cgr_pere_id int(10) unsigned NOT NULL default '0',
      cgr_util_id smallint(5) unsigned NOT NULL default '0',
      cgr_nom varchar(150) NOT NULL default '',
      PRIMARY KEY (cgr_id),
      KEY cgr_pere_id (cgr_pere_id),
      KEY cgr_util_id (cgr_util_id)
    );");
    @mysql_query("CREATE TABLE ${prefix}calepin_appartient (
      cap_cal_id int(10) unsigned NOT NULL default '0',
      cap_cgr_id int(10) unsigned NOT NULL default '0',
      KEY cap_cal_id (cap_cal_id),
      KEY cap_cgr_id (cap_cgr_id)
    );");
    @mysql_query("INSERT INTO ${prefix}calepin_groupe (cgr_util_id, cgr_nom) SELECT util_id, '".trad("INSTALL_NON_CLASSE")."' FROM ${prefix}utilisateur;");
    @mysql_query("INSERT INTO ${prefix}calepin_appartient (cap_cal_id, cap_cgr_id) SELECT cal_id, cgr_id FROM ${prefix}calepin, ${prefix}calepin_groupe WHERE cal_util_id=cgr_util_id;");
  }
  if ($version<140) {
    @mysql_query("ALTER TABLE ${prefix}calepin ADD cal_partage ENUM('O','N') DEFAULT 'N' NOT NULL;");
    @mysql_query("ALTER TABLE ${prefix}calepin ADD INDEX (cal_partage);");
  }
  if ($version<150) {
    @mysql_query("ALTER TABLE ${prefix}calepin ADD cal_note TEXT NOT NULL;");
    @mysql_query("CREATE TABLE ${prefix}memo (
      mem_id int(10) unsigned NOT NULL auto_increment,
      mem_titre varchar(255) NOT NULL default '',
      mem_contenu text NOT NULL,
      mem_util_id smallint(5) unsigned NOT NULL default '0',
      PRIMARY KEY (mem_id),
      KEY mem_util_id (mem_util_id)
    );");
  }
  if ($version<160) {
    @mysql_query("ALTER TABLE ${prefix}calepin CHANGE cal_cp cal_cp VARCHAR(10) NOT NULL;");
    @mysql_query("ALTER TABLE ${prefix}utilisateur ADD util_telephone_vf ENUM('O','N') DEFAULT 'O' NOT NULL;");
    @mysql_query("ALTER TABLE ${prefix}calepin ADD cal_date_naissance DATE;");
    @mysql_query("ALTER TABLE ${prefix}calepin ADD cal_aim VARCHAR(50) NOT NULL , ADD cal_msn VARCHAR(50) NOT NULL;");
  }
  if ($version<200) {
    @mysql_query("ALTER TABLE ${prefix}utilisateur ADD util_planning TINYINT UNSIGNED DEFAULT '0' NOT NULL;");
    @mysql_query("ALTER TABLE ${prefix}calepin ADD cal_emailpro VARCHAR(50) NOT NULL;");
  }
  if ($version<210) {
    @mysql_query("ALTER TABLE ${prefix}sid ADD sid_util_subst_id SMALLINT UNSIGNED DEFAULT '0' NOT NULL;");
    @mysql_query("CREATE TABLE ${prefix}partage_planning (
      ppl_util_id smallint(5) unsigned NOT NULL default '0',
      ppl_consultant_id smallint(5) unsigned NOT NULL default '0',
      PRIMARY KEY (ppl_util_id, ppl_consultant_id)
    );");
    @mysql_query("INSERT INTO ${prefix}partage_planning (ppl_util_id, ppl_consultant_id) SELECT util_id, util_id FROM ${prefix}utilisateur;");
    @mysql_query("ALTER TABLE ${prefix}utilisateur ADD util_partage_planning ENUM('0','1','2') DEFAULT '0' NOT NULL , ADD util_email VARCHAR(50) NOT NULL , ADD util_autorise_affect ENUM('0','1','2') DEFAULT '0' NOT NULL , ADD util_alert_affect ENUM('O','N') DEFAULT 'N' NOT NULL;");
    @mysql_query("UPDATE ${prefix}utilisateur SET util_autorise_affect='1';");
    @mysql_query("ALTER TABLE ${prefix}agenda ADD age_email TINYINT UNSIGNED DEFAULT '0' NOT NULL;");
    @mysql_query("ALTER TABLE ${prefix}calepin ADD cal_yahoo VARCHAR(50) NOT NULL AFTER cal_msn;");
  }
  if ($version<220) {
    @mysql_query("ALTER TABLE ${prefix}agenda ADD age_prive TINYINT UNSIGNED DEFAULT '0' NOT NULL;");
    @mysql_query("ALTER TABLE ${prefix}agenda ADD age_couleur VARCHAR(20) NOT NULL;");
    @mysql_query("CREATE TABLE ${prefix}libelle (
      lib_id int(10) unsigned NOT NULL auto_increment,
      lib_nom varchar(255) NOT NULL default '',
      lib_util_id smallint(5) unsigned NOT NULL default '0',
      PRIMARY KEY (lib_id),
      KEY lib_util_id (lib_util_id)
    );");
    @mysql_query("ALTER TABLE ${prefix}utilisateur ADD util_precision_planning ENUM('1','2') DEFAULT '1' NOT NULL;");
  }
  if ($version<300) {
    @mysql_query("ALTER TABLE ${prefix}partage_planning RENAME ${prefix}planning_partage;");
    @mysql_query("CREATE TABLE ${prefix}planning_affecte (
      paf_util_id smallint(5) unsigned NOT NULL default '0',
      paf_consultant_id smallint(5) unsigned NOT NULL default '0',
      PRIMARY KEY (paf_util_id, paf_consultant_id)
    );");
    @mysql_query("ALTER TABLE ${prefix}utilisateur CHANGE util_autorise_affect util_autorise_affect ENUM('0','1','2','3') DEFAULT '0' NOT NULL;");
    @mysql_query("INSERT INTO ${prefix}planning_affecte (paf_util_id, paf_consultant_id) SELECT ppl_util_id, ppl_consultant_id FROM ${prefix}planning_partage, ${prefix}utilisateur WHERE util_autorise_affect='2' AND ppl_util_id=util_id;");
    @mysql_query("UPDATE ${prefix}agenda SET age_periode2=1 WHERE age_ape_id=3;");
    @mysql_query("ALTER TABLE ${prefix}utilisateur ADD util_semaine_type VARCHAR(7) DEFAULT '1111111' NOT NULL;");
    @mysql_query("ALTER TABLE ${prefix}sid ADD sid_semaine_type VARCHAR(7) DEFAULT '1111111' NOT NULL;");
    @mysql_query("ALTER TABLE ${prefix}agenda ADD age_nb_participant INT UNSIGNED DEFAULT '1' NOT NULL;");
    $res = @mysql_query("SELECT aco_age_id, count(aco_util_id) AS nbPart FROM ${prefix}agenda_concerne GROUP BY aco_age_id;");
    while ($enr=@mysql_fetch_array($res)) {
      if ($enr['nbPart']>1)
        $res2 = @mysql_query("UPDATE ${prefix}agenda SET age_nb_participant=".$enr['nbPart']." WHERE age_id=".$enr['aco_age_id'].";");
    }
    @mysql_query("ALTER TABLE ${prefix}utilisateur ADD util_duree_note ENUM('1','2','3','4') DEFAULT '1' NOT NULL;");
    @mysql_query("ALTER TABLE ${prefix}agenda ADD age_createur_id SMALLINT(5) UNSIGNED NOT NULL;");
    @mysql_query("UPDATE ${prefix}agenda SET age_createur_id=age_util_id;");
    @mysql_query("UPDATE ${prefix}agenda SET age_date=CONCAT('2004',SUBSTRING(age_date,5)) WHERE age_aty_id=1;");
    @mysql_query("ALTER TABLE ${prefix}utilisateur ADD util_rappel_delai TINYINT(3) UNSIGNED DEFAULT '0' NOT NULL, ADD util_rappel_type SMALLINT(5) UNSIGNED DEFAULT '1' NOT NULL, ADD util_rappel_email TINYINT(3) UNSIGNED DEFAULT '0' NOT NULL;");
    @mysql_query("ALTER TABLE ${prefix}agenda ADD age_disponibilite TINYINT(3) UNSIGNED DEFAULT '0' NOT NULL;");
    @mysql_query("ALTER TABLE ${prefix}agenda ADD INDEX (age_date);");
  }
  if ($version<350) {
    @mysql_query("ALTER TABLE ${prefix}libelle ADD lib_duree FLOAT(10,2) DEFAULT '0.25' NOT NULL AFTER lib_nom, ADD lib_couleur VARCHAR(20) NOT NULL AFTER lib_duree;");
    @mysql_query("CREATE TABLE ${prefix}favoris (
      fav_id int(10) unsigned NOT NULL auto_increment,
      fav_nom varchar(255) NOT NULL default '',
      fav_url text NOT NULL,
      fav_commentaire text NOT NULL,
      fav_util_id smallint(5) unsigned NOT NULL default '0',
      PRIMARY KEY (fav_id),
      KEY fav_util_id (fav_util_id)
    );");
    $res = @mysql_query("SELECT util_id, util_debut_journee, util_fin_journee FROM ${prefix}utilisateur;");
    while ($enr=@mysql_fetch_array($res)) {
      $res2 = @mysql_query("UPDATE ${prefix}agenda SET age_heure_debut=".$enr['util_debut_journee'].", age_heure_fin=".$enr['util_fin_journee']." WHERE age_aty_id=3 AND age_util_id=".$enr['util_id'].";");
    }
    @mysql_query("ALTER TABLE ${prefix}sid ADD sid_filtre_couleur VARCHAR(20) DEFAULT 'ALL' NOT NULL;");
  }
  if ($version<400) {
    @mysql_query("ALTER TABLE ${prefix}agenda ADD age_date_creation DATETIME NOT NULL;");
    @mysql_query("UPDATE ${prefix}agenda SET age_date_creation=age_date WHERE age_date_creation='0000-00-00 00:00:00' OR age_date_creation IS NULL;");
    @mysql_query("ALTER TABLE ${prefix}calepin CHANGE cal_date_naissance cal_date_naissance DATE NOT NULL;");
    @mysql_query("ALTER TABLE ${prefix}utilisateur ADD util_format_nom ENUM( '0', '1' ) DEFAULT '0' NOT NULL;");
    @mysql_query("ALTER TABLE ${prefix}utilisateur ADD util_menu_dispo ENUM( '8', '9' ) DEFAULT '8' NOT NULL;");
    @mysql_query("UPDATE ${prefix}agenda SET age_periode4=1 WHERE age_ape_id=4 AND age_periode4=0;");
    @mysql_query("ALTER TABLE ${prefix}utilisateur ADD util_url_export VARCHAR( 32 ) NOT NULL;");
    @mysql_query("ALTER TABLE ${prefix}agenda CHANGE age_periode3 age_periode3 INT( 7 ) UNSIGNED NOT NULL DEFAULT '0';");
    $res = @mysql_query("SELECT util_id, util_semaine_type FROM ${prefix}utilisateur;");
    while ($enr=@mysql_fetch_array($res)) {
      $res2 = @mysql_query("UPDATE ${prefix}agenda SET age_periode3=".($enr['util_semaine_type']+0)." WHERE age_aty_id IN (2,3) AND age_ape_id=2 AND age_periode1=3 AND age_createur_id=".$enr['util_id'].";");
    }
  }
  if ($version<450) {
    // Le champ age_periode2 est desormais utilise pour stocker la semaine type a la place de age_periode3
    @mysql_query("ALTER TABLE ${prefix}agenda CHANGE age_periode2 age_periode2 INT( 7 ) UNSIGNED NOT NULL DEFAULT '0';");
    // Dans la periodicite hebdomadaire, age_periode1 contient desormais $ztH et age_periode2 la semaine type au format PHP a la place d'un simple jour de la semaine
    $res = @mysql_query("SELECT age_id, age_periode1, age_periode2 FROM ${prefix}agenda WHERE age_aty_id IN (2,3) AND age_ape_id=3;");
    while ($enr=@mysql_fetch_array($res)) {
      switch ($enr['age_periode1']) {
        case 0 : $semaineType = 1000000; break;
        case 1 : $semaineType = 100000; break;
        case 2 : $semaineType = 10000; break;
        case 3 : $semaineType = 1000; break;
        case 4 : $semaineType = 100; break;
        case 5 : $semaineType = 10; break;
        default : $semaineType = 1; break;
      }
      $res2 = @mysql_query("UPDATE ${prefix}agenda SET age_periode1=".$enr['age_periode2'].", age_periode2=".$semaineType." WHERE age_id=".$enr['age_id'].";");
    }
    // Periodicite (quotidienne - semaine type) desormais geree par la periodicite hebdomadaire
    @mysql_query("UPDATE ${prefix}agenda SET age_ape_id=3, age_periode1=1, age_periode2=age_periode3, age_periode3=0 WHERE age_aty_id IN (2,3) AND age_ape_id=2 AND age_periode1=3;");
    // age_periode2 a 0 dans le cas d'une periodicite (quotidienne - tous les jours ouvrables)
    @mysql_query("UPDATE ${prefix}agenda SET age_periode2=0 WHERE age_aty_id IN (2,3) AND age_ape_id=2 AND age_periode1=2;");
    // Le champ age_periode3 n'est plus utilise pour stocker la semaine type, c'est desormais le age_periode2
    @mysql_query("ALTER TABLE ${prefix}agenda CHANGE age_periode3 age_periode3 TINYINT( 3 ) UNSIGNED NOT NULL DEFAULT '0';");
    // Champ util_note_barree pour enregistrer si l'utilisateur a choisi ou non de faire afficher les notes barrees lorsqu'elles sont terminees (barrees par defaut)
    @mysql_query("ALTER TABLE ${prefix}utilisateur ADD util_note_barree ENUM( 'O', 'N' ) DEFAULT 'O' NOT NULL ;");
    // Champ age_lieu pour ajouter une information sur l'emplacement d'une note
    @mysql_query("ALTER TABLE ${prefix}agenda ADD age_lieu VARCHAR( 230 ) NOT NULL;");
    // Champ fav_partage pour le partage des favoris
    @mysql_query("ALTER TABLE ${prefix}favoris ADD fav_partage ENUM( 'O', 'N' ) NOT NULL DEFAULT 'N';");
    // Champ lib_partage pour le partage des libelles
    @mysql_query("ALTER TABLE ${prefix}libelle ADD lib_partage ENUM( 'O', 'N' ) NOT NULL DEFAULT 'N';");
    // Nouvelle table pour afficher des evenements personnalises dans les plannings et calendriers (exemple vacances scolaires, fetes nationales...)
    @mysql_query("CREATE TABLE ${prefix}evenement (
      eve_id int(10) unsigned NOT NULL auto_increment,
      eve_date_debut date NOT NULL default '0000-00-00',
      eve_date_fin date NOT NULL default '0000-00-00',
      eve_libelle varchar(100) NOT NULL default '',
      eve_type smallint(5) unsigned NOT NULL default '1',
      eve_couleur varchar(20) NOT NULL default '',
      eve_util_id smallint(5) unsigned NOT NULL default '0',
      eve_partage enum('O','N') NOT NULL default 'N',
      PRIMARY KEY (eve_id),
      KEY eve_util_id (eve_util_id),
      KEY eve_date_debut (eve_date_debut),
      KEY eve_date_fin (eve_date_fin)
    );");
    // Champ age_cal_id pour associer un contact a une note
    @mysql_query("ALTER TABLE ${prefix}agenda ADD age_cal_id INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';");
    @mysql_query("ALTER TABLE ${prefix}agenda ADD INDEX ( age_cal_id );");
    // Champ cal_siteweb pour enregistrer un site web avec un contact
    @mysql_query("ALTER TABLE ${prefix}calepin ADD cal_siteweb VARCHAR( 255 ) NOT NULL;");
    // Correction de certaines fetes erronees
    @mysql_query("UPDATE ${prefix}fetes SET fet_nom='Herbert' WHERE fet_mois=3 AND fet_jour=20;");
    @mysql_query("UPDATE ${prefix}fetes SET fet_nom='Cl&eacute;mence - PRINTEMPS' WHERE fet_mois=3 AND fet_jour=21;");
    @mysql_query("UPDATE ${prefix}fetes SET fet_nom='Rodolph - ETE - F&ecirc;te de la musique' WHERE fet_mois=6 AND fet_jour=21;");
    @mysql_query("UPDATE ${prefix}fetes SET fet_nom='Constant - AUTOMNE' WHERE fet_mois=9 AND fet_jour=23;");
    @mysql_query("UPDATE ${prefix}fetes SET fet_nom='Pierre Canisus' WHERE fet_mois=12 AND fet_jour=21;");
    @mysql_query("UPDATE ${prefix}fetes SET fet_nom='Fran&ccedil;oise Xavi&egrave;re - HIVERS' WHERE fet_mois=12 AND fet_jour=22;");
  }
  if ($version<500) {
    // Possibilite d'avoir des rappels pour les anniversaires (y compris des contacts)
    @mysql_query("ALTER TABLE ${prefix}agenda_concerne CHANGE aco_rappel_ok aco_rappel_ok SMALLINT( 4 ) UNSIGNED NOT NULL DEFAULT '0';");
    @mysql_query("ALTER TABLE ${prefix}utilisateur ADD util_rappel_anniv TINYINT( 3 ) UNSIGNED NOT NULL DEFAULT '0', ADD util_rappel_anniv_coeff SMALLINT( 4 ) UNSIGNED NOT NULL DEFAULT '1440', ADD util_rappel_anniv_email TINYINT( 3 ) UNSIGNED NOT NULL DEFAULT '0';");
    @mysql_query("ALTER TABLE ${prefix}calepin ADD cal_rappel_ok SMALLINT( 4 ) UNSIGNED NOT NULL DEFAULT '0';");
    @mysql_query("ALTER TABLE ${prefix}information CHANGE info_age_id info_age_id INT( 11 ) NULL DEFAULT NULL;");
    // Choix de la langue dans le profil
    @mysql_query("ALTER TABLE ${prefix}utilisateur ADD util_langue VARCHAR( 10 ) NOT NULL DEFAULT 'fr';");
    // Possibilite d'envoyer le rappel d'une note a un contact associe (si son mail est renseigne)
    @mysql_query("ALTER TABLE ${prefix}agenda ADD age_email_contact TINYINT( 3 ) UNSIGNED NOT NULL DEFAULT '0';");
    // Classement des favoris en groupe
    @mysql_query("CREATE TABLE ${prefix}favoris_groupe (
      fgr_id int(10) unsigned NOT NULL auto_increment,
      fgr_util_id smallint(5) unsigned NOT NULL default '0',
      fgr_nom varchar(150) NOT NULL default '',
      PRIMARY KEY (fgr_id),
      KEY fgr_util_id (fgr_util_id)
    );");
    @mysql_query("ALTER TABLE ${prefix}favoris ADD fav_fgr_id INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';");
    @mysql_query("INSERT INTO ${prefix}favoris_groupe (fgr_util_id, fgr_nom) SELECT util_id, '".trad("INSTALL_NON_CLASSE")."' FROM ${prefix}utilisateur;");
    $res = @mysql_query("SELECT fgr_id, fgr_util_id FROM ${prefix}favoris_groupe;");
    while ($enr=@mysql_fetch_array($res)) {
      $res2 = @mysql_query("UPDATE ${prefix}favoris SET fav_fgr_id=".$enr['fgr_id']." WHERE fav_util_id=".$enr['fgr_util_id'].";");
    }
    // Enregistrement du nom du skin plutot que son index
    @mysql_query("ALTER TABLE ${prefix}utilisateur CHANGE util_interface util_interface VARCHAR( 32 ) NOT NULL DEFAULT 'Petrole';");
    @mysql_query("UPDATE ${prefix}utilisateur SET util_interface='Bleue' WHERE util_interface='0';");
    @mysql_query("UPDATE ${prefix}utilisateur SET util_interface='Grise' WHERE util_interface='1';");
    @mysql_query("UPDATE ${prefix}utilisateur SET util_interface='Pastel' WHERE util_interface='2';");
    @mysql_query("UPDATE ${prefix}utilisateur SET util_interface='Violine' WHERE util_interface='3';");
    @mysql_query("UPDATE ${prefix}utilisateur SET util_interface='Petrole' WHERE util_interface='4';");
    @mysql_query("UPDATE ${prefix}utilisateur SET util_interface='Nature' WHERE util_interface='5';");
    @mysql_query("UPDATE ${prefix}utilisateur SET util_interface='Automne' WHERE util_interface='6';");
    @mysql_query("UPDATE ${prefix}utilisateur SET util_interface='Anthracite' WHERE util_interface='7';");
    // Possibilite de reporter les alertes par popup
    @mysql_query("ALTER TABLE ${prefix}information ADD info_heure_rappel INT( 10 ) UNSIGNED NOT NULL DEFAULT '0';");
    // Gestion des TimeZone
    @mysql_query("ALTER TABLE ${prefix}utilisateur ADD util_timezone VARCHAR( 40 ) NOT NULL DEFAULT '".$default_timezone."';");
    @mysql_query("ALTER TABLE ${prefix}utilisateur ADD util_timezone_partage ENUM( 'O', 'N' ) NOT NULL DEFAULT 'O';");
    @mysql_query("ALTER TABLE ${prefix}utilisateur ADD util_format_heure ENUM( '12', '24' ) NOT NULL DEFAULT '24';");
    @mysql_query("CREATE TABLE ${prefix}timezone (
      tzn_zone varchar(40) NOT NULL default '',
      tzn_libelle varchar(50) NOT NULL default '',
      tzn_gmt float(10,2) NOT NULL default '0.00',
      tzn_regle varchar(12) NOT NULL default '',
      tzn_date_ete varchar(12) NOT NULL default '',
      tzn_heure_ete varchar(6) NOT NULL default '',
      tzn_date_hiver varchar(12) NOT NULL default '',
      tzn_heure_hiver varchar(6) NOT NULL default '',
      PRIMARY KEY  (tzn_zone)
    );");
    $res = @mysql_query("SELECT tzn_libelle FROM ${prefix}timezone  LIMIT 1;");
    if (!@mysql_num_rows($res)) {
      for ($i=0; $i<count($LG['INSTALL_TIMEZONE']); $i++) {
        @mysql_query("INSERT INTO ${prefix}timezone (tzn_zone, tzn_libelle, tzn_gmt, tzn_regle, tzn_date_ete, tzn_heure_ete, tzn_date_hiver, tzn_heure_hiver) VALUES (".trad2('INSTALL_TIMEZONE',$i).");");
      }
    }
    // Tables d'administration
    @mysql_query("CREATE TABLE ${prefix}admin (
      admin_id smallint(5) unsigned NOT NULL auto_increment,
      admin_login varchar(12) NOT NULL default '',
      admin_passwd varchar(32) NULL default NULL,
      PRIMARY KEY (admin_id)
    );");
    // Creation d'un compte administrateur
    $res = @mysql_query("SELECT admin_login FROM ${prefix}admin LIMIT 1;");
    if (!@mysql_num_rows($res)) {
      @mysql_query("INSERT INTO ${prefix}admin (admin_login, admin_passwd) VALUES ('admin', '".md5('admin')."');");
    } else {
      $Admin = mysql_fetch_array($res);
      $AdminUtil=$Admin["admin_login"];
    }
    // Droits des utilisateurs
    $res = @mysql_query("CREATE TABLE ${prefix}droit (
      droit_util_id smallint(5) unsigned NOT NULL default '0',
      droit_profils smallint(5) unsigned NOT NULL default '20',
      droit_agendas smallint(5) unsigned NOT NULL default '10',
      droit_notes smallint(5) unsigned NOT NULL default '15',
      droit_aff varchar(5) NOT NULL default '000',
      droit_admin enum('O','N') NOT NULL default 'N',
      PRIMARY KEY (droit_util_id)
    );");
    if ($res!=1) {
      @mysql_query("ALTER TABLE ${prefix}droit ADD droit_admin ENUM( 'O', 'N' ) NOT NULL DEFAULT 'N';");
      @mysql_query("ALTER TABLE ${prefix}droit CHANGE droit_notes droit_notes SMALLINT( 5 ) NOT NULL DEFAULT '15';");
      @mysql_query("ALTER TABLE ${prefix}droit CHANGE droit_id droit_util_id SMALLINT( 5 ) NOT NULL;");
    }
    // Groupes d'utilisateurs
    @mysql_query("DROP TABLE IF EXISTS ${prefix}planning_affichage");
    @mysql_query("CREATE TABLE ${prefix}planning_affichage (
      aff_util_id smallint(5) unsigned NOT NULL default '0',
      aff_type smallint(5) unsigned NOT NULL default '0',
      aff_figer enum('O','N') NOT NULL default 'N',
      aff_user enum('O','N') NOT NULL default 'N',
      aff_precision enum('0','2','4') NOT NULL default '0',
      aff_debut float(10,2) NOT NULL default '0.00',
      aff_fin float(10,2) NOT NULL default '0.00',
      PRIMARY KEY (aff_util_id,aff_type)
    );");
    @mysql_query("CREATE TABLE ${prefix}groupe_util (
      gr_util_id smallint(5) unsigned NOT NULL auto_increment,
      gr_util_nom varchar(100) NOT NULL default '',
      gr_util_liste text NOT NULL default '',
      PRIMARY KEY (gr_util_id)
    );");
    $res = @mysql_query("CREATE TABLE ${prefix}global_groupe (
      ggr_id smallint(5) unsigned NOT NULL auto_increment,
      ggr_util_id smallint(5) unsigned NOT NULL default '0',
      ggr_nom varchar(100) NOT NULL default '',
      ggr_liste varchar(100) NOT NULL default '0',
      ggr_aff enum('O','N') NOT NULL default 'N',
      ggr_type smallint(5) unsigned NOT NULL default '0',
      PRIMARY KEY (ggr_id)
    );");
    if ($res!=1) {
      @mysql_query("ALTER TABLE ${prefix}global_groupe ADD ggr_aff ENUM( '0', 'N' ) NOT NULL DEFAULT 'N';");
      @mysql_query("ALTER TABLE ${prefix}global_groupe ADD ggr_type SMALLINT( 5 ) NOT NULL;");
      @mysql_query("UPDATE ${prefix}global_groupe SET ggr_liste='0' WHERE ggr_liste='';");
    }
    // Mise a jour des tables
    @mysql_query("ALTER TABLE ${prefix}planning_affecte ADD paf_gr smallint(5) NOT NULL DEFAULT '0';");
    @mysql_query("ALTER TABLE ${prefix}planning_affecte DROP PRIMARY KEY,ADD PRIMARY KEY ( paf_util_id , paf_consultant_id , paf_gr);");
    @mysql_query("ALTER TABLE ${prefix}planning_partage ADD ppl_gr smallint(5) NOT NULL DEFAULT '0';");
    @mysql_query("ALTER TABLE ${prefix}planning_partage DROP PRIMARY KEY,ADD PRIMARY KEY ( ppl_util_id , ppl_consultant_id , ppl_gr);");
    // Mise a jour table utilisateur
    $res = @mysql_query("SELECT util_id FROM ${prefix}utilisateur ORDER BY util_id;");
    while ($enr = @mysql_fetch_array($res)) {
      $res1 = @mysql_query("INSERT INTO ${prefix}droit (droit_util_id, droit_admin) VALUES (".$enr['util_id'].",'N');");
      if ($res1!=1) {
        $res2 = @mysql_query("SELECT droit_profils FROM ${prefix}droit WHERE droit_util_id=".$enr['util_id']." AND droit_admin ='N';");
        if ($droitPrf = mysql_fetch_array($res2)) {
          $droitAdm = ($droitPrf['droit_profils']==100) ? 'O' : 'N';
          @mysql_query("UPDATE ${prefix}droit SET droit_admin ='".$droitAdm."', droit_profils=50 WHERE droit_util_id=".$enr['util_id'].";");
        }
      }
    }
    // Test d'existence d'un compte utilisateur avec droit d'administration
    $res = @mysql_query("SELECT util_id, util_login FROM ${prefix}utilisateur, ${prefix}droit WHERE droit_util_id=util_id AND droit_admin='O' LIMIT 1;");
    if (!@mysql_num_rows($res)) {
      // Creation d'un compte utilisateur avec droit d'administration s'il n'en existe pas deja un en base
      @mysql_query("INSERT INTO ${prefix}utilisateur (util_nom, util_prenom, util_login, util_passwd, util_planning, util_url_export) VALUES ('Administrateur', 'Phenix', 'admin', '".md5('admin')."', 13, '".md5(uniqid(rand()))."');");
      if (@mysql_affected_rows($db)>0 && ($idUser = mysql_insert_id($db))) {
        @mysql_query("INSERT INTO ${prefix}calepin_groupe (cgr_util_id, cgr_nom) VALUES (".$idUser.", '".trad("INSTALL_NON_CLASSE")."');");
        @mysql_query("INSERT INTO ${prefix}favoris_groupe (fgr_util_id, fgr_nom) VALUES (".$idUser.", '".trad("INSTALL_NON_CLASSE")."');");
        @mysql_query("INSERT INTO ${prefix}droit (droit_util_id, droit_profils, droit_agendas, droit_notes, droit_aff, droit_admin) VALUES (".$idUser.", 50, 10, 15, '000', 'O');");
      }
    } else {
      $Util = mysql_fetch_array($res);
      $UtilAdmin=$Util["util_login"];
    }
    // Parametres
    @mysql_query("CREATE TABLE ${prefix}configuration (
      param varchar(50) NOT NULL default '',
      valeur text NOT NULL,
      groupe smallint(5) unsigned NOT NULL default '0',
      PRIMARY KEY (param),
      KEY groupe (groupe)
    );");
    $res = @mysql_query("SELECT valeur FROM ${prefix}configuration WHERE groupe=0 LIMIT 1;");
    if (!@mysql_num_rows($res)) {
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('APPLI_VERSION', '".$APPLI_VERSION_NEW."', 0);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('APPLI_LANGUE', 'fr', 0);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('AUTORISE_SUPPR', 'NON', 0);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('DUREE_SESSION', '300', 0);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('COOKIE_AUTH', 'NON', 0);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('COOKIE_NOM', 'PXlogin', 0);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('COOKIE_DUREE', '10', 0);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('PUBLIC', 'NON', 0);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('RELOAD_PLANNING', '0', 0);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('AUTO_UPPERCASE', 'OUI', 0);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('MODIF_PARTAGE', 'NON', 0);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('CHECK_VERSION', 'OUI', 0);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('RELOAD_CALENDAR', 'OUI', 0);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('AUTORISE_HTML', 'NON', 0);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('AUTORISE_FCKE', 'NON', 0);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('FCKE_TOOLBAR', '', 0);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('FCKE_BASE', '/UserFiles/', 0);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('FCKE_BROWSE', 'NON', 0);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('FCKE_UPLOAD', 'NON', 0);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('SMTP_SERVER', '', 0);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('SMTP_PORT', '', 0);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('SMTP_LOGIN', '', 0);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('SMTP_PASSWORD', '', 0);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('AFF_INFO_DEBUG', 'NON', 0);");

      $_GET['msg'] = 6; //Empeche la connexion a la base de donnees
      if (@include($file_config)) {
        @mysql_query("UPDATE ${prefix}configuration SET valeur='".$inst_lang."' WHERE param='APPLI_LANGUE';");
        if(isset($AUTORISE_SUPPR)) {
          $val = ($AUTORISE_SUPPR==true) ? "OUI" : "NON";
          @mysql_query("UPDATE ${prefix}configuration SET valeur='".$val."' WHERE param='AUTORISE_SUPPR';");
        }
        if(isset($DUREE_SESSION)) {
          $val = ($DUREE_SESSION+0>0) ? $DUREE_SESSION : 300;
          @mysql_query("UPDATE ${prefix}configuration SET valeur='".$val."' WHERE param='DUREE_SESSION';");
        }
        if(isset($COOKIE_AUTH)) {
          $val = ($COOKIE_AUTH==true) ? "OUI" : "NON";
          @mysql_query("UPDATE ${prefix}configuration SET valeur='".$val."' WHERE param='COOKIE_AUTH';");
        }
        if(isset($COOKIE_NOM) && !empty($COOKIE_NOM)) {
          @mysql_query("UPDATE ${prefix}configuration SET valeur='".$COOKIE_NOM."' WHERE param='COOKIE_NOM';");
        }
        if(isset($COOKIE_DUREE)) {
          $val = ($COOKIE_DUREE+0>0) ? $COOKIE_DUREE : 10;
          @mysql_query("UPDATE ${prefix}configuration SET valeur='".$val."' WHERE param='COOKIE_DUREE';");
        }
        if(isset($PUBLIC)) {
          $val = ($PUBLIC==true) ? "OUI" : "NON";
          @mysql_query("UPDATE ${prefix}configuration SET valeur='".$val."' WHERE param='PUBLIC';");
        }
        if(isset($RELOAD_PLANNING)) {
          $val = ($RELOAD_PLANNING+0>0) ? $RELOAD_PLANNING : 0;
          @mysql_query("UPDATE ${prefix}configuration SET valeur='".$val."' WHERE param='RELOAD_PLANNING';");
        }
        if(isset($AUTO_UPPERCASE)) {
          $val = ($AUTO_UPPERCASE==true) ? "OUI" : "NON";
          @mysql_query("UPDATE ${prefix}configuration SET valeur='".$val."' WHERE param='AUTO_UPPERCASE';");
        }
        if(isset($MODIF_PARTAGE)) {
          $val = ($MODIF_PARTAGE==true) ? "OUI" : "NON";
          @mysql_query("UPDATE ${prefix}configuration SET valeur='".$val."' WHERE param='MODIF_PARTAGE';");
        }
        if(isset($AUTORISE_HTML)) {
          if($AUTORISE_HTML==true) {
            $val="OUI";
          } else {
            $val="NON";
            $AUTORISE_FCKE=false;
          }
          @mysql_query("UPDATE ${prefix}configuration SET valeur='".$val."' WHERE param='AUTORISE_HTML';");
        }
        if(isset($AUTORISE_FCKE)) {
          if($AUTORISE_FCKE==true) {
            $val="OUI";
          } else {
            $val="NON";
            $FCKE_TOOLBAR=""; $FCKE_BASE="/UserFiles/";
            $FCKE_BROWSE=$FCKE_UPLOAD=false;
          }
          @mysql_query("UPDATE ${prefix}configuration SET valeur='".$val."' WHERE param='AUTORISE_FCKE';");
        }
        if(isset($FCKE_TOOLBAR) && !empty($FCKE_TOOLBAR)) {
          @mysql_query("UPDATE ${prefix}configuration SET valeur='".$FCKE_TOOLBAR."' WHERE param='FCKE_TOOLBAR';");
        }
        if(isset($FCKE_BASE) && !empty($FCKE_BASE)) {
          @mysql_query("UPDATE ${prefix}configuration SET valeur='".$FCKE_BASE."' WHERE param='FCKE_BASE';");
        }
        if(isset($FCKE_BROWSE)) {
          $val = ($FCKE_BROWSE==true) ? "OUI" : "NON";
          @mysql_query("UPDATE ${prefix}configuration SET valeur='".$val."' WHERE param='FCKE_BROWSE';");
        }
        if(isset($FCKE_UPLOAD)) {
          $val = ($FCKE_UPLOAD==true) ? "OUI" : "NON";
          @mysql_query("UPDATE ${prefix}configuration SET valeur='".$val."' WHERE param='FCKE_UPLOAD';");
        }
        if(isset($CHECK_VERSION)) {
          $val = ($CHECK_VERSION==true) ? "OUI" : "NON";
          @mysql_query("UPDATE ${prefix}configuration SET valeur='".$val."' WHERE param='CHECK_VERSION';");
        }
        if(isset($SMTP_SERVER) && !empty($SMTP_SERVER)) {
          @mysql_query("UPDATE ${prefix}configuration SET valeur='".$SMTP_SERVER."' WHERE param='SMTP_SERVER';");
        } else {
          $SMTP_PORT=$SMTP_LOGIN=$SMTP_PASSWORD="";
        }
        if(isset($SMTP_PORT) && !empty($SMTP_PORT)) {
          @mysql_query("UPDATE ${prefix}configuration SET valeur='".$SMTP_PORT."' WHERE param='SMTP_PORT';");
        }
        if(isset($SMTP_LOGIN) && !empty($SMTP_LOGIN)) {
          @mysql_query("UPDATE ${prefix}configuration SET valeur='".$SMTP_LOGIN."' WHERE param='SMTP_LOGIN';");
        }
        if(isset($SMTP_PASSWORD) && !empty($SMTP_PASSWORD)) {
          @mysql_query("UPDATE ${prefix}configuration SET valeur='".$SMTP_PASSWORD."' WHERE param='SMTP_PASSWORD';");
        }
      }
    }
    // Possibilite pour chaque utilisateur de choisir d'utiliser ou non FCKE
    @mysql_query("ALTER TABLE ${prefix}utilisateur ADD util_fcke ENUM('O','N') NOT NULL DEFAULT 'O';");
    @mysql_query("ALTER TABLE ${prefix}utilisateur ADD util_fcke_toolbar varchar(20) NOT NULL DEFAULT 'Intermed';");
    // Enregistrement des couleurs de notes dans une table a la place de inc/couleur.inc.php
    @mysql_query("CREATE TABLE ${prefix}couleurs (
      cou_id int(10) unsigned NOT NULL auto_increment,
      cou_libelle varchar(100) NOT NULL default '',
      cou_couleur varchar(20) NOT NULL default '',
      cou_util_id smallint(5) unsigned NOT NULL default '0',
      PRIMARY KEY (cou_id),
      KEY cou_util_id(cou_util_id)
    );");
    $res = @mysql_query("SELECT cou_id FROM ${prefix}couleurs LIMIT 1;");
    if (!@mysql_num_rows($res)) {
      if (@include($file_couleur)) {
        while (list($key, $val) = each($tabCouleur)) {
          @mysql_query("INSERT INTO ${prefix}couleurs (cou_libelle,cou_couleur,cou_util_id) VALUES ('".$key."','".$val."',0);");
        }
        @unlink($file_couleur);
      } else {
        @mysql_query("INSERT INTO ${prefix}couleurs (cou_libelle, cou_couleur, cou_util_id) VALUES ".trad("INSTALL_MOD_COULEUR").";");
      }
    }
    // Possibilite de creer une note modele dans avec le libelle
    @mysql_query("ALTER TABLE ${prefix}libelle ADD lib_detail TEXT NOT NULL;");
    // Enregistrement en base des parametres de xtdump
    if(@include($file_xtdump)) {
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('XT_MAIL', '$xt_mail', 1);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('XT_ENVOI_MAIL', '$rp_mail', 1);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('XT_TYPE_SAV', '$opt', 1);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('XT_PERIODICITE', '$xt_type', 1);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('XT_FORMAT_SAV', '$savmode', 1);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('XT_ECRASE', '$ecraz', 1);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('XT_TAILLE_FIC', '$fz_max', 1);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('XT_COMPRESS_GZIP', '$file_type', 1);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('XT_SCINDER_FIC', '$f_cut', 1);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('XT_FIC_PAR_TABLE', '$f_tbl', 1);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('XT_DROP_TABLE', '$drp_tbl', 1);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('XT_TABLE_SAV', '".implode(",",$tbl)."', 1);");
      @mysql_query("INSERT INTO ${prefix}configuration VALUES ('XT_NEXT_SAV', '0', 1);");
      @unlink($file_xtdump);
    }
    // Enregistrement de l'identifiant du compte d'administrateur connecte dans la table des sessions
    @mysql_query("ALTER TABLE ${prefix}sid ADD sid_admin_id SMALLINT( 5 ) UNSIGNED NOT NULL DEFAULT '0';");
    // Suppression de la table des sessions administrateur
    @mysql_query("DROP TABLE IF EXISTS ${prefix}admin_sid;");
    // Insertion dans la table couleur des couleurs non referencees mais presentes dans les tables agenda et libelle
    $listeCouleur = "''";
    $res = @mysql_query("SELECT DISTINCT cou_couleur FROM ${prefix}couleurs;");
    while($enr=@mysql_fetch_array($res)) {
      $listeCouleur .= ",'".$enr['cou_couleur']."'";
    }
    $libCouleur = ".";
    $res = @mysql_query("SELECT DISTINCT lib_couleur FROM ${prefix}libelle WHERE lib_couleur NOT IN (".$listeCouleur.");");
    while($enr=@mysql_fetch_array($res)) {
      $listeCouleur .= ",'".$enr['lib_couleur']."'";
      @mysql_query("INSERT INTO ${prefix}couleurs (cou_libelle, cou_couleur, cou_util_id) VALUES ('".$libCouleur."','".$enr['lib_couleur']."',0);");
      $libCouleur .= ".";
    }
    $res = @mysql_query("SELECT DISTINCT age_couleur FROM ${prefix}agenda WHERE age_couleur NOT IN (".$listeCouleur.");");
    while ($enr=@mysql_fetch_array($res)) {
      @mysql_query("INSERT INTO ${prefix}couleurs (cou_libelle, cou_couleur, cou_util_id) VALUES ('".$libCouleur."','".$enr['age_couleur']."',0);");
      $libCouleur .= ".";
    }
    // Champ mem_partage pour le partage des memos
    @mysql_query("ALTER TABLE ${prefix}memo ADD mem_partage ENUM( 'O', 'N' ) NOT NULL DEFAULT 'N';");
    // Champ sid_screen pour la taille de la fenetre
    @mysql_query("ALTER TABLE ${prefix}sid ADD sid_screen SMALLINT( 5 ) UNSIGNED NOT NULL DEFAULT '0';");
    //  Ajout d'un enregistrement dans la table de configuration pour afficher les informations de DEBUG
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('AFF_INFO_DEBUG', 'NON', 0);");
    // Ajout d'un enregistrement dans la table de configuration pour activer ou desactiver la mise a jour des calendriers du menu de gauche sur la selection d'un nouveau mois ou annee
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('RELOAD_CALENDAR', 'OUI', 0);");
    // Creation d'une table pour la gestion des MODs
    @mysql_query("CREATE TABLE ${prefix}mods (
      mod_id smallint(5) unsigned NOT NULL auto_increment,
      mod_fichier varchar(128) NOT NULL default '',
      mod_nom varchar(64) NOT NULL default '',
      mod_titre varchar(96) NOT NULL default '',
      mod_version varchar(8) NOT NULL default '',
      mod_date date NOT NULL default '0000-00-00',
      PRIMARY KEY (mod_id)
    );");
    // Memorisation des parametres d'export des notes
    @mysql_query("CREATE TABLE ${prefix}agenda_export (
      aex_util_id smallint(5) unsigned NOT NULL default '0',
      aex_creation enum('0','1') NOT NULL default '0',
      aex_html enum('0','1') NOT NULL default '0',
      aex_tz enum('0','1') NOT NULL default '0',
      aex_ch_note enum('0','1','2') NOT NULL default '0',
      aex_note_aff enum('0','1') NOT NULL default '0',
      aex_date_old datetime NOT NULL default '0000-00-00 00:00:00',
      aex_type varchar(10) NOT NULL default '',
      PRIMARY KEY (aex_util_id)
    );");
    // Augmentation de la taille du nom des groupes (favoris et contacts) pour stocker les caracteres speciaux HTML
    @mysql_query("ALTER TABLE ${prefix}favoris_groupe CHANGE fgr_nom fgr_nom VARCHAR( 150 ) NOT NULL;");
    @mysql_query("ALTER TABLE ${prefix}calepin_groupe CHANGE cgr_nom cgr_nom VARCHAR( 150 ) NOT NULL;");
    // Suppression de la table xtdump, remplacee par un parametre dans la table de configuration
    $res = @mysql_query("SELECT xt_last_date FROM ${prefix}xtdump WHERE xt_id=1;");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('XT_NEXT_SAV', '".(@mysql_result($res,0,0)+0)."', 1);");
    @mysql_query("DROP TABLE IF EXISTS ${prefix}xtdump;");
    // Ajout champ date de modification
    @mysql_query("ALTER TABLE ${prefix}agenda ADD age_date_modif DATETIME NOT NULL;");
    @mysql_query("UPDATE ${prefix}agenda SET age_date_modif=age_date_creation;");
  }
  if ($version<501) {
    // Ajout du parametre de gestion du skin de la page de connexion
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('INDEX_STYLE', 'Petrole', 0);");
    // Ajout champ identifiant du modificateur
    @mysql_query("ALTER TABLE ${prefix}agenda ADD age_modificateur_id SMALLINT(5) UNSIGNED NOT NULL;");
    @mysql_query("UPDATE ${prefix}agenda SET age_modificateur_id=age_createur_id WHERE age_modificateur_id=0;");
    // Mise a jour des informations de timezone
    // tzdata2007k
    @mysql_query("UPDATE ${prefix}timezone SET tzn_date_hiver='Aug lastThu' WHERE tzn_regle='Egypt';");
    @mysql_query("UPDATE ${prefix}timezone SET tzn_regle='Arg', tzn_date_ete='Oct Sun>=1', tzn_heure_ete='0:00', tzn_date_hiver='Mar Sun>=15', tzn_heure_hiver='0:00' WHERE tzn_zone LIKE 'America/Argentina/%';");
    @mysql_query("UPDATE ${prefix}timezone SET tzn_date_ete='Oct Sun>=8', tzn_date_hiver='Feb Sun>=15' WHERE tzn_regle='Brazil';");
    @mysql_query("UPDATE ${prefix}timezone SET tzn_gmt=-4.50 WHERE tzn_zone='America/Caracas';");
    @mysql_query("UPDATE ${prefix}timezone SET tzn_date_ete='Mar Sun>=8' WHERE tzn_regle='Cuba';");
    @mysql_query("UPDATE ${prefix}timezone SET tzn_regle='US', tzn_date_ete='Mar Sun>=8', tzn_heure_ete='2:00', tzn_date_hiver='Nov Sun>=1', tzn_heure_hiver='2:00' WHERE tzn_zone LIKE 'America/Indiana/%';");
    @mysql_query("UPDATE ${prefix}timezone SET tzn_gmt=-6.00 WHERE tzn_zone='America/Indiana/Knox';");
    @mysql_query("UPDATE ${prefix}timezone SET tzn_date_hiver='Nov Fri>=1' WHERE tzn_regle='Syria';");
    @mysql_query("UPDATE ${prefix}timezone SET tzn_date_hiver='Sep Thu>=8', tzn_heure_hiver='2:00' WHERE tzn_regle='Palestine';");
    @mysql_query("UPDATE ${prefix}timezone SET tzn_regle='Iran', tzn_date_ete='Mar 21', tzn_heure_ete='0:00', tzn_date_hiver='Sep 21', tzn_heure_hiver='0:00' WHERE tzn_zone='Asia/Tehran';");
    @mysql_query("UPDATE ${prefix}timezone SET tzn_date_ete='Oct Sun>=1', tzn_date_hiver='Apr Sun>=1' WHERE tzn_regle='AS' OR tzn_regle='AT' OR tzn_regle='AV' OR tzn_regle='AN' OR tzn_regle='LH';");
  }
  if ($version<550) {
    // Mise a jour des informations de timezone
    // tzdata2008b
    @mysql_query("INSERT INTO ${prefix}timezone (tzn_zone, tzn_libelle, tzn_gmt, tzn_regle, tzn_date_ete, tzn_heure_ete, tzn_date_hiver, tzn_heure_hiver) VALUES ('America/Argentina/San_Luis', 'San Luis', -3.00, '', '', '', '', '');");
    @mysql_query("INSERT INTO ${prefix}timezone (tzn_zone, tzn_libelle, tzn_gmt, tzn_regle, tzn_date_ete, tzn_heure_ete, tzn_date_hiver, tzn_heure_hiver) VALUES ('America/Indiana/Tell_City', 'Tell City', -6.00, 'US', 'Mar Sun>=8', '2:00', 'Nov Sun>=1', '2:00');");
    @mysql_query("INSERT INTO ${prefix}timezone (tzn_zone, tzn_libelle, tzn_gmt, tzn_regle, tzn_date_ete, tzn_heure_ete, tzn_date_hiver, tzn_heure_hiver) VALUES ('America/Marigot', 'St Martin', -4.00, '', '', '', '', '');");
    @mysql_query("INSERT INTO ${prefix}timezone (tzn_zone, tzn_libelle, tzn_gmt, tzn_regle, tzn_date_ete, tzn_heure_ete, tzn_date_hiver, tzn_heure_hiver) VALUES ('America/St_Barthelemy', 'St Barthelemy', -4.00, '', '', '', '', '');");
    @mysql_query("UPDATE ${prefix}timezone SET tzn_date_ete='Mar Sun>=15' WHERE tzn_regle='Cuba';");
    @mysql_query("UPDATE ${prefix}timezone SET tzn_date_ete='Apr Fri>=1', tzn_date_hiver='Oct 1' WHERE tzn_regle='Syria';");
    @mysql_query("UPDATE ${prefix}timezone SET tzn_zone='Asia/Ho_Chi_Minh' WHERE tzn_zone='Asia/Saigon';");
    @mysql_query("UPDATE ${prefix}utilisateur SET util_timezone='Asia/Ho_Chi_Minh' WHERE util_timezone='Asia/Saigon';");
    if ($inst_lang=="fr") {
      @mysql_query("UPDATE ${prefix}timezone SET tzn_libelle='Saint-Martin' WHERE tzn_libelle='St Martin';");
      @mysql_query("UPDATE ${prefix}timezone SET tzn_libelle='Saint-Barthélemy' WHERE tzn_libelle='St Barthelemy';");
      @mysql_query("UPDATE ${prefix}timezone SET tzn_libelle='Hô-Chi-Minh-Ville' WHERE tzn_libelle='Saïgon';");
    } else {
      @mysql_query("UPDATE ${prefix}timezone SET tzn_libelle='Ho Chi Minh City' WHERE tzn_libelle='Saigon';");
    }
    @mysql_query("UPDATE ${prefix}timezone SET tzn_zone='Asia/Kolkata' WHERE tzn_zone='Asia/Calcutta';");
    @mysql_query("UPDATE ${prefix}utilisateur SET util_timezone='Asia/Kolkata' WHERE util_timezone='Asia/Calcutta';");
    @mysql_query("UPDATE ${prefix}timezone SET tzn_regle='', tzn_date_ete='', tzn_heure_ete='', tzn_date_hiver='', tzn_heure_hiver='' WHERE tzn_zone='Asia/Baghdad';");
    // tzdata2008d
    @mysql_query("INSERT INTO ${prefix}timezone (tzn_zone, tzn_libelle, tzn_gmt, tzn_regle, tzn_date_ete, tzn_heure_ete, tzn_date_hiver, tzn_heure_hiver) VALUES ('America/Santarem', 'Santarem', -3.00, '', '', '', '', '');");
    if ($inst_lang=="fr") {
      @mysql_query("UPDATE ${prefix}timezone SET tzn_libelle='Santarém' WHERE tzn_libelle='Santarem';");
    }
    @mysql_query("UPDATE ${prefix}timezone SET tzn_regle='Mauritius', tzn_date_ete='Nov 1', tzn_heure_ete='0:00', tzn_date_hiver='Apr 1', tzn_heure_hiver='0:00' WHERE tzn_zone='Indian/Mauritius';");
    @mysql_query("UPDATE ${prefix}timezone SET tzn_regle='Morocco', tzn_date_ete='Jun 1', tzn_heure_ete='0:00', tzn_date_hiver='Sep 28', tzn_heure_hiver='0:00' WHERE tzn_zone='Africa/Casablanca';");
    @mysql_query("UPDATE ${prefix}timezone SET tzn_gmt=8.00 WHERE tzn_zone='Asia/Choibalsan';");
    @mysql_query("UPDATE ${prefix}timezone SET tzn_regle='Pakistan', tzn_date_ete='Jun 1', tzn_heure_ete='0:00', tzn_date_hiver='Sep 1', tzn_heure_hiver='0:00' WHERE tzn_zone='Asia/Karachi';");
    @mysql_query("UPDATE ${prefix}timezone SET tzn_gmt=-4.00 WHERE tzn_zone='America/Eirunepe';");
    @mysql_query("UPDATE ${prefix}timezone SET tzn_gmt=-4.00 WHERE tzn_zone='America/Rio_Branco';");
    // Possibilite de choisir le mode d'affichage du menu (auto ou click)
    @mysql_query("ALTER TABLE ${prefix}utilisateur ADD util_menuonclick ENUM( 'O', 'N' ) NOT NULL DEFAULT 'N';");
  }
  if ($version<551) {
    // Extension de la taille du champ pour enregistrer les membres d'un groupe
    @mysql_query("ALTER TABLE ${prefix}groupe_util CHANGE gr_util_liste gr_util_liste TEXT NOT NULL;");
  }

  // Optimisation des tables
  $res = @mysql_list_tables($nomdb);
  while (list($table_name) = @mysql_fetch_array($res)) {
    @mysql_query("OPTIMIZE TABLE ".$table_name.";");
  }

  echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".trad("INSTALL_SCRIPT_MAJ")."<BR><BR>\n";
  echo "<CENTER><FORM method=\"post\" action=\"${NOM_PAGE}?inst_lang=".$inst_lang."&update=4\">\n";
  echo "<INPUT type=\"hidden\" name=\"version\" value=\"".$version."\">\n";
  echo "<INPUT type=\"hidden\" name=\"serveur\" value=\"".htmlspecialchars(stripslashes($serveur))."\">\n";
  echo "<INPUT type=\"hidden\" name=\"nomdb\" value=\"".htmlspecialchars(stripslashes($nomdb))."\">\n";
  echo "<INPUT type=\"hidden\" name=\"utilisateur\" value=\"".htmlspecialchars(stripslashes($utilisateur))."\">\n";
  echo "<INPUT type=\"hidden\" name=\"motdepasse\" value=\"".htmlspecialchars(stripslashes($motdepasse))."\">\n";
  echo "<INPUT type=\"hidden\" name=\"prefix\" value=\"".htmlspecialchars(stripslashes($prefix))."\">\n";
  echo "<INPUT type=\"hidden\" name=\"AdminUtil\" value=\"".htmlspecialchars(stripslashes($AdminUtil))."\">\n";
  echo "<INPUT type=\"hidden\" name=\"UtilAdmin\" value=\"".htmlspecialchars(stripslashes($UtilAdmin))."\">\n";
  echo "<INPUT type=\"submit\" name=\"envoyer\" value=\"".trad("INSTALL_CONTINUER")."\">\n";
  echo "</FORM></CENTER>";

  echo "</TD></TR>\n";
}

//update 4
//Parametres de configuration
elseif ($update==4) {
  echo "<TR><TD bgcolor=\"#D7DFE7\" align=\"center\"><B>".sprintf(trad("INSTALL_ETAPE"), 4)."</B><BR>".trad("INSTALL_CFG_TITRE4")."</TD></TR>\n";
  echo "<TR><TD bgcolor=\"#EFEFEF\">";

  $_GET['msg'] = 6; //Empeche la connexion a la base de donnees
  @include($file_config);

  echo "<FORM method=\"post\" action=\"${NOM_PAGE}?inst_lang=".$inst_lang."&update=5\" name=\"form1\" id=\"form1\">\n";
  echo "<INPUT type=\"hidden\" name=\"config\" value=\"1\">\n";
  echo "<INPUT type=\"hidden\" name=\"version\" value=\"$version\">\n";
  echo "<INPUT type=\"hidden\" name=\"serveur\" value=\"".htmlspecialchars(stripslashes($serveur))."\">\n";
  echo "<INPUT type=\"hidden\" name=\"nomdb\" value=\"".htmlspecialchars(stripslashes($nomdb))."\">\n";
  echo "<INPUT type=\"hidden\" name=\"utilisateur\" value=\"".htmlspecialchars(stripslashes($utilisateur))."\">\n";
  echo "<INPUT type=\"hidden\" name=\"motdepasse\" value=\"".htmlspecialchars(stripslashes($motdepasse))."\">\n";
  echo "<INPUT type=\"hidden\" name=\"prefix\" value=\"".htmlspecialchars(stripslashes($prefix))."\">\n";
  echo "<INPUT type=\"hidden\" name=\"AdminUtil\" value=\"".htmlspecialchars(stripslashes($AdminUtil))."\">\n";
  echo "<INPUT type=\"hidden\" name=\"UtilAdmin\" value=\"".htmlspecialchars(stripslashes($UtilAdmin))."\">\n";
  echo "<TABLE align=\"center\" border=0 cellspacing=2 cellpadding=2  style=\"text-align:left;\">\n";
  echo "<TR><TD>".trad("INSTALL_CONNECT")."</TD><TD><SELECT name=\"cheminabsolu\"><OPTION value=\"true\"".(($CHEMIN_ABSOLU) ? " selected" : "").">".trad("INSTALL_CONNECT_A")."</OPTION><OPTION value=\"false\"".((!$CHEMIN_ABSOLU) ? " selected" : "").">".trad("INSTALL_CONNECT_R")."</OPTION></SELECT></TD><TD><I>".trad("INSTALL_CONNECT_DEF")."</I></TD></TR>\n";
  echo "<TR><TD>".trad("INSTALL_MAJCFG_LANG")."</TD><TD><SELECT name=\"langue\">".listeLangue($inst_lang)."</SELECT></TD><TD><I>".trad("INSTALL_MAJCFG_LANG_DEF")."</I></TD></TR>\n";
  if ($version<500) {
    $db = @mysql_connect($serveur, $utilisateur, $motdepasse);
    @mysql_select_db($nomdb,$db);
    echo "<TR><TD colspan=\"3\"><BR><TABLE align=\"center\" border=0 cellspacing=2 cellpadding=2 width=\"850\" bgcolor=\"red\"><TR><TD align=\"center\"><FONT color=\"white\">".trad("INSTALL_MAJCFG_TZ_MES")."</FONT></TD></TR></TABLE><BR></TD></TR>\n";
    echo "<TR><TD>".trad("INSTALL_MAJCFG_TZ")."</TD><TD><SELECT name=\"timezone\">";
    // On recupere la liste des fuseaux horaires
    $res = @mysql_query("SELECT tzn_zone, tzn_libelle, tzn_gmt FROM ${prefix}timezone ORDER BY tzn_gmt, tzn_libelle;");
    while ($enr = @mysql_fetch_array($res)) {
      $selected = ($enr['tzn_zone']==$default_timezone) ? " selected" : "";
      $signe = ($enr['tzn_gmt']<0) ? "-" : "+";
      $gmt = abs($enr['tzn_gmt']);
      echo "<OPTION value=\"".$enr['tzn_zone']."\"".$selected.">(GMT".$signe.date("H:i",mktime(floor($gmt),($gmt*60)%60,0,1,1,2000)).") ".htmlentities($enr['tzn_libelle'])."</OPTION>";
    }
    echo "</SELECT></TD><TD><I>".trad("INSTALL_MAJCFG_TZ_DEF")."</I></TD></TR>\n";
    $onClick = " onclick=\"javascript: progressBar.showBar();\"";
  } else {
    $onClick = "";
  }
  echo "<TR><TD colspan=3 align=\"center\"><BR><INPUT type=\"submit\" name=\"envoyer\" value=\"".trad("INSTALL_BT_VALIDER")."\"".$onClick."></TD></TR>\n";
  echo "</TABLE>\n";
  echo "</FORM>";

  echo "</TD></TR>\n";
}

//etape 1
//Saisie des informations de connexion a la base de donnees
elseif ($etape==1) {
  echo "<TR><TD bgcolor=\"#D7DFE7\" align=\"center\"><B>".sprintf(trad("INSTALL_ETAPE"), 1)."</B><BR>".trad("INSTALL_INFCON")."</TD></TR>\n";
  echo "<TR><TD bgcolor=\"#EFEFEF\">";

  echo "<FORM method=\"post\" action=\"${NOM_PAGE}?inst_lang=".$inst_lang."&etape=2\">\n";
  echo "<TABLE align=\"center\" border=0 cellspacing=2 cellpadding=2>\n";
  echo "<TR><TD>".trad("INSTALL_MAJCFG_SRVMYSQL")."</TD><TD><INPUT type=\"text\" name=\"serveur\" size=\"30\" value=\"localhost\"></TD><TD><I>".trad("INSTALL_MAJCFG_EXEMPLE")."</I></TD></TR>\n";
  echo "<TR><TD>".trad("INSTALL_MAJCFG_BDD")."</TD><TD><INPUT type=\"text\" name=\"nomdb\" size=\"30\" value=\"phenix\"></TD><TD><FONT color=\"#ff0000\"><B><I>".trad("INSTALL_INFCON1")."</I></B></FONT></TD></TR>\n";
  echo "<TR><TD>".trad("INSTALL_MAJCFG_BDDUSER")."</TD><TD><INPUT type=\"text\" name=\"utilisateur\" size=\"30\" value=\"\"></TD><TD></TD></TR>\n";
  echo "<TR><TD>".trad("INSTALL_MAJCFG_BDDMDP")."</TD><TD><INPUT type=\"password\" name=\"motdepasse\" size=\"30\" value=\"\"></TD><TD></TD></TR>\n";
  echo "<TR><TD>".trad("INSTALL_MAJCFG_BDDPFX")."</TD><TD><INPUT type=\"text\" name=\"prefix\" size=\"30\" value=\"px_\"></TD><TD><I>".trad("INSTALL_INFCON2")."</I></TD></TR>\n";
  echo "<TR><TD colspan=3 align=\"center\"><INPUT type=\"submit\" name=\"envoyer\" value=\"".trad("INSTALL_BT_VALIDER")."\" onclick=\"javascript: progressBar.showBar();\"></TD></TR>\n";
  echo "</TABLE>\n";
  echo "</FORM>";

  echo "</TD></TR>\n";
}

//etape 2
//Connexion a la base et creation des tables
elseif ($etape==2) {
  $erreur = false;
  echo "<TR><TD bgcolor=\"#D7DFE7\" align=\"center\"><B>".sprintf(trad("INSTALL_ETAPE"), 2)."</B><BR>".trad("INSTALL_CREA_TABLE")."</TD></TR>\n";
  echo "<TR><TD bgcolor=\"#EFEFEF\">";

  echo trad("INSTALL_SERVEUR")." : <B>$serveur</B><BR>".trad("INSTALL_BDD")." : <B>$nomdb</B><BR>".trad("INSTALL_USER")." : <B>$utilisateur</B><BR>".trad("INSTALL_MAJCFG_BDDPFX")." : <B>$prefix</B><BR><BR>";
  ($db = @mysql_connect($serveur, $utilisateur, $motdepasse)) or die("<IMG border=0 src=\"actionko.gif\"><FONT color=\"#ff0000\"><B>".trad("INSTALL_MAJCFG_CNXSRV")."</B>".trad("INSTALL_MAJCFG_ERRCNXSRV")."</FONT><BR><BR><CENTER><FORM method=\"post\" action=\"${NOM_PAGE}?inst_lang=".$inst_lang."&etape=1\"><INPUT type=\"submit\" name=\"envoyer\" value=\"".trad("INSTALL_RETOUR")."\"></FORM></CENTER><BR></TD></TR>".$piedPage);
  echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".trad("INSTALL_MAJCFG_CNXSRV")."<BR>";
  @mysql_select_db($nomdb,$db) or die("<IMG border=0 src=\"actionko.gif\"><FONT color=\"#ff0000\"><B>".trad("INSTALL_MAJCFG_CNXBDD")."</B>".trad("INSTALL_MAJCFG_ERRCNXBDD")."</FONT><BR><BR><CENTER><FORM method=\"post\" action=\"${NOM_PAGE}?inst_lang=".$inst_lang."&etape=1\"><INPUT type=\"submit\" name=\"envoyer\" value=\"".trad("INSTALL_RETOUR")."\"></FORM></CENTER><BR></TD></TR>".$piedPage);
  echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".trad("INSTALL_MAJCFG_CNXBDD")."<BR>";
  // Tables d'administration
  $sql = ("CREATE TABLE ${prefix}admin (
    admin_id smallint(5) unsigned NOT NULL auto_increment,
    admin_login varchar(12) NOT NULL default '',
    admin_passwd varchar(32) NULL default NULL,
    PRIMARY KEY (admin_id)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}admin")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}admin")."<BR>\n";
    @mysql_query("INSERT INTO ${prefix}admin (admin_id, admin_login, admin_passwd) VALUES (1, 'admin', '".md5('admin')."');");
  }
  //@mysql_query("DROP TABLE IF EXISTS ${prefix}agenda;");
  $sql = ("CREATE TABLE ${prefix}agenda (
    age_id int(10) unsigned NOT NULL auto_increment,
    age_mere_id int(10) unsigned NOT NULL default '0',
    age_util_id smallint(5) unsigned NOT NULL default '0',
    age_aty_id smallint(5) unsigned NOT NULL default '1',
    age_date date NOT NULL default '0000-00-00',
    age_heure_debut float(10,2) NOT NULL default '0.00',
    age_heure_fin float(10,2) NOT NULL default '0.00',
    age_ape_id smallint(5) unsigned NOT NULL default '1',
    age_periode1 tinyint(3) unsigned NOT NULL default '0',
    age_periode2 int(7) unsigned NOT NULL default '0',
    age_periode3 tinyint(3) unsigned NOT NULL default '0',
    age_periode4 tinyint(3) unsigned NOT NULL default '0',
    age_plage tinyint(3) unsigned NOT NULL default '0',
    age_plage_duree bigint(20) unsigned NOT NULL default '0',
    age_libelle varchar(230) NOT NULL default '',
    age_detail text NOT NULL,
    age_rappel tinyint(3) unsigned NOT NULL default '0',
    age_rappel_coeff smallint(5) unsigned NOT NULL default '0',
    age_email tinyint(3) unsigned NOT NULL default '0',
    age_prive tinyint(3) unsigned NOT NULL default '0',
    age_couleur varchar(20) NOT NULL default '',
    age_nb_participant int(10) unsigned NOT NULL default '1',
    age_createur_id smallint(5) unsigned NOT NULL default '0',
    age_date_creation datetime NOT NULL default '0000-00-00 00:00:00',
    age_modificateur_id smallint(5) unsigned NOT NULL default '0',
    age_date_modif datetime NOT NULL default '0000-00-00 00:00:00',
    age_disponibilite tinyint(3) unsigned NOT NULL default '0',
    age_lieu varchar(230) NOT NULL default '',
    age_cal_id int(10) unsigned NOT NULL default '0',
    age_email_contact tinyint(3) unsigned NOT NULL default '0',
    PRIMARY KEY (age_id),
    KEY age_util_id (age_util_id),
    KEY age_date (age_date),
    KEY age_cal_id (age_cal_id)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}agenda")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}agenda")."<BR>\n";
  }
  //@mysql_query("DROP TABLE IF EXISTS ${prefix}agenda_concerne;");
  $sql = ("CREATE TABLE ${prefix}agenda_concerne (
    aco_age_id int(10) unsigned NOT NULL default '0',
    aco_util_id smallint(5) unsigned NOT NULL default '0',
    aco_rappel_ok smallint(4) unsigned NOT NULL default '0',
    aco_termine tinyint(3) unsigned NOT NULL default '0',
    PRIMARY KEY (aco_age_id,aco_util_id)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}agenda_concerne")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}agenda_concerne")."<BR>\n";
  }
  //@mysql_query("DROP TABLE IF EXISTS ${prefix}agenda_export;");
  $sql = ("CREATE TABLE ${prefix}agenda_export (
    aex_util_id smallint (5) NOT NULL default '0',
    aex_creation enum('0','1') NOT NULL default '0',
    aex_html enum('0','1') NOT NULL default '0',
    aex_tz enum('0','1') NOT NULL default '0',
    aex_ch_note enum('0','1','2') NOT NULL default '0',
    aex_note_aff enum('0','1') NOT NULL default '0',
    aex_date_old datetime NOT NULL default '0000-00-00 00:00:00',
    aex_type varchar(10) NOT NULL default '',
    PRIMARY KEY (aex_util_id)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}agenda_export")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}agenda_export")."<BR>\n";
  }
  //@mysql_query("DROP TABLE IF EXISTS ${prefix}calepin;");
  $sql = ("CREATE TABLE ${prefix}calepin (
    cal_id int(10) unsigned NOT NULL auto_increment,
    cal_societe varchar(50) NOT NULL default '',
    cal_nom varchar(50) NOT NULL default '',
    cal_prenom varchar(30) NOT NULL default '',
    cal_adresse text NOT NULL,
    cal_cp varchar(10) NOT NULL default '',
    cal_ville varchar(100) NOT NULL default '',
    cal_pays varchar(100) NOT NULL default '',
    cal_domicile varchar(20) NOT NULL default '',
    cal_travail varchar(20) NOT NULL default '',
    cal_portable varchar(20) NOT NULL default '',
    cal_fax varchar(20) NOT NULL default '',
    cal_email varchar(50) NOT NULL default '',
    cal_icq int(10) unsigned NOT NULL default '0',
    cal_util_id smallint(5) unsigned NOT NULL default '0',
    cal_partage enum('O','N') NOT NULL default 'N',
    cal_note text NOT NULL,
    cal_date_naissance date NOT NULL default '0000-00-00',
    cal_aim varchar(50) NOT NULL default '',
    cal_msn varchar(50) NOT NULL default '',
    cal_yahoo varchar(50) NOT NULL default '',
    cal_emailpro varchar(50) NOT NULL default '',
    cal_siteweb varchar(255) NOT NULL default '',
    cal_rappel_ok smallint(4) unsigned NOT NULL default '0',
    PRIMARY KEY (cal_id),
    KEY cal_nom (cal_nom),
    KEY cal_util_id (cal_util_id),
    KEY cal_partage (cal_partage)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}calepin")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}calepin")."<BR>";
  }
  //@mysql_query("DROP TABLE IF EXISTS ${prefix}calepin_appartient;");
  $sql = ("CREATE TABLE ${prefix}calepin_appartient (
    cap_cal_id int(10) unsigned NOT NULL default '0',
    cap_cgr_id int(10) unsigned NOT NULL default '0',
    KEY cap_cal_id (cap_cal_id),
    KEY cap_cgr_id (cap_cgr_id)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}calepin_appartient")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}calepin_appartient")."<BR>\n";
  }
  //@mysql_query("DROP TABLE IF EXISTS ${prefix}calepin_groupe;");
  $sql = ("CREATE TABLE ${prefix}calepin_groupe (
    cgr_id int(10) unsigned NOT NULL auto_increment,
    cgr_pere_id int(10) unsigned NOT NULL default '0',
    cgr_util_id smallint(5) unsigned NOT NULL default '0',
    cgr_nom varchar(150) NOT NULL default '',
    PRIMARY KEY (cgr_id),
    KEY cgr_pere_id (cgr_pere_id),
    KEY cgr_util_id (cgr_util_id)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}calepin_groupe")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}calepin_groupe")."<BR>\n";
  }
  //@mysql_query("DROP TABLE IF EXISTS ${prefix}configuration;");
  $sql = ("CREATE TABLE ${prefix}configuration (
    param varchar(50) NOT NULL default '',
    valeur text NOT NULL,
    groupe smallint(5) unsigned NOT NULL default '0',
    PRIMARY KEY (param),
    KEY groupe (groupe)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}configuration")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}configuration")."<BR>\n";
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('APPLI_VERSION', '".$APPLI_VERSION_NEW."', 0);");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('APPLI_LANGUE', '".$inst_lang."', 0);");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('AUTORISE_SUPPR', 'NON', 0);");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('DUREE_SESSION', '300', 0);");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('COOKIE_AUTH', 'NON', 0);");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('COOKIE_NOM', 'PXlogin', 0);");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('COOKIE_DUREE', '10', 0);");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('PUBLIC', 'OUI', 0);");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('RELOAD_PLANNING', '0', 0);");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('AUTO_UPPERCASE', 'OUI', 0);");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('MODIF_PARTAGE', 'NON', 0);");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('CHECK_VERSION', 'OUI', 0);");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('RELOAD_CALENDAR', 'OUI', 0);");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('AUTORISE_HTML', 'NON', 0);");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('AUTORISE_FCKE', 'NON', 0);");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('FCKE_TOOLBAR', 'Intermed', 0);");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('FCKE_BASE', '/UserFiles/', 0);");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('FCKE_BROWSE', 'NON', 0);");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('FCKE_UPLOAD', 'NON', 0);");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('SMTP_SERVER', '', 0);");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('SMTP_PORT', '', 0);");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('SMTP_LOGIN', '', 0);");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('SMTP_PASSWORD', '', 0);");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('AFF_INFO_DEBUG', 'NON', 0);");
    @mysql_query("INSERT INTO ${prefix}configuration VALUES ('INDEX_STYLE', 'Petrole', 0);");
  }
  //@mysql_query("DROP TABLE IF EXISTS ${prefix}couleurs;");
  $sql = ("CREATE TABLE ${prefix}couleurs(
    cou_id int(10) unsigned NOT NULL auto_increment,
    cou_libelle varchar(100) NOT NULL default '',
    cou_couleur varchar(20) NOT NULL default '',
    cou_util_id smallint(5) unsigned NOT NULL default '0',
    PRIMARY KEY (cou_id),
    KEY cou_util_id (cou_util_id)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}couleurs")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}couleurs")."<BR>\n";
    @mysql_query("INSERT INTO ${prefix}couleurs (cou_libelle, cou_couleur, cou_util_id) VALUES ".trad("INSTALL_MOD_COULEUR").";");
  }
  //@mysql_query("DROP TABLE IF EXISTS ${prefix}droit;");
  $sql = ("CREATE TABLE ${prefix}droit (
    droit_util_id smallint(5) unsigned NOT NULL default '0',
    droit_profils smallint(5) unsigned NOT NULL default '20',
    droit_agendas smallint(5) unsigned NOT NULL default '10',
    droit_notes smallint(5) unsigned NOT NULL default '15',
    droit_aff varchar(5) NOT NULL default '000',
    droit_admin enum('O','N') NOT NULL default 'N',
    PRIMARY KEY (droit_util_id)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}droit")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}droit")."<BR>\n";
  }
  //@mysql_query("DROP TABLE IF EXISTS ${prefix}evenement;");
  $sql = ("CREATE TABLE ${prefix}evenement (
    eve_id int(10) unsigned NOT NULL auto_increment,
    eve_date_debut date NOT NULL default '0000-00-00',
    eve_date_fin date NOT NULL default '0000-00-00',
    eve_libelle varchar(100) NOT NULL default '',
    eve_type smallint(5) unsigned NOT NULL default '1',
    eve_couleur varchar(20) NOT NULL default '',
    eve_util_id smallint(5) unsigned NOT NULL default '0',
    eve_partage enum('O','N') NOT NULL default 'N',
    PRIMARY KEY (eve_id),
    KEY eve_util_id (eve_util_id),
    KEY eve_date_debut (eve_date_debut),
    KEY eve_date_fin (eve_date_fin)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}evenement")."</B></FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}evenement")."<BR>\n";
  }
  //@mysql_query("DROP TABLE IF EXISTS ${prefix}favoris;");
  $sql = ("CREATE TABLE ${prefix}favoris (
    fav_id int(10) unsigned NOT NULL auto_increment,
    fav_nom varchar(255) NOT NULL default '',
    fav_url text NOT NULL,
    fav_commentaire text NOT NULL,
    fav_util_id smallint(5) unsigned NOT NULL default '0',
    fav_partage enum('O','N') NOT NULL default 'N',
    fav_fgr_id int(10) unsigned NOT NULL default '0',
    PRIMARY KEY (fav_id),
    KEY fav_util_id (fav_util_id)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}favoris")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}favoris")."<BR>\n";
  }
  //@mysql_query("DROP TABLE IF EXISTS ${prefix}favoris_groupe;");
  $sql = ("CREATE TABLE ${prefix}favoris_groupe (
    fgr_id int(10) unsigned NOT NULL auto_increment,
    fgr_util_id smallint(5) unsigned NOT NULL default '0',
    fgr_nom varchar(150) NOT NULL default '',
    PRIMARY KEY (fgr_id),
    KEY fgr_util_id (fgr_util_id)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}favoris_groupe")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}favoris_groupe")."<BR>\n";
  }
  //@mysql_query("DROP TABLE IF EXISTS ${prefix}fetes;");
  $sql = ("CREATE TABLE ${prefix}fetes (
    fet_mois int(2) unsigned NOT NULL default '0',
    fet_jour int(2) unsigned NOT NULL default '0',
    fet_nom varchar(50) NOT NULL default '',
    PRIMARY KEY (fet_nom)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}fetes")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}fetes")."<BR>\n";
    for ($i=0; $i<count($LG['INSTALL_FETE']); $i++) {
      @mysql_query("INSERT INTO ${prefix}fetes VALUES (".trad2('INSTALL_FETE',$i).");");
    }
  }
  $sql = ("CREATE TABLE ${prefix}global_groupe (
    ggr_id smallint(5) unsigned NOT NULL auto_increment,
    ggr_util_id smallint(5) unsigned NOT NULL default '0',
    ggr_nom varchar(100) NOT NULL default '',
    ggr_liste varchar(100) NOT NULL default '0',
    ggr_aff enum('O','N') NOT NULL default 'N',
    ggr_type smallint(5) unsigned NOT NULL default '0',
    PRIMARY KEY (ggr_id)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}global_groupe")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}global_groupe")."<BR>\n";
  }
  $sql = ("CREATE TABLE ${prefix}groupe_util (
    gr_util_id smallint(5) NOT NULL auto_increment,
    gr_util_nom varchar(100) NOT NULL default '',
    gr_util_liste text NOT NULL default '',
    PRIMARY KEY (gr_util_id)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}groupe_util")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}groupe_util")."<BR>\n";
  }
  //@mysql_query("DROP TABLE IF EXISTS ${prefix}information;");
  $sql = ("CREATE TABLE ${prefix}information (
    info_id smallint(5) unsigned NOT NULL auto_increment,
    info_emetteur_id smallint(5) unsigned NOT NULL default '0',
    info_destinataire_id smallint(5) unsigned NOT NULL default '0',
    info_age_id int(11) NULL default NULL,
    info_date datetime NOT NULL default '0000-00-00 00:00:00',
    info_commentaire varchar(255) NOT NULL default '',
    info_heure_rappel int(10) unsigned NOT NULL default '0',
    PRIMARY KEY (info_id),
    KEY info_destinataire_id (info_destinataire_id)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}information")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}information")."<BR>\n";
  }
  //@mysql_query("DROP TABLE IF EXISTS ${prefix}libelle;");
  $sql = ("CREATE TABLE ${prefix}libelle (
    lib_id int(10) unsigned NOT NULL auto_increment,
    lib_nom varchar(255) NOT NULL default '',
    lib_detail text NOT NULL,
    lib_duree float(10,2) NOT NULL default '0.25',
    lib_couleur varchar(20) NOT NULL default '',
    lib_util_id smallint(5) unsigned NOT NULL default '0',
    lib_partage enum('O','N') NOT NULL default 'N',
    PRIMARY KEY (lib_id),
    KEY lib_util_id (lib_util_id)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}libelle")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}libelle")."<BR>\n";
  }
  //@mysql_query("DROP TABLE IF EXISTS ${prefix}memo;");
  $sql = ("CREATE TABLE ${prefix}memo (
    mem_id int(10) unsigned NOT NULL auto_increment,
    mem_titre varchar(255) NOT NULL default '',
    mem_contenu text NOT NULL,
    mem_util_id smallint(5) unsigned NOT NULL default '0',
    mem_partage enum('O','N') NOT NULL default 'N',
    PRIMARY KEY (mem_id),
    KEY mem_util_id (mem_util_id)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}memo")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}memo")."<BR>\n";
  }
  //@mysql_query("DROP TABLE IF EXISTS ${prefix}mods;");
  $sql = ("CREATE TABLE ${prefix}mods (
    mod_id smallint(5) unsigned NOT NULL auto_increment,
    mod_fichier varchar(128) NOT NULL default '',
    mod_nom varchar(64) NOT NULL default '',
    mod_titre varchar(96) NOT NULL default '',
    mod_version varchar(8) NOT NULL default '',
    mod_date date NOT NULL default '0000-00-00',
    PRIMARY KEY (mod_id)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}mods")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}mods")."<BR>\n";
  }
  //@mysql_query("DROP TABLE IF EXISTS ${prefix}planning_affecte;");
  $sql = ("CREATE TABLE ${prefix}planning_affecte (
    paf_util_id smallint(5) unsigned NOT NULL default '0',
    paf_consultant_id smallint(5) unsigned NOT NULL default '0',
    paf_gr smallint(5) unsigned NOT NULL default '0',
    PRIMARY KEY (paf_util_id,paf_consultant_id,paf_gr),
    KEY paf_consultant_id (paf_consultant_id)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}planning_affecte")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}planning_affecte")."<BR>\n";
  }
  $sql = ("CREATE TABLE ${prefix}planning_affichage (
    aff_util_id smallint(5) unsigned NOT NULL default '0',
    aff_type smallint(5) unsigned NOT NULL default '0',
    aff_figer enum('O','N') NOT NULL default 'N',
    aff_user enum('O','N') NOT NULL default 'N',
    aff_precision enum('0','2','4') NOT NULL default '0',
    aff_debut float(10,2) NOT NULL default '0.00',
    aff_fin float(10,2) NOT NULL default '0.00',
    PRIMARY KEY (aff_util_id,aff_type)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}planning_affichage")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}planning_affichage")."<BR>\n";
  }
  //@mysql_query("DROP TABLE IF EXISTS ${prefix}planning_partage;");
  $sql = ("CREATE TABLE ${prefix}planning_partage (
    ppl_util_id smallint(5) unsigned NOT NULL default '0',
    ppl_consultant_id smallint(5) unsigned NOT NULL default '0',
    ppl_gr smallint(5) unsigned NOT NULL default '0',
    PRIMARY KEY (ppl_util_id,ppl_consultant_id,ppl_gr),
    KEY ppl_consultant_id (ppl_consultant_id)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}planning_partage")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}planning_partage")."<BR>\n";
  }
  //@mysql_query("DROP TABLE IF EXISTS ${prefix}sid;");
  $sql = ("CREATE TABLE ${prefix}sid (
    sid_id varchar(8) NOT NULL default '',
    sid_util_id smallint(5) unsigned NOT NULL default '0',
    sid_admin_id smallint(5) unsigned NOT NULL default '0',
    sid_last_maj datetime NOT NULL default '0000-00-00 00:00:00',
    sid_session_id varchar(32) NOT NULL default '',
    sid_util_subst_id smallint(5) unsigned NOT NULL default '0',
    sid_semaine_type varchar(7) NOT NULL default '1111111',
    sid_filtre_couleur varchar(20) NOT NULL default 'ALL',
    sid_screen smallint(5) unsigned NOT NULL default '0',
    PRIMARY KEY (sid_id)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}sid")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}sid")."<BR>\n";
  }
  //@mysql_query("DROP TABLE IF EXISTS ${prefix}timezone;");
  $sql = ("CREATE TABLE ${prefix}timezone (
    tzn_zone varchar(40) NOT NULL default '',
    tzn_libelle varchar(50) NOT NULL default '',
    tzn_gmt float(10,2) NOT NULL default '0.00',
    tzn_regle varchar(12) NOT NULL default '',
    tzn_date_ete varchar(12) NOT NULL default '',
    tzn_heure_ete varchar(6) NOT NULL default '',
    tzn_date_hiver varchar(12) NOT NULL default '',
    tzn_heure_hiver varchar(6) NOT NULL default '',
    PRIMARY KEY (tzn_zone)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}timezone")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}timezone")."<BR>\n";
    for ($i=0; $i<count($LG['INSTALL_TIMEZONE']); $i++) {
      @mysql_query("INSERT INTO ${prefix}timezone (tzn_zone, tzn_libelle, tzn_gmt, tzn_regle, tzn_date_ete, tzn_heure_ete, tzn_date_hiver, tzn_heure_hiver) VALUES (".trad2('INSTALL_TIMEZONE',$i).");");
    }
  }
  //@mysql_query("DROP TABLE IF EXISTS ${prefix}utilisateur;");
  $sql = ("CREATE TABLE ${prefix}utilisateur (
    util_id smallint(5) unsigned NOT NULL auto_increment,
    util_nom varchar(32) NOT NULL default '',
    util_prenom varchar(32) NOT NULL default '',
    util_login varchar(12) NOT NULL default '',
    util_passwd varchar(32) NULL default NULL,
    util_interface varchar(32) NOT NULL default 'Grise',
    util_debut_journee float(10,2) NOT NULL default '8.50',
    util_fin_journee float(10,2) NOT NULL default '18.00',
    util_telephone_vf enum('O','N') NOT NULL default 'O',
    util_planning tinyint(3) unsigned NOT NULL default '0',
    util_partage_planning enum('0','1','2') NOT NULL default '0',
    util_email varchar(50) NOT NULL default '',
    util_autorise_affect enum('0','1','2','3') NOT NULL default '0',
    util_alert_affect enum('O','N') NOT NULL default 'N',
    util_precision_planning enum('1','2') NOT NULL default '1',
    util_semaine_type varchar(7) NOT NULL default '1111111',
    util_duree_note enum('1','2','3','4') NOT NULL default '1',
    util_rappel_delai tinyint(3) unsigned NOT NULL default '0',
    util_rappel_type smallint(5) unsigned NOT NULL default '1',
    util_rappel_email tinyint(3) unsigned NOT NULL default '0',
    util_format_nom enum('0','1') NOT NULL default '0',
    util_menu_dispo enum('8','9') NOT NULL default '8',
    util_url_export varchar(32) NOT NULL default '',
    util_note_barree enum('O','N') NOT NULL default 'O',
    util_rappel_anniv tinyint(3) unsigned NOT NULL default '0',
    util_rappel_anniv_coeff smallint(4) unsigned NOT NULL default '1440',
    util_rappel_anniv_email tinyint(3) unsigned NOT NULL default '0',
    util_langue varchar(10) NOT NULL default 'fr',
    util_timezone varchar(40) NOT NULL default '".$default_timezone."',
    util_timezone_partage enum('O','N') NOT NULL default 'O',
    util_format_heure enum('12','24') NOT NULL default '24',
    util_fcke enum('O','N') NOT NULL default 'O',
    util_fcke_toolbar varchar(20) NOT NULL default 'Intermed',
    util_menuonclick enum('O','N') NOT NULL default 'N',
    PRIMARY KEY (util_id)
  );");
  $request = mysql_query($sql);
  if ($request!=1) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"#ff0000\">".sprintf(trad("INSTALL_IMPOS_CREATION_TBL"), "${prefix}utilisateur")."</FONT><BR>\n";
    $erreur = true;
  } else {
    echo "<IMG border=0 src=\"actionok.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("INSTALL_CREATION_TBL"), "${prefix}utilisateur")."<BR>\n";
  }
  // Creation d'un administrateur
  @mysql_query("INSERT INTO ${prefix}utilisateur (util_nom, util_prenom, util_login, util_passwd, util_planning, util_url_export) VALUES ('Administrateur', 'Phenix', 'admin', '".md5('admin')."', 13, '".md5(uniqid(rand()))."');");
  if (mysql_affected_rows($db)>0 && ($idUser = mysql_insert_id($db))) {
    @mysql_query("INSERT INTO ${prefix}calepin_groupe (cgr_util_id, cgr_nom) VALUES (".$idUser.", '".trad("INSTALL_NON_CLASSE")."');");
    @mysql_query("INSERT INTO ${prefix}favoris_groupe (fgr_util_id, fgr_nom) VALUES (".$idUser.", '".trad("INSTALL_NON_CLASSE")."');");
    @mysql_query("INSERT INTO ${prefix}droit (droit_util_id, droit_profils, droit_agendas, droit_notes, droit_aff, droit_admin) VALUES (".$idUser.", 50, 10, 15, '000', 'O');");
  }

  if ($erreur) {
    echo "<IMG border=0 src=\"actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"ff0000\">".trad("INSTALL_ERREUR_CREATION_TBL")."</FONT><BR><BR>";
    echo "<CENTER><FORM method=\"post\" action=\"${NOM_PAGE}?inst_lang=".$inst_lang."&etape=1\">\n";
    echo "<INPUT type=\"submit\" name=\"envoyer\" value=\"".trad("INSTALL_RETOUR")."\">\n";
    echo "</FORM></CENTER><BR>";
  }
  else {
    echo "<CENTER><FORM method=\"post\" action=\"${NOM_PAGE}?inst_lang=".$inst_lang."&etape=3\">\n";
    echo "<INPUT type=\"hidden\" name=\"serveur\" value=\"".htmlspecialchars(stripslashes($serveur))."\">\n";
    echo "<INPUT type=\"hidden\" name=\"nomdb\" value=\"".htmlspecialchars(stripslashes($nomdb))."\">\n";
    echo "<INPUT type=\"hidden\" name=\"utilisateur\" value=\"".htmlspecialchars(stripslashes($utilisateur))."\">\n";
    echo "<INPUT type=\"hidden\" name=\"motdepasse\" value=\"".htmlspecialchars(stripslashes($motdepasse))."\">\n";
    echo "<INPUT type=\"hidden\" name=\"prefix\" value=\"".htmlspecialchars(stripslashes($prefix))."\">\n";
    echo "<INPUT type=\"submit\" name=\"envoyer\" value=\"".trad("INSTALL_CONTINUER")."\">\n";
    echo "</FORM></CENTER>";
  }

  echo "</TD></TR>\n";
}

//etape 3
//Parametres de configuration
elseif ($etape==3) {
  echo "<TR><TD bgcolor=\"#D7DFE7\" align=\"center\"><B>".sprintf(trad("INSTALL_ETAPE"), 3)."</B><BR>".trad("INSTALL_CFG_TITRE4")."</TD></TR>\n";
  echo "<TR><TD bgcolor=\"#EFEFEF\">";

  echo "<FORM method=\"post\" action=\"${NOM_PAGE}?inst_lang=".$inst_lang."&etape=4\" name=\"form1\" id=\"form1\">\n";
  echo "<INPUT type=\"hidden\" name=\"config\" value=\"1\">\n";
  echo "<INPUT type=\"hidden\" name=\"serveur\" value=\"".htmlspecialchars(stripslashes($serveur))."\">\n";
  echo "<INPUT type=\"hidden\" name=\"nomdb\" value=\"".htmlspecialchars(stripslashes($nomdb))."\">\n";
  echo "<INPUT type=\"hidden\" name=\"utilisateur\" value=\"".htmlspecialchars(stripslashes($utilisateur))."\">\n";
  echo "<INPUT type=\"hidden\" name=\"motdepasse\" value=\"".htmlspecialchars(stripslashes($motdepasse))."\">\n";
  echo "<INPUT type=\"hidden\" name=\"prefix\" value=\"".htmlspecialchars(stripslashes($prefix))."\">\n";
  echo "<TABLE align=\"center\" border=0 cellspacing=2 cellpadding=2 style=\"text-align:left;\">\n";
  echo "<TR><TD>".trad("INSTALL_CONNECT")."</TD><TD><SELECT name=\"cheminabsolu\"><OPTION value=\"true\">".trad("INSTALL_CONNECT_A")."</OPTION><OPTION value=\"false\" selected>".trad("INSTALL_CONNECT_R")."</OPTION></SELECT></TD><TD><I>".trad("INSTALL_CONNECT_DEF")."</I></TD></TR>\n";
  echo "<TR><TD>".trad("INSTALL_MAJCFG_LANG")."</TD><TD><SELECT name=\"langue\">".listeLangue($inst_lang)."</SELECT></TD><TD><I>".trad("INSTALL_MAJCFG_LANG_DEF")."</I></TD></TR>\n";
  echo "<TR><TD colspan=3 align=\"center\"><BR><INPUT type=\"submit\" name=\"envoyer\" value=\"".trad("INSTALL_BT_VALIDER")."\"></TD></TR>\n";
  echo "</TABLE>\n";
  echo "</FORM>";

  echo "</TD></TR>\n";
}

//backup 1,2,3
//Sauvegarde de la base de donnees
elseif ($backup) {
  switch ($backup) {
    case 1 : $titrePage = trad("INSTALL_BACKUP_TITRE1"); break;
    case 2 : $titrePage = trad("INSTALL_BACKUP_TITRE2"); break;
    case 3 : $titrePage = trad("INSTALL_BACKUP_TITRE3"); break;
  }
  echo "<TR><TD bgcolor=\"#D7DFE7\" align=\"center\"><B>".sprintf(trad("INSTALL_ETAPE"),$backup)."</B><BR>".$titrePage."</TD></TR>\n";
  echo "<TR><TD bgcolor=\"#EFEFEF\">";
  if ($backup==1) {
    $_GET['msg'] = 6; //Empeche la connexion a la base de donnees
    (@include($file_config)) or die ("<IMG border=0 src=\"actionko.gif\"><FONT color=\"#ff0000\">".trad("INSTALL_ERR_MAJ_CFG")."</FONT><BR><BR><FORM method=\"post\" action=\"${NOM_PAGE}?inst_lang=".$inst_lang."\"><INPUT type=\"submit\" name=\"envoyer\" value=\"".trad("INSTALL_RETOUR")."\"></FORM></CENTER><BR></TD></TR>".$piedPage);
  }
  include("xtdump.php");
  echo "</TD></TR>\n";
}


echo $piedPage;
?>
