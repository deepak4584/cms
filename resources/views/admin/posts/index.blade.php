<x-admin-master>
    @section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Posts</h6>
        </div>
        @if(session()->has('message'))
        <div class="alert alert-danger">
            <h4>
                {{ session()->get('message') }}
            </h4>
        </div>
        @elseif(session()->has('Created'))
        <div class="alert alert-success">
            <h4>
                {{ session()->get('Created') }}
            </h4>
        </div>
        @else
        <div class="alert alert-success">
            <h4>
                {{ session()->get('Updated') }}
            </h4>
        </div>
        @endif

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Owner</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Owner</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Edit</th>
                            <th>Delete</th>

                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($posts as $post )
                        <tr>

                            <td>{{$post['id']}}</td>
                            <td>{{$post->user->name}}</td>
                            <td> {{$post['title']}}</td>
                            <td>
                                <img height="100px" class="card-img-top"
                                    src="{{asset('images/' . $post['post_image'])}}" alt="Card image cap">
                            </td>
                            <td>{{$post->created_at->diffForHumans()}}</td>
                            <td>{{$post->updated_at->diffForHumans()}}</td>

                            </form>
                            <td><a class="btn btn-info" href="{{route('post.edit',$post->id)}}">Edit</a></td>
                            <td>
                                <form action="{{route('post.destroy',$post->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" class="btn btn-danger"
                                        type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection
    @section('scripts')

    <script src=" {{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endsection
</x-admin-master>