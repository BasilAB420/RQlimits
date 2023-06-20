@extends('posts.layout')

@section('title', 'Posts')
    
@section('content')
<div class="container">
    <div class="row" style="margin: 20px">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Posts</h2>
                </div>

                
                <a href="
                {{ route('posts.index') }}
                " title="view Student"><button
                    class="btn btn-primary my-5 ms-3">View Posts</button></a>




                <div class="card-body">
                    <a href="
                    {{ url('/posts/create') }}
                    " class="btn btn-success btn-sm" title="Add New Student">Add
                        New Post</a>
                    
                    <br /> <br />
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $item)
                                @php
                                 $users = DB::select("select * from users where id =$item->user_id");
                                @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        @foreach ( $users as $user)
                                        <td>{{ $user->name}}</td>
                                            
                                        @endforeach
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            <img  src='{{ url("uploads/imags/". $item->image) }}'
                                            style="height: 50px;width:100px;">
                                            
                                        </td>
                                        <td>
                                            <a 
                                            href="{{ route('posts.show', $item->id) }}"
                                                title="view Post"><button
                                                    class="btn btn-info">Show</button></a>

                                                  
                                            <a href="
                                            {{ route('posts.edit', $item->id) }}
                                                "
                                                title="update Student"><button
                                                    class="btn btn-success">Update</button></a>

                                

                                            <form action="{{ route('posts.destroy', $item->id) }}" method="POST"
                                                accept-charset="UTF-8" style="display: inline">
                                                @csrf
                                                @method('Delete')

                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    title="Delete Student">Delete</button>


                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection