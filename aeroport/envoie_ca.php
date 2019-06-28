<?php
   session_start();

    function decrypter($need)
    {
        $need = base64_decode($need);
        $key = "x9f5h1t8y9";
        $iv_size = mcrypt_get_iv_size(MCRYPT_XTEA, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypt = mcrypt_decrypt(MCRYPT_XTEA, $key, $need, MCRYPT_MODE_ECB, $iv);
        return $decrypt;
    }



    if(isset($_POST['paiement_ca']))
    {
        $decrypted = trim(decrypter($_POST['paiement_ca']));

        $tab_decrypted = explode("-|-", $decrypted);
        
        $dirname = dirname(__FILE__);

        require_once($dirname . "/../../libs/config.php");

        //mode d'appel
        $PBX_MODE        = '4';    //pour lancement paiement par exécution

        global $site_ca, $identifiant_ca, $rang_ca, $mode_paypal;

        //identification
        $PBX_SITE        = $site_ca;
        $PBX_RANG        = $rang_ca;
        $PBX_IDENTIFIANT = $identifiant_ca;

        //gestion de la page de connection : paramétrage "invisible"
        $PBX_WAIT        = '0';
        $PBX_TXT         = " ";
        $PBX_BOUTPI      = "nul";
        $PBX_BKGD        = "white";

        //informations paiement (appel)
        $PBX_TOTAL       = intval($tab_decrypted[1]) * 100; // prix total en centimes
        $PBX_DEVISE      = '978'; // en euro
        $PBX_CMD         = str_replace("|", "-", $tab_decrypted[0]) . '-' . mt_rand() . time(); // variable "custom" de paypal
        $PBX_PORTEUR     = $tab_decrypted[2]; // adresse mail du client

        //informations nécessaires aux traitements (réponse)
        $PBX_RETOUR      = "montant:M\;ref:R\;trans:T\;auto:A\;typePaiement:P\;carte:C\;idtrans:S\;pays:Y\;erreur:E\;validite:D\;IP:I\;BIN6:N\;sign:K";

        $PBX_EFFECTUE    = "http://www.alsace-navette.com/aeroport/reservation/paiement.html";
        $PBX_REFUSE      = "http://www.alsace-navette.com";
        $PBX_ANNULE      = "http://www.alsace-navette.com";


        //page en cas d'erreur
        $PBX_ERREUR      = "http://www.alsace-navette.com/aeroport/reservation/erreur_ca.html";

        //construction de la chaîne de paramètres
        $PBX             = "PBX_MODE=$PBX_MODE PBX_SITE=$PBX_SITE PBX_RANG=$PBX_RANG PBX_IDENTIFIANT=$PBX_IDENTIFIANT PBX_WAIT=$PBX_WAIT PBX_TXT=$PBX_TXT PBX_BOUTPI=$PBX_BOUTPI PBX_BKGD=$PBX_BKGD PBX_TOTAL=$PBX_TOTAL PBX_DEVISE=$PBX_DEVISE PBX_CMD=$PBX_CMD PBX_PORTEUR=$PBX_PORTEUR PBX_EFFECTUE=$PBX_EFFECTUE PBX_REFUSE=$PBX_REFUSE PBX_ANNULE=$PBX_ANNULE PBX_ERREUR=$PBX_ERREUR PBX_RETOUR=$PBX_RETOUR";

        //lancement paiement par exécution

        if($mode_paypal == "offline")
		{
            echo shell_exec("C:\wamp\bin\apache\Apache2.2.11\cgi-bin\modulev3_ca.exe $PBX");
		}
        else
		{
            echo shell_exec("../../cgi-bin/modulev3_ca.cgi $PBX");
         }   
    }

?>