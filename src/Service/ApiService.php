<?php 

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

  class ApiService{
   
    private $port;
    private $server;
    public function __construct(private HttpClientInterface $client, private ContainerBagInterface $params){

      $this->port=$this->params->get('app_port_server');
      $this->server=$this->params->get('app_url_server');
    }

    function fetchDonnees($request,$method,$donnees='{}'){  

      

      $header=["headers"=> ["Access-Control-Allow-Origin"=>"*",
      "Content Type"=>"application/json", 
      "Access-Control-Allow-Method"=>$method,
      "Access-Control-Allow-Headers"=>"Content-Type",
      "encode"=>"utf-8",
      "content"=>$donnees,  
      "ssl"=>array(
        "verify_peer"=>FALSE,
        "verify_peer_name"=>FALSE,
        'allow_self_signed'  => TRUE
     )  
                           ],
                           
                            
       ];  
  

      //var_dump($request);
        $response= $this->client->request($method,'http://'.$this->server.':'.$this->port.'/garage/'.$request,$header);                      
        $statusCode = $response->getStatusCode();
        if($statusCode == 200 ){      
      
        return json_decode($response->getContent());  
        
        }else{$e=new \Exception("Function fetchDonnees , L22 : Erreur : Impossibilité de récuperer les données"); 
         }

      
    
}


  }