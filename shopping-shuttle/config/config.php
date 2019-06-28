<?php

@session_start();

$config = simplexml_load_file(dirname(__FILE__) . '/config.xml');

$mode = $config->mode;

$host = (string) $config->$mode->host;  // adresse de la base de données
$user = (string) $config->$mode->user;  // nom d'utilisateur
$pass = (string) $config->$mode->pass;  // mot de passe
$bdd = (string) $config->$mode->bdd;    // nom de la base
$dsn = "mysql:host=" . $host . ";dbname=" . $bdd;   // chaine de connexion pour PDO
$gest_erreur = (((string)$config->$mode->erreur) == "false") ? false : true;   // pour activer la gestion d'erreur (seulement pour le développement)


$cache = (string) $config->$mode->cache;   // dossier pour les fichiers compilé par le moteur de templates
$file = (string) $config->$mode->fichier;  // dossier où il y a les templates


// pour pouvoir donner les liens en relatif
$baseurl_portail = (string) $config->$mode->portail;              // adresse de base du portail
$baseurl = $baseurl_portail . (string) $config->$mode->baseurl;   // adresse de base du site


// clés pour le paiement via Paypal
$MY_KEY_FILE = (string) $config->$mode->cle;
$MY_CERT_FILE = (string) $config->$mode->cert;
$PAYPAL_CERT_FILE = (string) $config->$mode->paypal;

$OPENSSL = (string) $config->$mode->openssl;   // chemin pour le programme de cryptage


$method_mail = (string) $config->$mode->m_mail;


// pour activer le mode maintenance
$_SESSION['config']['maintenance'] = (((string) $config->$mode->maintenance) == "false") ? false : true;
$_SESSION['config']['ip_autorise'] = (string) $config->$mode->ip;

$_SESSION['mode'] = (string) $mode; // mode online ou offline

// pour paypal
$mode_paypal = (string) $mode;
$cert_id_paypal = (string) $config->$mode->cert_id;
$owner_paypal = (string) $config->$mode->paypal_own;

// pour le paiement du crédit agricole
$site_ca = (string) $config->$mode->ca_site;
$identifiant_ca = (string) $config->$mode->ca_identifiant;
$rang_ca = (string) $config->$mode->ca_rang;


// pour les paiement
$active_paypal = (((string)$config->$mode->active_paypal) == "false") ? false : true;
$active_ca = (((string)$config->$mode->active_ca) == "false") ? false : true;


// pour afficher toutes les erreurs/notices PHP
$_SESSION['config']['error_reporting'] = (((string) $config->$mode->reporting) == "false") ? false : true;

// pour le formulaire de google maps
$_SESSION['google_maps'] = (string) $config->$mode->google;


unset($config);
?>
