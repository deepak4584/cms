<x-admin-master>

    @section('content')
    <h1>Profile Page : {{$user->name}}</h1>
    <div class="col-sm-12">
        <form action="{{route('user.profile.update', $user)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group mb-4">
                <img height="100px" src="{{asset('images/' . $user['profile'])}}">
            </div>
            <div class="form-group">
                <label for="profile">Profile</label>
                <input type="file" name="profile" id="profile" class="form-control">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid                    
                @enderror" value="{{$user->username}}">
                @error('username')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid                    
                @enderror"" value=" {{$user->name}}">
                @error('name')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control @error('email') is-invalid                    
                @enderror"" value=" {{$user->email}}">
                @error('email')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid                    
                @enderror"">
                @error('password')
                <div class=" alert alert-danger">{{$message}}
            </div>
            @enderror
    </div>
    <div class="form-group">
        <label for="password-confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid                    
                @enderror"">
        @error('password_confirmation')
        <div class=" alert alert-danger">{{$message}}
    </div>
    @enderror
    </div>

    <input class="btn btn-info" type="submit" value="Submit">
    </form>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 front-weigth-bold text-primary">Roles</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Options</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Options</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($roles as $role )
                                <tr>
                                    <td><input type="checkbox" @foreach ($user->roles as $user_role)
                                        @if ($user_role->slug == $role->slug)
                                        checked
                                        @endif
                                        @endforeach
                                        ></td>
                                    <td>{{$role['id']}}</td>
                                    <td>{{$role['name']}}</td>
                                    <td>{{$role['slug']}}</td>
                                    <td>
                                        <form action="{{route('users.role.attach',$user)}}" method="post">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="role" value="{{$role->id}}">
                                            <button type="submit" class="btn btn-success button-primary"
                                                @if($user->roles->contains($role))
                                                disabled
                                                @endif
                                                >
                                                Attach</button>
                                        </form>

                                    </td>
                                    <td>
                                        <form action="{{route('users.role.detach',$user)}}" method="post">
                                            @method('PUT')
                                            @csrf
                                            <input type="hidden" name="role" value="{{$role->id}}">
                                            <button type="submit" class="btn btn-danger"
                                                @if(!$user->roles->contains($role))
                                                disabled
                                                @endif
                                                >Detach</button>
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