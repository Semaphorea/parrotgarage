<?php 

namespace App\Service; 
use App\Service\ApiService;

  
class HorairesService{


private ApiService $apiservice;   

function __construct(ApiService $apiservice)
{
    $this->apiservice = $apiservice;   
}  

function fetchHoraires(){
  
    $timetables=[];
       $horaires= $this->apiservice->fetchDonnees('timetables','GET');
       foreach($horaires as $horaire){
           if( $horaire->active == true){
               if( count($timetables) <= 6 ){ 
                
                     if(isset($horaire->day)){ 
                       array_push($timetables,  array($horaire->day,null,$horaire->timetable));  
                     }
                     if(isset($horaire->date)){
                        array_push($timetables,  array(null,$horaire->date,$horaire->timetable));
                     }
             }  

            }
        }
        
        return $timetables;



}

}