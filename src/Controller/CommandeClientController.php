<?php

namespace App\Controller;

use App\Repository\CommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeClientController extends AbstractController
{
    #[Route('/c/commande/client', name: 'app_commande_client')]
    public function index(CommandeRepository $commandeRepository): Response
    {
        $commandes = $commandeRepository->findAll();
        return $this->render('commande_client/index.html.twig', [
            'commandes'=>$commandes,
        ]);
    }
}
