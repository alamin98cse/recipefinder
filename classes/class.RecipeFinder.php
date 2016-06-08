<?php

class RecipeFinder {
  protected $fridge = array();
  protected $recipe = array();

      public function __construct(){
      	$files = include('classes/config.php');
      	$this->readFridge($files['fridgeCSV']);
      	$this->readRecipeList($files['recipeJSON']);
      }
      public function readFridge($fridgeCSV){
           $fridgeFile = file($fridgeCSV);
           $itemNo = 0;
           foreach ($fridgeFile as $line) {
                $this->fridge[$itemNo] = array();
                $this->fridge[$itemNo++] = str_getcsv($line);
             }            

      }

      public function readRecipeList($recipeJSON){
              $recipeFile = file_get_contents($recipeJSON);
              $this->recipe = json_decode($recipeFile); 
                
      }

      public function recipeToCook(){
          
           $recIndx = -1;

          foreach($this->recipe as $rec){
               $closest = 0;
               $numIng = count($rec->ingredients)-1;
               $numFItem = count($this->fridge);  
               $recommend[++$recIndx] = $rec->name;
               $useByDay[$recIndx] = 999;
             foreach($rec->ingredients as $recIng){
          
                foreach($this->fridge as $ing){
                    if($ing[0] == $recIng->item && $ing[1] >= $recIng->amount && $ing[2] == $recIng->unit){
                     $today = date_create(date('d-m-Y'));
                     $useBy = date_create(str_replace('/','-',$ing[3]));
                     $closest = date_diff($today,$useBy)->d;
                     $useByDay[$recIndx] = ($useByDay[$recIndx]>$closest) ? $closest : $useByDay[$recIndx];
                     reset($this->fridge);
                     break;
                    }
                  $numFItem--;         
                }
            
             if($numFItem<=0){
               unset($recommend[$recIndx]);
               unset($useByDay[$recIndx]);
              break;  
             }
            }
          } 
        if($recommend){
           $useByDay =array_flip($useByDay);
           ksort($useByDay);
           return $recommend[array_shift(array_slice($useByDay, 0, 1))]; 
         }
       else
          return "Order Takeout";
        	 
       }

}