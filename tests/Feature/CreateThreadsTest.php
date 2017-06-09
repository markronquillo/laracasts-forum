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
		$this->withExceptionHandling();

		$this->get('/threads/create')
			->assertRedirect('/login');

		$this->post('/threads')
			->assertRedirect('/login'); 
	}

	/** @test */
	function an_authenticated_user_can_create_forum_threads()
	{
		// Given an authenticated user
		$this->signIn($user = create('App\User'));

		// when we hit an endpoint to create a new thread
		$thread = make('App\Thread');

		$response = $this->post('/threads', $thread->toArray());

		// then we visit the thread page
		$this->get($response->headers->get('Location'))
 			->assertSee($thread->title)
			->assertSee($thread->body);
	}

	/** @test */
	function a_thread_requires_a_title()
	{

		$this->publishThread(['title' => null])
			->assertSessionHasErrors('title');
	}

	/** @test */
	function a_thread_requires_a_body()
	{

		$this->publishThread(['body' => null])
			->assertSessionHasErrors('body');
	}

	/** @test */
	function a_thread_requires_a_valid_channel()
	{
		factory('App\Channel', 2)->create();

		$this->publishThread(['channel_id' => null])
			->assertSessionHasErrors('channel_id');

		$this->publishThread(['channel_id' => 999])
			->assertSessionHasErrors('channel_id');
	}

	public function publishThread($overrides = [])
	{
		$this->withExceptionHandling()->signIn();

		$thread = make('App\Thread', $overrides);

		return $this->post('/threads', $thread->toArray());
	}
}
