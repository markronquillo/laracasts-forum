<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

	public function setUp() {
		parent::setUp();

        $this->thread = create('App\Thread');
	}    

    /** @test */
    public function a_user_can_view_all_threads()
    {
		$this->get('/threads')
        	->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_view_a_specific_thread()
    {
        $this->get('/threads/' . $this->thread->id)
        	->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_the_thread() {
    	$reply = create('App\Reply', ['thread_id' => $this->thread->id]);
        
        $this->get('/threads/' . $this->thread->id)
        	->assertSee($reply->body);
    }
}
