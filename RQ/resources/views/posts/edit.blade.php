@extends('posts.layout')

@section('title', 'Update post')

@section('content')
    <div class="card" style="margin: 20px;">
        <div class="card-header">
            Update post info
        </div>
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

        <div class="card-body">
            <form action="{{ route('posts.update', $posts->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" id="id" value="{{ $posts->id }}" class="form-control"><br />
                <label>Title</label><br />
                <input type="text" name="title" id="title" value="{{ $posts->title }}" class="form-control"><br />
                <label>Description</label><br />
                <input type="text" name="description" id="description" value="{{ $posts->description }}"
                    class="form-control"><br />
                <label>Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <br />
                <input type="submit" value="Update" class="btn btn-success"><br />
            </form>
        </div>
    </div>
@endsection
