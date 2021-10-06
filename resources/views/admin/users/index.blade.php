<x-admin-master>
    @section('content')
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
    @elseif(session()->has('Updated'))
    <div class="alert alert-success">
        <h4>
            {{ session()->get('Updated') }}
        </h4>
    </div>
    @endif

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Profile</th>
                        <th>Registered Date</th>
                        <th>Profile Update Date</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Profile</th>
                        <th>Registered Date</th>
                        <th>Profile Update Date</th>
                        <th>Edit</th>
                        <th>Delete</th>

                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($users as $user )
                    <tr>

                        <td>{{$user['id']}}</td>
                        <td>{{$user->username}}</td>
                        <td> {{$user['name']}}</td>
                        <td>
                            <img height="100px" class="card-img-top" src="{{asset('images/' . $user['profile'])}}"
                                alt="Card image cap">
                        </td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                        <td>{{$user->updated_at->diffForHumans()}}</td>
                        <td><a class="btn btn-outline-info" href="">Edit</a></td>

                        <td><a onclick="return confirm('Are you sure?')" class="btn btn-outline-danger"
                                href="{{route('user.destroy',$user->id)}}">Delete</a>
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
    <script src="{{asset('js/demo/chart-bar-demo.js')}}"></script>
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endsection

</x-admin-master>