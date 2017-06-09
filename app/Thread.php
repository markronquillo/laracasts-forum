<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

	public function path() 
	{
		return "/threads/{$this->channel->slug}/{$this->id}";
	}

	public function addReply($reply) 
	{
		return $this->replies()->create($reply);
	}

	//////////////////////////////////////////////////////

	public function replies() 
	{
		return $this->hasMany('App\Reply');
	}

	public function owner() 
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	public function channel() 
	{
		return $this->belongsTo('App\Channel');
	}
	
}
