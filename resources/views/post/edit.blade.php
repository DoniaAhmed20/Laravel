@extends('layouts.app')

@section('title') Edit @endsection

@section('content')


<form action="{{ route('posts.store') }}" method="POST">
@csrf
    <div class="mb-3">
      <label for="disabledTextInput" class="form-label">Title</label>
      <input type="text" id="disabledTextInput" class="form-control" placeholder="Title input" value="{{$post['title']}}">
    </div>
    <div class="mb-3">
      <label for="disabledSelect" class="form-label">Discription</label>
      <input type="text" id="disabledTextInput" class="form-control" placeholder="Discription input" value="{{$post['discription']}}">

    </div>

    <div class="mb-3">
      <label for="disabledSelect" class="form-label">posted_by</label>
      <input type="text" id="disabledTextInput" class="form-control" placeholder="posted_by" value="{{$post['posted_by']}}">
    </div>



    <button type="submit" class="btn btn-primary">Edit</button>
</form>

@endsection
