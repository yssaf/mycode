@extends('layouts.admin')

@section('content')

    @if(count($comments) > 0)

        <h1>Comments</h1>

        <table class="table">
            <thead>
            <tr>
                <th>id</th>
                <th>User Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Comment</th>
                <th>Original Post</th>
                <th>Vetting</th>
                <th>Delete Comment</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{$comment->id}}</td>
{{--                    <td>
                        <img height="50" width="50"
                             src="{{$comment->photo ? $comment->photo : 'http://via.placeholder.com/50x50'}}" alt="">
                        </img>
                    </td>--}}
                    <td>{{$comment->author}}</td>
                    <td>{{$comment->email}}</td>
                    <td>{{$comment->body}}</td>
                    <td><a href="{{route('home.post', $comment->post->id)}}">View Post</a></td>

                    <td>
                        @if($comment->is_active == 1)
                            {{ Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) }}
                            <input type="hidden" name="is_active" value="0">
                            <div class="form-group">
                                {{ Form::submit('Un-approve Comment', ['class'=>'btn btn-info']) }}
                            </div>
                            {{ Form::close() }}
                        @else
                            {{ Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) }}
                            <input type="hidden" name="is_active" value="1">
                            <div class="form-group">
                                {{ Form::submit('Approve Comment', ['class'=>'btn btn-success']) }}
                            </div>
                            {{ Form::close() }}
                        @endif
                    </td>
                    <td>
                        {{ Form::open(['method'=>'Delete', 'action'=>['PostCommentsController@destroy', $comment->id]]) }}
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
        <h1 class="text-center">No Comments</h1>
    @endif

@stop