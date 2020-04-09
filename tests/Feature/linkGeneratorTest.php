<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LinkGeneratorFeatureTest extends TestCase
{
	use DatabaseMigrations;

	public function testRegister() 
	{
		$this->visit('/')
			 ->type(route('testLink'), "full")
			 ->press('Сгенерировать')
			 ->seePageIs('/submitLink');
	}
}