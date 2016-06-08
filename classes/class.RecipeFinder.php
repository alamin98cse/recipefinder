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
         

      }

      public function readRecipeList($recipeJSON){
               
                 
      }

      public function recipeToCook(){
         
        	 
       }

}