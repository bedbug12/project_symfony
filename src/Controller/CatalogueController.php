<?php

namespace App\Controller;

use App\Entity\Detail;
use App\Entity\Menu;
use App\Entity\Panier;
use App\Repository\BoissonRepository;
use App\Repository\BurgerRepository;
use App\Repository\FriteRepository;
use App\Repository\PanierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogueController extends AbstractController
{
    #[Route('/c/catalogue', name: 'app_c_catalogue')]
    public function index(FriteRepository $friteRepository,BoissonRepository $boissonRepository,
    BurgerRepository $burgerRepository): Response
    {
        $burgers=$burgerRepository->findAll();
        $frites=$friteRepository->findAll();
        $boissons=$boissonRepository->findAll();
        return $this->render('catalogue/index.html.twig',[
            "burgers"=>$burgers,
            "frites"=>$frites,
            "boissons"=>$boissons
        ]);
    }




    #[Route('/c/catalogue/ajouterArticle/{burgerId}/{friteId?}/{boissonId?}', name: 'app_c_catalogue_ajouterArticle')]
    public function ajouterArticle(FriteRepository $friteRepository,BoissonRepository $boissonRepository,
    BurgerRepository $burgerRepository,$burgerId,$friteId,$boissonId,PanierRepository $panierRepository): Response
    {
        $burger = $burgerRepository->findOneBy(['id' => $burgerId]);
        $frite = null;
        $boisson = null;
        $menu = null;
        if ($friteId != null) {
            # code...
            $frite = $friteRepository->findOneBy(['id' => $friteId]);
        }
        if ($boissonId != null) {
            # code...
            $boisson = $boissonRepository->findOneBy(['id' => $boissonId]);
        }

        if ($frite != null || $boisson != null) {
            # code...
            $menu = new Menu();
            $nomFrite=($frite!=null) ? ", ".$frite->getNom() : '';
            $nomBoisson=($boisson!=null) ? ", ".$boisson->getNom() : '';
            $prixFrite=($frite!=null) ? $frite->getPrix() : 0;
            $prixBoisson=($boisson!=null) ? $boisson->getPrix() : 0;
            $prixBurger = $burger->getPrix();
            $menu->setNom('Menu ('.$burger->getNom().$nomBoisson.$nomFrite.')')
                 ->setIsArchived(false);
            $menu->setBurger($burger)
                ->setBoisson($boisson)
                ->setFrite($frite)
                ->setPrix($prixBurger + $prixBoisson + $prixFrite);
        }
        $panier = new Panier();
        
        if ($menu!=null) {
            $panier->setMenu($menu) ;
            $panier->setMontant($menu->getPrix());
        } else {
            $panier->setBurger($burger);
            $panier->setMontant($burger->getPrix()); 
        }
        $panierRepository->save($panier,true);
        
      
       
        return $this->redirectToRoute('app_c_catalogue');
    }
}
