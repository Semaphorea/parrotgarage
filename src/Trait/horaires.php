<?php 


use App\Service\ApiService;
 
Trait Horaires{
 


    public function __construct(private ApiService $apiService){
        $this->apiService=$apiService;
    }

    /**
    * function fetchHours
    * return table of week Hours[[ [default] => [morning_begin, morning_end,afternoon_begin, afternoon_end], [monday] => [morning_begin, morning_end,afternoon_begin, afternoon_end],...]]
    */
     function fetchHours(){

              $horaires= $this->apiService->fetchDonnees('horaires','GET');
              $this->twig->$GLOBALS["horaires"]=$horaires; 
              //TODO : Si les horaires sont identiques -> mettre une seule ligne  
              return $horaires;

     }

    /**
     * function hoursDisplayed
     * return table hours displayed
     * toCheck 15/01/2024  
     */
    function hoursDisplayed(){
              
            $ret=[];
              $horaires=$this->twig->$GLOBALS["horaires"];
                
                
                  foreach ($horaires as $key => $value) {
                          if($value != $key['default']){ 
                            $ret[$key]= $value;
                          }
                 }  

            return $ret ;          

    }
   


}