<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Paiement;
use App\Repository\PaiementRepository;
use App\Form\PaiementType;

class PaiementController extends AbstractController
{
    /**
     * @Route("/paiement", name="paiement")
     */
    //Page récapulative (test de la relation Base de donnée et du formulaire)
    public function index(PaiementRepository $repo)
    {

        $resa = $repo->findAll();
        return $this->render('paiement/index.html.twig', [
            'controller_name' => 'PaiementController',
            'reservation' => $resa
        ]);
    }

    /**
     * @Route("/", name="home")
     */

    //Page d'accueil de la page de paiement test
    public function home()
    {

        return $this->render('paiement/home.html.twig', [
            'title' => "Bonjour, bienvenu sur la partie paiement du site alsace-navette ",
            'age' => 12 // vérification age
        ]);
    }
    /**
     * @Route("/paiement/crea", name="paiement_create")
     * @Route("/paiement/{id}/edit", name="paiement_edit")
     */
    //Page d'ajout et d'édition (test relation base de donnée et du formulaire)
    public function form(Paiement $resa = null, Request $request, ObjectManager $manager)
    {
        if (!$resa) {
            $resa = new Paiement();
        }

        $form = $this->createForm(PaiementType::class, $resa);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$resa->getId()) {
                $resa->setCreatedAt(new \DateTime());
            }
            $manager->persist($resa);
            $manager->flush();
            return $this->redirectToRoute('paiement_show', ['id' => $resa->getId()]);
        }
        return $this->render('paiement/create.html.twig', [
            'formPaiement' => $form->createView(),
            'editMode' => $resa->getId() !== null
        ]);
    }


    /**
     * @Route("/paiement/add", name="paiement_ajout")
     */
    //Page de test pour effectuer un paiement sur Stripe
    public function ajout(Paiement $resa = null, Request $request)
    {


        $form = $this->createForm(PaiementType::class, $resa);

        $form->handleRequest($request);


        //création des variables qui vont permettre de définir les paramètres de notre carte de paiement
        $mois = $request->request->get('exp_month');
        $an = $request->request->get('exp_year');
        $cvc = $request->request->get('cvc');
        $nom = $request->request->get('name');
        $number = $request->request->get('number');


        //Définition de la clé Api (obligatoirement la clé secrète) et trouvable dans la partie développement du compte Stripe 
        \Stripe\Stripe::setApiKey('sk_test_YZcR0s9OaOBpAXHxjupNjYkh00Dn38k2ZU');

        if ($mois && $an && $cvc && $cvc && $nom && $number) {

            //Création du jeton qui va contenir les informations de la carte de paiement et utilisant les variables de dessus
            $token = \Stripe\Token::create([
                'card' => [
                    'number' => $number,
                    'exp_month' => $mois,
                    'exp_year' => $an,
                    'cvc' => $cvc,
                    'name' => $nom,
        
                ]
            ]);
            //Création d'un jeton client qui contient les informations sur le client qui va faire la réservation
            $customer = \Stripe\Customer::create([
                "description" => $nom, //Nom du client
                "source" => $token
            ]);


            //Envoie du jeton sur le serveur Stripe pour effecter le paiement selon le montant et le type de devise.
           $charge=\Stripe\Charge::create([
                'amount' => 90 * 100, //valeur toujours en centime
                'currency' => 'eur',
                'description' => 'test paye', //nom de la transaction bancaire
                'customer' => $customer,
            ]);
        }

        return $this->render('paiement/ajout1.html.twig');
    }
    /**
     * @Route("/paiement/{id}", name="paiement_show")
     */
    //Présentation des détails d'une réservation.
    public function show(Paiement $resa)
    {
        return $this->render('paiement/show.html.twig', [
            'paiement' => $resa,
        ]);
    }
}
