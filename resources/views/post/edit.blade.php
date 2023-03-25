@extends('layouts.app')


@section('title') Update @endsection

@section('content')
<form class="mt-5" action="{{route("posts.update", $post['id'])}}" method="post">
    @csrf
    @method("put")
    <div class="mb-4">
        <label class="form-label">Title</label>
        <input type="text" class="form-control" value="{{$post['title']}}" name="title">
    </div>
    <div class="mb-4">
        <label class="form-label">Description</label>
        <div class="form-floating">
            <textarea name="description" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">{{$post['description']}}</textarea>
            <label for="floatingTextarea2">Post</label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
