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
?>
<?php if ($delnote) { ?>
  <STYLE type="text/css">@import url(<?php echo $file_calendarcss; ?>);</STYLE>
  <SCRIPT type="text/javascript" src="<?php echo $file_calendarjs; ?>"></SCRIPT>
<?php
  include($file_calendarsetup);
  include($file_checkdatejs);
?>
  <SCRIPT language="JavaScript" type="text/javascript">
  <!--
    function saisieOK(theForm) {
      if (trim(theForm.ztDate.value) == "") {
        window.alert("<?php echo trad("ADMIN_JAVA_DATE"); ?>");
        theForm.ztDate.focus();
        return (false);
      }
      if (!chk_date_format(theForm.ztDate))
        return (false);
      if (confirm('<?php echo trad("ADMIN_JAVA_NOTE"); ?>\n')) {
        theForm.submit();
        return (true);
      }
      return (false);
    }
  //-->
  </SCRIPT>
<?php } ?>
<?php
//delnote 1,2
//Suppression des notes avant une date donnee
if ($delnote) {
  $zlUtil += 0;

  switch ($delnote) {
    case 1 : $titrePage = trad("ADMIN_DELNOTE_TITRE"); break;
    case 2 : $titrePage = trad("ADMIN_DELNOTE_TITRE1"); break;
  }

  AffSousTitre("<IMG align=\"absmiddle\" hspace=\"5\" border=0 src=\"image/admin/note.png\">".trad("ADMIN_SUP_NOTE"),"<B>".sprintf(trad("ADMIN_ETAPE"), $delnote)."</B> - ".$titrePage);

  if ($delnote==2 && isset($ztDate) && !empty($ztDate)) {
    // Verification de la date saisie
    list($j,$m,$a) = explode ("/",$ztDate);
    if (checkdate($m,$j,$a)) {
      if ($zlUtil>0) {
        $whereAgeUtil = " AND age_util_id=".$zlUtil;
        $whereAcoUtil = " OR aco_util_id=".$zlUtil;
      } else {
        $whereAgeUtil = "";
        $whereAcoUtil = "";
      }
      // Creation d'une nouvelle instance pour l'execution de requetes en boucle
      $DB = new Db($DB_CX->ConnexionID);
      $conditionWhere = "age_date<'$a-$m-$j' AND age_aty_id!=1".$whereAgeUtil;
      // On compte le nombre de note a supprimer
      $DB_CX->DbQuery("SELECT COUNT(*) FROM ${PREFIX_TABLE}agenda WHERE ".$conditionWhere);
      $maxLigne = $DB_CX->DbResult(0,0);
      $nbLigneDecoupe = 10000;
      $nbLigne = 0;
      $totAco = 0;
      // La longueur des requetes etant limite a 64k on decoupe la liste resultante
      while ($nbLigne<$maxLigne) {
        $DB_CX->DbQuery("SELECT age_id, age_mere_id, age_ape_id FROM ${PREFIX_TABLE}agenda WHERE ".$conditionWhere." ORDER BY age_id LIMIT ".$nbLigne.",".$nbLigneDecoupe);
        $liste = "0";
        while ($enr = $DB_CX->DbNextRow()) {
          $liste .= ",".$enr['age_id'];
          if ($enr['age_mere_id']==0 && $enr['age_ape_id']>1) {
            // Les occurrences d'une note recurente supprimee deviennent des notes independantes
            $DB->DbQuery("UPDATE ${PREFIX_TABLE}agenda SET age_mere_id=0, age_ape_id=1 WHERE age_mere_id=".$enr['age_id']);
          }
        }
        // On supprime les personnes concernees
        $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}agenda_concerne WHERE aco_age_id IN (".$liste.")");
        $totAco += $DB_CX->DbAffectedRows();
        $nbLigne += $nbLigneDecoupe;
      }
      // On supprime les notes
      $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}agenda WHERE ".$conditionWhere);
      $totAge = $DB_CX->DbAffectedRows();
      if ($totAge>0) {
        echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$totAge.sprintf(trad("ADMIN_DEL_CONF_TBL"), "${PREFIX_TABLE}agenda")."\n";
      } else {
        echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionko.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("ADMIN_DELNOTE_NO_ENRG"), "${PREFIX_TABLE}agenda")."\n";
      }
      if ($totAco>0) {
        echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$totAco.sprintf(trad("ADMIN_DEL_CONF_TBL"), "${PREFIX_TABLE}agenda_concerne")."<BR>";
      } else {
        echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionko.gif\" alt=\"\" align=\"absmiddle\">".sprintf(trad("ADMIN_DELNOTE_NO_ENRG"), "${PREFIX_TABLE}agenda_concerne")."<BR>";
      }
      echo "<BR>\n";
    } else {
      echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"ff0000\">".trad("ADMIN_DELNOTE_NO_DATE")."</FONT><BR><BR>\n";
      $delnote = 1; // On reaffiche le choix de la date
    }
  }
  if ($delnote==1) {
    //Recuperation de la liste des utilisateurs
    $DB_CX->DbQuery("SELECT util_id, CONCAT(".$FORMAT_NOM_UTIL.") AS nomUtil FROM ${PREFIX_TABLE}utilisateur ORDER BY nomUtil");
    echo ("  <BR><TABLE align=\"center\" border=0 cellspacing=2 cellpadding=2 width=\"400\" bgcolor=\"red\">
    <TR><TD><FONT color=\"white\"><B>".trad("ADMIN_RQ_SAUVE_BASE")."</B></FONT></TD></TR>
  </TABLE><BR>
  <FORM method=\"post\" action=\"${NOM_PAGE}&delnote=2\" name=\"frmAdmNote\" id=\"frmAdmNote\">
    <TABLE border=0 cellspacing=0 cellpadding=0 align=\"center\">
      <TR><TD height=\"20\">".trad("ADMIN_DELNOTE_DATE_EFF")."&nbsp;&nbsp;<INPUT type=\"text\" name=\"ztDate\" id=\"ztDate\" value=\"".$ztDate."\" size=12 maxlength=10 title=\"".trad("ADMIN_FORMAT_DATE")."\" onKeyPress=\"return onlyChar(event);\" class=\"texte\">&nbsp;<INPUT type=\"button\" id=\"btCal\" value=\"...\" class=\"Picklist\" style=\"height:16px\" title=\"".trad("ADMIN_AFFICHER_CALENDRIER")."\"></TD></TR>
       <TR><TD height=\"20\">".trad("ADMIN_DELNOTE_COMPTE")."&nbsp;&nbsp;<SELECT name=\"zlUtil\" size=1 tabindex=\"1\">
        <OPTION value=\"-1\">".trad("ADMIN_TOUS_COMPTE")."</OPTION>\n");
    while ($enr = $DB_CX->DbNextRow()) {
      $selected = ($zlUtil == $enr['util_id']) ? " selected" : "";
      echo "        <OPTION value=\"".$enr['util_id']."\"".$selected.">".$enr['nomUtil']."</OPTION>\n";
    }
    echo ("</SELECT></TD></TR>
     <TR><TD align=\"center\" valign=\"middle\" height=\"30\"><INPUT type=\"button\" class=\"Bouton\" value=\"".trad("ADMIN_BT_SUPPRIMER")."\" onClick=\"javascript: return saisieOK(document.frmAdmNote);\"></TD></TR>
    </TABLE>
  </FORM>
  <SCRIPT type=\"text/javascript\">
  <!--
    Calendar.setup( {
      inputField : \"ztDate\",    // ID of the input field
      ifFormat   : \"%d/%m/%Y\",  // the date format
      button     : \"btCal\"      // ID of the button
    } );
  //-->
  </SCRIPT>\n");
  }
}
?>
