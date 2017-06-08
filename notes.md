# Episode 1: Initial DB Setup With Seeding

`php artisan make:model Thread -mr` with model and resource controller
`php artisan make:model Thread -mc` with model and controller

In `/database/factories/ModelFactory.php` we create factories for Threads and Replies.

# Episode 2: Test Driving Threads

Route model binding

```php
// routes.php
Route::get('/threads/{thread}', 'ThreadsController@show');

// ThreadsController.php
protected function show(Thread $thread) {
	return $thread;	
}
```

Initial Threads Testing

`assertSee`

# Episode 3: A Thread can have Replies

`php artisan make:test ReplyTest --unit`


# Episode 4: A User may responsd to Threads

When using `setUp` function in a Test, always remember to call parent::setUp().

Added `ParticipateInForumTest` 

# Episode 5: The Reply form

`route('login')`

`auth()->check()`

# Episode 6: A User Can Publish

Created `CreateThreadsTest.php` that contains create thread related tests.

The flow of the test includes 

1. Authenticating the user
2. Posting values to the create/update/delete endpoint
3. And checking if the action took effect.

# Episode 7: Let's make some helping testers

Add a function.php to be autoloaded during development only.

# Episode 8: The exception handling conundrum




