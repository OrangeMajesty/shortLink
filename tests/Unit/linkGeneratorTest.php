<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LinkGeneratorUnitTest extends TestCase
{
	use DatabaseMigrations;

	public function testValideShortLink()
	{
		$this->visitRoute('redirectToFull', ['short' => "unregisteredlink"])
			 ->see("Link in not defined.");
	}

	public function testRegisterAndCheckLink() 
	{
		$testLink = route('testLink');
		$response = $this->post(route('generate'), ['full' => $testLink]);

		$shortCode = $response->response->getContent();

		$this->visitRoute('redirectToFull', ['short' => $shortCode])
			 ->seePageIs($testLink);
	}
}