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

Adam Wathan's fix for exception handling during testing.


# Episode 9: A Thread Should be assigned a channel.

We refactor the routes such that `/threads/channel/1` points to the thread page.

# Episode 10: How to Test Validation Errors

To test validation errors

1. Inside your test file, assert that `assertSessionHasErrors('name')` where name is the field name that fails the validation

2. Inside your controller, validate the request object by

```
$validate(request(), [
	'name' => 'required'
	'channel_id' => "required|exists:channel,1"
]);
```
 
# Episode 11: A User can filter threads

We have created a page that shows threads under a specific channel.

To change the key used in the Route model binding:

```php
public function getRouteKeyName()
{
	return 'slug';
}
```

# Episode 12 : Validation Errors and Old Data

In your blade.php file you can get the old (session) value (for failed post form requests) using `old('name')`.

```
@if (count($errors))
<ul class="alert alert-danger">
    @foreach($errors->all() as $error) 
        <li>{{ $error }}</li>
    @endforeach
</ul>
@endif
```

# Episode 13:

`\View::share('channels', ...)`

php artisan make:provider ViewServiceProvider

