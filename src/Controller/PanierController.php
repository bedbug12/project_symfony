<?php

namespace App\Controller;

use App\Entity\BurgerCommande;
use DateTimeImmutable;
use App\Entity\Commande;
use App\Entity\MenuCommande;
use App\Repository\BurgerCommandeRepository;
use App\Repository\ClientRepository;
use App\Repository\PanierRepository;
use App\Repository\CommandeRepository;
use App\Repository\MenuCommandeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    #[Route('/c/panier', name: 'app_c_panier')]
    public function index(PanierRepository $panierRepository): Response
    {
        $paniers = $panierRepository->findAll();
        $montant = 0;
        foreach ($paniers as $key => $value) {
            $montant += $value->getMontant();
        }
        return $this->render('panier/index.html.twig',[
            "paniers" => $paniers,
            "montant" => $montant,
        ]);
    }



    #[Route('/c/panier/commander/{qtes}', name: 'app_c_commander_panier')]
    public function commander($qtes,PanierRepository $panierRepository,ClientRepository $clientRepository,CommandeRepository $commandeRepository,MenuCommandeRepository $menuCommandeRepository,BurgerCommandeRepository $burgerCommandeRepository): Response
    {
        $qtes=explode(",",$qtes);
        $paniers = $panierRepository->findAll();
        $client = $clientRepository->findOneBy(['id' => 1]);
        $commande=new Commande();
        $date = new DateTimeImmutable();
        $commande->setClient($client)
            ->setDateCmdeAt($date)
            ->setEtat("en cours");
       
        $montant=0.0;
        $numero = "";

        foreach ($paniers as $key => $value) {
            $montant = $montant + $value->getMontant()*floatval($qtes[$key]);
            $numero=$value->getId();
        }
        $commande->setMontant($montant)
            ->setNumero($numero);
        $commandeRepository->save($commande, true);
        $commandes = $commandeRepository->findAll();
        $commande=end($commandes);



        foreach ($paniers as $key => $value) {
            if ($value->getMenu()!=null) {
                $menuCommande=new MenuCommande();
                $menuCommande->setCommande($commande)
                ->setMenu($value->getMenu())
                ->setQteMenu(intval($qtes[$key]));
                $menuCommandeRepository->save($menuCommande,true);
            }else{
                $burgerCommande=new BurgerCommande();
                $burgerCommande->setCommande($commande)
                ->setBurger($value->getBurger())
                ->setQteBurger(intval($qtes[$key]));
                $burgerCommandeRepository->save($burgerCommande,true);              
            }
        }



        foreach ($paniers as $key => $value) {
            $panierRepository->remove($value,true);
        }
        

        return $this->redirectToRoute('app_c_catalogue');
    }




    #[Route('/c/panier/vider', name: 'app_c_vider_panier')]
    public function vider(PanierRepository $panierRepository): Response
    {
        $paniers = $panierRepository->findAll();
        foreach ($paniers as $key => $value) {
            $panierRepository->remove($value,true);
        }
        return $this->redirectToRoute('app_c_panier');
    }





    #[Route('/c/panier/supprimer/{idC}', name: 'app_c_supprimer_panier')]
    public function suprimer($idC,PanierRepository $panierRepository): Response
    {
        $commande = $panierRepository->findOneBy(['id' => $idC]);
        $panierRepository->remove($commande,true);
        return $this->redirectToRoute('app_c_panier');
    }
}


