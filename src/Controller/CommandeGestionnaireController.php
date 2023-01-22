<?php

namespace App\Controller;

use DateTimeInterface;
use App\Repository\CommandeRepository;
use DateTime;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\Date;

class CommandeGestionnaireController extends AbstractController
{
    #[Route('/g/commande/gestionnaire', name: 'app_commande_gestionnaire')]
    public function index(CommandeRepository $commandeRepository): Response
    {
        $commandes = $commandeRepository->findAll();
        return $this->render('commande_gestionnaire/index.html.twig', [
            'commandes'=>$commandes,
        ]);
    }



    #[Route('/g/commande/gestionnaire/filter', name: 'app_commande_filter_gestionnaire')]
    public function filter(Request $request,CommandeRepository $commandeRepository): Response
    {
        $date=$request->request->get('date');
        $date=explode("/",$date);
        $jj = intval($date[0]);
        $mm = $date[1];
        $aa = intval($date[2]);
        $dateS = new DateTime();
        $dateS->setDate($aa,$mm,$jj);
        $commandes = $commandeRepository->findBy(["dateCmdeAt"=>  $dateS]);
        return $this->render('commande_gestionnaire/index.html.twig', [
            'commandes'=>$commandes,
        ]);
    }
}
