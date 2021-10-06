<x-admin-master>

    @section('content')
    <h1>Edit a Post</h1>
    <form action="{{route('post.update',$post->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" placeholder="Enter title" name="title"
                value="{{$post['title']}}">
        </div>
        <div class="form-group">
            <label for="file">File:</label>
            <div>
                <img height="100px" src="{{asset('images/' . $post['post_image'])}}">
            </div>
            {{$post['post_image']}}
            <br>
            <br>
            <input class="form-control-file" type="file" class="form-control" id="post_image"
                value="{{$post['post_image']}}" name="post_image">
        </div>
        <div class="form-group">
            <textarea name="body" id="body" cols="100" rows="10">{{$post['body']}}</textarea>
        </div>
        <input class="btn btn-info" type="submit">
    </form>
    @endsection
</x-admin-master>