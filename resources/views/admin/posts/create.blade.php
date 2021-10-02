<x-admin-master>
    @section('content')

    <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="hidden" class="form-control" name="" id="user_id" placeholder="Enter title" name="title">
        </div>
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" placeholder="Enter title" name="title">
        </div>
        <div class="form-group">
            <label for="file">File:</label>
            <input class="form-control-file" type="file" class="form-control" id="post_image" name="post_image">
        </div>
        <div class="form-group">
            <textarea name="body" id="body" cols="100" rows="10"></textarea>
        </div>
        <button class="btn btn-info" type="submit" name="submit">Submit</button>
    </form>
    @endsection


</x-admin-master>