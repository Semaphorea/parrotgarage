<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;  
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ApiService;
use App\Service\HorairesService;
class ServicesController extends AbstractController
{

    private  $apiservice;
    private HorairesService $horairesService;
 
    function __construct(ApiService $apiservice,HorairesService $horairesService){
        $this->horairesService=$horairesService;
        $this->apiservice=$apiservice;

        
    }


    #[Route('/services', name: 'app_services')]
    public function index(Request $request): Response
    {
        $routeName= $request->attributes->get('_route');
        $page= substr($routeName,strpos($routeName,'_')+1, strlen($routeName));

        $title= $this->getParameter('app_title_website');
        $listepage= $this->getParameter('app_list_page');
        $horaires=$this->horairesService->fetchHoraires(); 
        
         $services= $this->apiservice->fetchdonnees('services','GET');
                                               
            $ret=[];           
          
            foreach (  json_decode($services[0]->services) as $key => $value) {
                foreach ($value as $key2 => $serv) {                    
                    foreach ($serv as $key3=>$servs) {  
                        foreach ($serv as $key4 => $s){                                 
                             $donnees=   array();
                             foreach( $s as $s2)                              
                                  array_push($donnees,$s2);           
                              }                            
                                  array_push($ret,[$key4=>$donnees]);  
                    }
                } 
            } 
            //dump($ret);

        return $this->render('services/index.html.twig', [
            "services"=>$ret,  
            "navitem"=>$listepage,
            "page"=>$page ,  
            "title"=>$title, 
            "horaires"=>$horaires
        ]);
    
}}
