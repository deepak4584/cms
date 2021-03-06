<x-admin-master>
    @section('content')
    @if(session()->has('role-updated'))
    <div class="alert alert-success">
        <h4>
            {{ session()->get('role-updated') }}
        </h4>
    </div>
    @endif
    <div class="row">
        <div class="col-sm-6">
            <h1>Edit page:{{$role->name}}</h1>
            <form method="post" action="{{route('roles.update',$role->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{$role->name}}">
                </div>
                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            @if ($permissions->isNotEmpty())
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Operation</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Operation</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>

                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr>
                                     <td><input type="checkbox" @foreach ($role->permissions as $role_permission)
                                        @if ($role_permission->slug == $permission->slug)
                                        checked
                                        @endif
                                        @endforeach
                                        ></td>
                                    <td>{{$permission['id']}}</td>
                                    <td>{{$permission['name']}}</td>
                                    <td>{{$permission['slug']}}</td>

                                    <td>
                                        <form action="{{route('role.permission.attach',$role)}}" method="post">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="permission" value="{{$permission->id}}">
                                            <button type="submit" class="btn btn-success button-primary"
                                                @if($role->permissions->contains($permission))
                                                disabled
                                                @endif
                                                >
                                                Attach</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{route('role.permission.detach',$role)}}" method="post">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="permission" value="{{$permission->id}}">
                                            <button type="submit" class="btn btn-danger"
                                                @if(!$role->permissions->contains($permission))
                                                disabled
                                                @endif
                                                >
                                                Detach</button>
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
            <script src="{{asset('js/demo/chart-bar-demo.js')}}"></script>
            <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
            <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
            @endif
        </div>
    </div>

    @endsection
</x-admin-master>