<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateThreadsTest extends TestCase
{
	use DatabaseMigrations;

	/** @test */
	function guests_cannot_create_threads() 
	{
		$this->expectException('Illuminate\Auth\AuthenticationException');

		$thread = make('App\Thread');

		$this->post('/threads', $thread->toArray());
	}

	/** @test */
	function guests_cannot_see_create_thread_page() 
	{
		$this->withExceptionHandling()->get('/threads/create')
			->assertRedirect('/login');
	}

	/** @test */
	function an_authenticated_user_can_create_forum_threads()
	{
		// Given an authenticated user
		$this->signIn($user = create('App\User'));

		// when we hit an endpoint to create a new thread
		$thread = make('App\Thread');

		$this->post('/threads', $thread->toArray());

		// then we visit the thread page
		$this->get($thread->path())
 			->assertSee($thread->title)
			->assertSee($thread->body);
	}
}
