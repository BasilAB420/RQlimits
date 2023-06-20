@extends('posts.layout')

@section('title', 'Create Posts')

@section('content')
   

    @if (Session::has('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Error!</h4>
            <p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            </p>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card" style="margin: 20px;">
        <div class="card-header">
            Create New Post
        </div>
        <div class="card-body">
            <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <label>Title</label><br />
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>

                <br>
                <label>Description</label><br />
                <input type="text" name="description" id="description" class="form-control" value="{{ old('description') }}">
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <br>
                <br>
                <label>Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <br> <br>
                <select name="user_id" id="user_id">
                @foreach ($users as $user)

                    <option value="{{$user->id}}">{{ $user->name }}</option>
                @endforeach

                </select>
                <br><br><br>
                <input type="submit" value="Save" class="btn btn-success"><br />
            </form>
        </div>
    </div>
@endsection
