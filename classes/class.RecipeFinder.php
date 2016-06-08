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

              print_r($this->recipe);    
                 
      }

      public function recipeToCook(){
         
        	 
       }

}