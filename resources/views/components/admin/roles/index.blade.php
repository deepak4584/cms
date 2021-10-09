<x-admin-master>
    @section('content')
    <div class="row">
        <div class="col-sm-3">

            <form method="post" action="{{route('roles.store')}}">
                @csrf
                <div class="form-group">
                    <label for="name"></label>
                    <input class="form-control @error('name') is-invalid @enderror" name="name" id="name" type="text">
                    <div>
                        @error('name')
                        <span><strong>{{$message}}</strong></span>
                        @enderror
                    </div>
                </div>
                <button type=" submit" class="btn btn-info btn-block">Submit</button>

            </form>
        </div>

        <div class="col-sm-9">
            <div class="card shadow mb-4">

                <div class="card-header py-3">

                    <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
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
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <!-- <th>Edit</th> -->
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <!-- <th>Edit</th> -->
                                    <th>Delete</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($roles as $role )
                                <tr>
                                    <td>{{$role['id']}}</td>
                                    <td><a href="{{route('roles.edit', $role->id)}}">{{$role['name']}}</a>
                                    </td>
                                    <td>{{$role['slug']}}</td>
                                    </form>

                                    <td>
                                        <form action="{{route('roles.destroy',$role->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger"
                                                type="submit">Delete</button>
                                        </form>
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

</x-admin-master>