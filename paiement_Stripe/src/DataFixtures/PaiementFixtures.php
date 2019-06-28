<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Paiement;

class PaiementFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i <= 10; $i++) { 
            $paiements= new Paiement();
            
            $paiements  ->setCreatedAt(new \DateTime())  
                        ->setNumeroCarte(48594785632501458)
                        ->setNomCarte("Michel dupont")
                        ->setCvcCarte(596)
                        ->setDateCarte(new \DateTime());
                        
            $manager->persist($paiements);
        }
        $manager->flush();
    }
}
