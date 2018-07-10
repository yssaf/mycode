@extends('layouts.admin')

@section('content')

    @if(count($replies) > 0)

        <h1>replies</h1>

        <table class="table">
            <thead>
            <tr>
                <th>id</th>
                <th>User Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>reply</th>
                <th>Original Post</th>
                <th>Vetting</th>
                <th>Delete reply</th>
            </tr>
            </thead>
            <tbody>
            @foreach($replies as $reply)
                <tr>
                    <td>{{$reply->id}}</td>
                    <td>
                        <img height="50" width="50"
                             src="{{$reply->photo ? $reply->photo : 'http://via.placeholder.com/50x50'}}" alt="">
                        </img>
                    </td>
                    <td>{{$reply->author}}</td>
                    <td>{{$reply->email}}</td>
                    <td>{{$reply->body}}</td>
                    <td><a href="{{route('home.post', $reply->comment->post->slug)}}">View Post</a></td>

                    <td>
                        @if($reply->is_active == 1)
                            {{ Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) }}
                            <input type="hidden" name="is_active" value="0">
                            <div class="form-group">
                                {{ Form::submit('Un-approve', ['class'=>'btn btn-info']) }}
                            </div>
                            {{ Form::close() }}
                        @else
                            {{ Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) }}
                            <input type="hidden" name="is_active" value="1">
                            <div class="form-group">
                                {{ Form::submit('Approve', ['class'=>'btn btn-success']) }}
                            </div>
                            {{ Form::close() }}
                        @endif
                    </td>
                    <td>
                        {{ Form::open(['method'=>'Delete', 'action'=>['CommentRepliesController@destroy', $reply->id]]) }}
                        <input type="hidden" name="is_active" value="1">
                        <div class="form-group">
                            {{ Form::submit('Delete', ['class'=>'btn btn-danger']) }}
                        </div>
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @else
        <h1 class="text-center">No Replies</h1>
    @endif

@stop