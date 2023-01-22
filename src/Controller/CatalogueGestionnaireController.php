<?php

namespace App\Controller;

use App\Entity\Boisson;
use App\Entity\Frite;
use App\Entity\Burger;
use App\Form\BurgerType;
use App\Repository\FriteRepository;
use App\Repository\BurgerRepository;
use App\Repository\BoissonRepository;
use App\Repository\ComplementRepository;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CatalogueGestionnaireController extends AbstractController
{
    #[Route('/g/catalogue/gestionnaire/{typeAr?}', name: 'app_g_catalogue_gestionnaire')]
    public function index($typeAr,FriteRepository $friteRepository,BoissonRepository $boissonRepository,
    BurgerRepository $burgerRepository,Request $request): Response
    {
        $burgers=$burgerRepository->findAll();
        $frites=$friteRepository->findAll();
        $boissons=$boissonRepository->findAll();

        $burger = new Burger();
        $burgerForm=$this->createForm(BurgerType::class, $burger);
        $burgerForm->handleRequest($request);
        if ($burgerForm->isSubmitted() && $burgerForm->isValid()) {
            $newBurger = $burgerForm->getData();
            $nom=$newBurger->getNom();
            $prix=$newBurger->getPrix();
            if ($typeAr=="typeBurger") {
                $newBurger->setIsArchived(false);
                $burgerRepository->save($newBurger,true);
            }

            if ($typeAr=="typeFrite") {
                $newFrite = new Frite();
                $newFrite->setNom($nom);
                $newFrite->setPrix($prix);
                $newFrite->setIsArchived(false);
                $friteRepository->save($newFrite,true);
            }

            if ($typeAr=="typeBoisson") {
                $newBoisson = new Boisson();
                $newBoisson->setNom($nom);
                $newBoisson->setPrix($prix);
                $newBoisson->setIsArchived(false);
                $boissonRepository->save($newBoisson,true);
                
            }
            return $this->redirectToRoute('app_g_catalogue_gestionnaire');
        }

        return $this->render('catalogue_gestionnaire/index.html.twig', [
            "burgers"=>$burgers,
            "frites"=>$frites,
            "boissons"=>$boissons,
            "burgerForm"=>$burgerForm->createView(),
        ]);
    }

    #[Route('/g/catalogue/gestionnaire/modifier/{typeAr}/{idAr}', name: 'app_g_catalogue_ajouter_gestionnaire')]
    public function ajouter($idAr,$typeAr,FriteRepository $friteRepository,BoissonRepository $boissonRepository,
    BurgerRepository $burgerRepository,Request $request): Response
    {
        $burger = new Burger();
        if($typeAr=="typeBurger"){
            $burger=$burgerRepository->findOneBy(["id" => $idAr]);
        }
        if($typeAr=="typeFrite"){
            $frite=$friteRepository->findOneBy(["id" => $idAr]);
            $firstNom = $frite->getNom();
            $firstPrix = $frite->getPrix();
            $burger->setNom($firstNom);
            $burger->setPrix($firstPrix);
            $burger->setId($idAr);
        }
        if($typeAr=="typeBoisson"){
            $boisson=$boissonRepository->findOneBy(["id" => $idAr]);
            $firstNom = $boisson->getNom();
            $firstPrix = $boisson->getPrix();
            $burger->setNom($firstNom);
            $burger->setPrix($firstPrix);
            $burger->setId($idAr);
        }
        $burgerForm=$this->createForm(BurgerType::class, $burger);
        $burgerForm->handleRequest($request);
        if ($burgerForm->isSubmitted() && $burgerForm->isValid()) {
            $newBurger = $burgerForm->getData();
            $nom=$newBurger->getNom();
            $prix=$newBurger->getPrix();
            $id=$newBurger->getId();
            if ($typeAr=="typeBurger") {
                $newBurger->setIsArchived(false);
                $burgerRepository->save($newBurger,true);
                
            }

            if ($typeAr=="typeFrite") {
                $newFrite = new Frite();
                $newFrite->setNom($nom);
                $newFrite->setPrix($prix);
                $newFrite->setIsArchived(false);
                $newFrite->setId($id);
                $friteRepository->save($newFrite,true);
            }

            if ($typeAr=="typeBoisson") {
                $newBoisson = new Boisson();
                $newBoisson->setNom($nom);
                $newBoisson->setPrix($prix);
                $newBoisson->setIsArchived(false);
                $newBoisson->setId($id);
                $boissonRepository->save($newBoisson,true);
                
            }
            return $this->redirectToRoute('app_g_catalogue_gestionnaire');
        }


        return $this->redirectToRoute('app_g_catalogue_gestionnaire');
    }


    #[Route('/g/catalogue/gestionnaire/delArticleP/{idAr}', name: 'app_g_catalogue_delArticleP_gestionnaire')]
    public function delArticleProduit($idAr ,ProduitRepository $produitRepository) : Response{
        $produit = $produitRepository->findOneBy(['id' => $idAr]);
        $produitRepository->remove($produit,true);
        return $this->redirectToRoute('app_g_catalogue_gestionnaire');
    }


    #[Route('/g/catalogue/gestionnaire/delArticleC/{idAr}', name: 'app_g_catalogue_delArticleC_gestionnaire')]
    public function delArticleComplement($idAr ,ComplementRepository $complementRepository) : Response{
        $complement = $complementRepository->findOneBy(['id' => $idAr]);
        $complementRepository->remove($complement,true);
        return $this->redirectToRoute('app_g_catalogue_gestionnaire');
    }
	
}
