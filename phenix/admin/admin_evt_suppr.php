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

//delevt 1,2
//Suppression des evenements crees par l'administrateur (eve_util_id=0)
if ($delevt) {
?>
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
      if (confirm('<?php echo trad("ADMIN_DELEVT_CONF"); ?>\n')) {
        theForm.submit();
        return (true);
      }
      return (false);
    }
  //-->
  </SCRIPT>
<?php 
  switch ($delevt) {
    case 1 : $titrePage = trad("ADMIN_DELEVT_TITRE"); break;
    case 2 : $titrePage = trad("ADMIN_DELEVT_TITRE1"); break;
  }

  AffSousTitre("<IMG align=\"absmiddle\" hspace=\"5\" border=0 src=\"image/admin/vider.png\">".trad("ADMIN_SUP_EVE"),"<B>".sprintf(trad("ADMIN_ETAPE"), $delevt)."</B> - ".$titrePage);

  if ($delevt==2 && isset($ztDate) && !empty($ztDate)) {
    // Verification de la date saisie
    list($j,$m,$a) = explode ("/",$ztDate);
    if (checkdate($m,$j,$a)) {
      $DB_CX->DbQuery("DELETE FROM ${PREFIX_TABLE}evenement WHERE eve_util_id=0 AND eve_date_fin<'$a-$m-$j'");
      if ($DB_CX->DbAffectedRows()) {
        echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionok.gif\" alt=\"\" align=\"absmiddle\">".$DB_CX->DbAffectedRows().sprintf(trad("ADMIN_DEL_CONF_TBL"), "${PREFIX_TABLE}evenement")."<BR>&nbsp;\n";
      } else {
        echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"ff0000\">".sprintf(trad("ADMIN_DELEVT_NO_ENRG"), "${PREFIX_TABLE}evenement")."</FONT><BR><BR>\n";
        $delevt = 1; // On reaffiche le choix de la date
      }
    } else {
        echo "  <BR>&nbsp;&nbsp;<IMG border=0 src=\"image/actionko.gif\" alt=\"\" align=\"absmiddle\"><FONT color=\"ff0000\">".trad("ADMIN_DELEVT_NO_DATE")."</FONT><BR><BR>\n";
      $delevt = 1; // On reaffiche le choix de la date
    }
  }
  if ($delevt==1) {
    echo ("  <BR><TABLE align=\"center\" border=0 cellspacing=2 cellpadding=2 width=\"400\" bgcolor=\"red\">
    <TR><TD><FONT color=\"white\"><B>".trad("ADMIN_RQ_SAUVE_BASE")."</B></FONT></TD></TR>
  </TABLE><BR>
  <FORM method=\"post\" action=\"${NOM_PAGE}&delevt=2\" name=\"frmAdmEvt\" id=\"frmAdmEvt\">
    <TABLE width=\"100%\" border=0 cellspacing=0 cellpadding=0>
      <TR><TD align=\"center\" height=\"20\">".trad("ADMIN_DELEVT_DATE_EFF")."&nbsp;&nbsp;<INPUT type=\"text\" name=\"ztDate\" id=\"ztDate\" value=\"".$ztDate."\" size=12 maxlength=10 title=\"".trad("ADMIN_FORMAT_DATE")."\" onKeyPress=\"return onlyChar(event);\" class=\"texte\">&nbsp;<INPUT type=\"button\" id=\"btCal\" value=\"...\" class=\"Picklist\" style=\"height:16px\" title=\"".trad("ADMIN_AFFICHER_CALENDRIER")."\"></TD></TR>
      <TR><TD align=\"center\" valign=\"middle\" height=\"30\"><INPUT type=\"button\" class=\"Bouton\" value=\"".trad("ADMIN_BT_SUPPRIMER")."\" onClick=\"javascript: return saisieOK(document.frmAdmEvt);\"></TD></TR>
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
