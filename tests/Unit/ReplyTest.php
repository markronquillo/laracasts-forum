<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Reply;


class ReplyTest extends TestCase
{
	use DatabaseMigrations;
	
	/** @test **/
	public function it_has_an_owner()
	{
		$reply = create('App\Reply');

		$this->assertInstanceof('App\User', $reply->owner);
	}
}
