@extends('layouts.app')

@section('title') Create @endsection

@section('content')

<form action="{{ route('posts.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label for="disabledSelect" class="form-label">Title</label>
    <input type="text" class="form-control" id="disabledTextInput" name="title" placeholder="Title input" required>
  </div>
  <div class="mb-3" style="height: 7rem;">
    <label for="disabledSelect" class="form-label">Discription</label>
    <input type="text" class="form-control h-75" id="disabledTextInput"  name="discription" placeholder="Discription input" required>
  </div>
  <div class="mb-3">
    <label for="disabledSelect" class="form-label">Post Creator</label>
    <input type="text" class="form-control" id="disabledTextInput"  name="PostCreator" placeholder="posted_by" required>
  </div>
  <button type="submit" class="btn btn-primary">Create</button>

</form>

@endsection
