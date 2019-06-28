<?php
	require_once('./includes/init_functions.php');
	require_once('../libs/Mail.php');
	session_start();
	
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{		
		if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['motif']) && isset($_POST['message']))
		{
			$nom = trim(htmlspecialchars($_POST['nom']));
			$prenom = trim(htmlspecialchars($_POST['prenom']));
			$mail = trim(htmlspecialchars($_POST['mail']));
			$raison = intval(htmlspecialchars($_POST['motif']));
			$message = trim(htmlspecialchars($_POST['message']));
			
			if(!empty($nom) && !empty($prenom) && !empty($mail) && !empty($message))
			{
				if(is_mail_valide($mail))
				{
					switch ($raison)
					{
						case 0:
						$motif = $lang_renseignement;
						break;
						
						case 1:
						$motif = $lang_probleme_technique;
						break;
						
						default:
						$motif = $lang_partenariat;
						break;
					}
					$sujet = "[Shopping Shuttle] ".$lang_formulaire_contact." : " . $motif;
					
					$mesg = $lang_nom." : " . $nom . "<br />".$lang_prenom." : " . $prenom . "<br />".$lang_email." : " . $mail . "<br /><br />" . $message;
					
					$mailer = new Mail();
					
					$mailer->Subject = $sujet;
					$mailer->Body = "<html><head></head><body>" . $mesg . "</body></html>";
					$mailer->AddAddress("info@alsace-navette.com");
					$mailer->ClearReplyTos();
					$mailer->AddReplyTo($mail, $nom . " " . $prenom);

					if($mailer->Send())
					{								
						$_SESSION['erreur_contact'] = $lang_contact_ok;
						$_SESSION['class_contact'] = "valide";
					}
					else
					{
						$_SESSION['erreur_contact'] = $lang_contact_erreur;
					}
				}
				else
				{
					$mail = "";
					$_SESSION['erreur_contact'] = $lang_mail_invalide;
				}
			}
			else
			{
				$_SESSION['erreur_contact'] = $lang_erreur_champ_vide;
			}
		}
		else
		{
			$_SESSION['erreur_contact'] = $lang_donnees_incorrectes;
		}
	}
?>
<html>
	<head>
		<title><?php echo $lang_titre_contact.' :: '.$lang_titre_main; ?></title>
		
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
		<meta name="Language" content="fr" />		
		<meta name="viewport" content="width=device-width, initial-scale=1">	
		
		<link rel="stylesheet" type="text/css" href="styles/base.css" media="all" />
		<link rel="stylesheet" type="text/css" href="styles/style.css" media="screen" />
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	</head> 
	<body> 

		<div id="global">
			<!-- On insère le header + le menu -->
			<?php require_once('./includes/include_entete_menu.php'); ?>
			
			<!-- Le contenu -->
			<div id="contenu" class="row">
				<!-- Titre de la page -->
				<h1><?php echo $lang_titre_contact; ?></h1>
				
				<!-- Partie gauche : raisons du contact et formulaire -->
				<div class="col-xs-12 col-sm-6 col-md-6 contact_gauche" style="margin-bottom:20px;">
					<?php if (isset($_SESSION['erreur_contact']))
					{
						if ($_SESSION['class_contact'] == 'valide')
						{
							$class = "vert";
						}
						else
						{
							$class = "rouge";
						}
						echo '<p class='.$class.' style="font-weight:bold;">'.$_SESSION['erreur_contact'].'</p>';
						unset($_SESSION['erreur_contact']);
					}?>
					
					<p style="border-top:3px solid black;padding-top:10px;"><?php echo $lang_texte_contact_gauche; ?></p>
					
					<h4 style="margin:20px 0;"><?php echo $lang_formulaire_contact; ?></h4>
					
					<form action="contact.php" method="post">
						<div class="row">
							<label for="nom" class="col-xs-12 col-sm-4 col-md-3"><?php echo $lang_nom; ?> <sup class="rouge">*</sup> : </label>
							<input type="text" name="nom" id="nom" class="col-xs-12 col-sm-8 col-md-9"/>
						</div>
						
						<div class="row">
							<label for="prenom" class="col-xs-12 col-sm-4 col-md-3"><?php echo $lang_prenom; ?> <sup class="rouge">*</sup> : </label>
							<input type="text" name="prenom" id="prenom" class="col-xs-12 col-sm-8 col-md-9"/>
						</div>
						
						<div class="row">
							<label for="mail" class="col-xs-12 col-sm-4 col-md-3"><?php echo $lang_email; ?> <sup class="rouge">*</sup> : </label>
							<input type="email" name="mail" id="mail" class="col-xs-12 col-sm-8 col-md-9"/>
						</div>
						
						<div class="row">
							<label for="motf" class="col-xs-12 col-sm-4 col-md-3"><?php echo $lang_motif; ?> <sup class="rouge">*</sup> : </label>
							<select name="motif" id="motif" class="col-xs-12 col-sm-8 col-md-9">
								<option value="0"><?php echo $lang_renseignement; ?></option>
								<option value="1"><?php echo $lang_probleme_technique; ?></option>
								<option value="2"><?php echo $lang_partenariat; ?></option>
							</select>
						</div>
						
						<div class="row">
							<label for="message" class="col-xs-12 col-sm-4 col-md-3"><?php echo $lang_message; ?> <sup class="rouge">*</sup> : </label>
							<textarea name="message" id="message" class="col-xs-12 col-sm-8 col-md-9" rows="5" style="max-width:100%;"></textarea>
						</div>
						
						<div class="row" style="text-align:center;">
							<sup class="rouge">*</sup> : <?php echo $lang_champs_requis ;?>
						</div>
						
						<div class="btn_submit row">
							<input type="submit" value="<?php echo $lang_envoyer; ?>"/>
						</div>
					</form>
				</div>
				
				<!-- Partie droite : moyens de contact et map Google -->
				<div class="col-xs-12 col-sm-6 col-md-6 contact_droite" style="margin-bottom:20px;">
					<div class="row" style="border-top:3px solid black;padding-top:10px;">
						<div class="col-xs-12 col-sm-12 col-md-6" style="padding:0;">
							<p><?php echo $lang_texte_contact_droite; ?></p>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6 picto_contact">
							<img src="images/picto_contact.png">
						</div>
					</div>
					<p class="row" style="margin-top:20px;">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1319.7404263325516!2d7.740734737440971!3d48.58149120418793!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4796c84c82a23f99%3A0xdd7206aff0e739da!2sAssociation+Franco+Iranienne+d&#39;Alsace!5e0!3m2!1sfr!2sfr!4v1432733092685" width="600" height="260" frameborder="0" style="border:0;max-width:100%;"></iframe>
					</p>
				</div>
				
			</div>
			
			<!-- Le pied de page -->
			<?php require_once('./includes/include_pied_de_page.php'); ?>
		</div>
		
	</body> 
</html>