<?php

namespace App\Controller;

use Attribute;
use Doctrine\Common\Annotations\Annotation\Attributes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\HorairesService;
use App\Service\ApiService;

class AccueilController extends AbstractController
{
    private HorairesService $horairesService;
    private ApiService $apiservice;

    function __construct(ApiService $apiservice, HorairesService $horairesService)
    {
        $this->horairesService = $horairesService;
        $this->apiservice = $apiservice;
    }

    #[Route('/accueil', name: 'app_accueil')]
    public function accueil(Request $request): Response
    {
        $routeName = $request->attributes->get('_route');
        $page = substr($routeName, strpos($routeName, '_') + 1, strlen($routeName));
        $title = $this->getParameter('app_title_website');
        $listepage = $this->getParameter('app_list_page');
        $horaires = $this->horairesService->fetchHoraires();
        $notices = $this->apiservice->fetchDonnees('notices', 'GET');

        // foreach ($notices as $value) {
        //     $notices['visitor']= $this->apiservice->fetchDonnees('visitor/'.$notices['id_visitor'], 'GET');
            
        // }


        return $this->render('accueil/index.html.twig', [
            "navitem" => $listepage,
            "page" => $page,
            "title" => $title,
            "horaires" => $horaires,
            "notices"=>$notices,    
        ]);
    }


    #[Route('/Accueil', name: 'app_accueil2')]
    public function accueil2(Request $request): Response
    {

        return $this->redirectToRoute("accueil");
    }
}
