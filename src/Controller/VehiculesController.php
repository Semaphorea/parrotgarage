<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\HttpFoundation\Request;  
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ApiService;  
use App\Entity\Vehicule;

use \App\Service\HorairesService;


class VehiculesController extends AbstractController
{
    private  $apiservice;
    private HorairesService $horairesService;

    function __construct(ApiService $apiservice,HorairesService $horairesService){
        $this->horairesService=$horairesService;
        $this->apiservice=$apiservice;  
  
        
    }

    #[Route('/vehicules', name: 'app_vehicules')]
    public function index(Request $request): Response  
    {
        $routeName= $request->attributes->get('_route');
        $page= substr($routeName,strpos($routeName,'_')+1, strlen($routeName));

        $title= $this->getParameter('app_title_website');
        $listepage= $this->getParameter('app_list_page');
          
        $horaires=$this->horairesService->fetchHoraires(); 
        $vehicules= $this->apiservice->fetchdonnees('vehicules','GET');    
        



     


       //  var_dump($vehicules);
     
        return $this->render('vehicules/index.html.twig', [
            "vehicules"=>$vehicules,  
            "navitem"=>$listepage,
            "page"=>$page ,  
            "title"=>$title,   
            "horaires"=>$horaires
        ]);
    }
}
