@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $thread->title }}</div>

                <div class="panel-body">
                    <article>
                        <div class="body">
                            {{ $thread->body }}
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach($thread->replies as $reply) 
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#">
                        {{ $reply->owner->name }} 
                        </a> said {{ $reply->created_at->diffForHumans()}}
                    </div>
                    <div class="panel-body">
                        <article>
                            <div class="body">
                                {{ $reply->body }}
                            </div>
                        </article>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    @if(auth()->check())
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form method="POST" action="{{ $thread->path() . '/replies' }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <textarea name="body" id="body" class="form-control" placeholder="Have something to say?"></textarea> 
                    </div>

                    <button type="submit" class="btn btn-submit">Post</button>
                </form>
            </div>
        </div>
    @else 
        <p>Please <a href="{{ route('login') ">signin</a> to participate in the forum.</p>
    @endif
</div>
@endsection
