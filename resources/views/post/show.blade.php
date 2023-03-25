@extends('layouts.app')

@section('title') Show @endsection

@section('content')
<div class="card mt-6">
    <div class="card-header">
        Post Info
    </div>
    <div class="card-body">
        <h4 class="card-title">Title: {{$post['title']}}</h4>
        <h5 class="card-text">Description: {{$post['description']}}</h5>
    </div>
</div>

<div class="card mt-6">
    <div class="card-header">
        Post Creator Info
    </div>
    <div class="card-body">
        <h5 class="card-title">Name:{{$post->user->name}}
        </h5>

        <h5 class="card-title">Email: {{$post->user->email}}</h5>
        <h5 class="card-text">Created At:
            {{( $post->created_at )->format('l jS \\of F Y h:i:s A'); }}</h5>
    </div>
</div>

<!-- Add commment -->
<div class="card">
    <div class="card-header">
        Comments
    </div>
    <div class="card-body">
        <form
            action="{{route('comments.store',$post->id)}}"
            method="POST">
            @csrf

            <div class="form-group">
                <textarea name="comment" id="body" cols="15" rows="4" class="form-control"
                    placeholder="Your comment here"></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary" style=" margin-top:10px; margin-bottom:10px;">Add Comment</button>
            </div>
        </form>
        @if(isset($comments))
        @foreach($comments as $comment)
        <div class="card">
            <div class="card-header">
                {{$post->user->name}}
            </div>
            <div class="card-body">
                <div>
                    <span style="font-size: 1.2rem; font-weight: bold">Comment: </span>
                    {{$comment->comment}}
                </div>
                <div>
                    <span style="font-size: 1rem; font-weight: bold">Created At: </span>
                    {{ \Carbon\Carbon::parse($comment->created_at)->format('l jS \\of F Y h:i:s A') }}
                </div>
                <div>
                    <span style="font-size: 1rem; font-weight: bold">By: </span>

                    {{ $post->user->name }}
                </div>
            </div>
        </div>
        <form method="POST" action="{{ route('comments.destroy', $comment->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" style=" margin-top:10px">Delete</button>
        </form>
    </div>

    <form method="POST" action="{{ route('comments.update', $comment->id) }}" id="edit-comment-form-{{$comment->id}}">
        @csrf
        @method('PUT')
        <div class="form-group">

            <textarea class="form-control" id="body" name="body" rows="3" style="margin-left: 16px; width:1260px">{{$comment->body}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary" style="margin-left: 16px; margin-top:10px">Update</button>
    </form>
    @endforeach
    @else
    <div>No comments yet</div>
    @endif


@endsection
