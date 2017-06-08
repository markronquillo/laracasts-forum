<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ThreadTest extends TestCase
{
	use DatabaseMigrations;

	protected $thread;

	public function setUp()
	{
		parent::setUp();

		$this->thread = create('App\Thread');
	}

	/** @test **/
	public function a_thread_has_replies() 
	{
		$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
	}

	/** @test **/
	public function a_thread_has_creator() 
	{
		$this->assertInstanceOf('App\User', $this->thread->owner);
	}

	/** @test **/
	public function a_thread_can_add_a_reply() 
	{
		$reply = make('App\Reply');
		
		$this->assertEquals(0, $this->thread->replies()->count());

		$this->thread->addReply($reply->toArray());

		$this->assertEquals(1, $this->thread->replies()->count());
	}
}
