<?php

class TestRecipeFinder extends PHPUnit_Framework_TestCase{


	public function testRecommend(){
		$recipe = new RecipeFinder();
		$this->assertEquals('grilled cheese on toast',$recipe->recipeToCook());
	}

}
$test = new TestRecipeFinder;
$test->testRecommend();