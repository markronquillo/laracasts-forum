@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a new Thread</div>
                <div class="panel-body">
                    <form method="POST" action="/threads">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="channel_id">Choose a Channel</label>
                            <select name="channel_id" id="channel_id" class="form-control" required>
                                @foreach($channels as $channel)
                                    <option value="{{ $channel->id }}"
                                        {{ old('channel_id') == $channel->id ? 'selected' : '' }}>
                                        {{ $channel->slug }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="title" value="{{ old('title') }}" required />
                        </div>

                        <div class="form-group">
                            <label for="title">Body</label>
                            <textarea class="form-control" id="body" name="body" placeholder="body" row=8 value="{{ old('body') }}" required> </textarea>
                        </div>

                        <button type="submit" class="btn btn-default">Publish</button>

                        @if (count($errors))
                            <ul class="alert alert-danger">
                                @foreach($errors->all() as $error) 
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
