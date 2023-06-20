@extends('posts.layout')

@section('title', 'Show post')

@section('content')
    <div class="card" style="margin: 20px">
        <div class="card-header">
            Post Page
        </div>
        <div class="card-body">
            <div class="card-title">
                @php
                    $users = DB::select("select * from users where id =$post->user_id");
                @endphp
               @foreach ( $users as $user)
                    <h5>{{ $user->name}}</h5>
                        
                    @endforeach 
                <p class="card-text">description: {{ $post->description }}</p>
                <p>
                    <img src='{{ url('uploads/imags/' . $post->image) }}' style="height: 50px;width:100px;">

                </p>
            </div>
        </div>
    </div>
@endsection
