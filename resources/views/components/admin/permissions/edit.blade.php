<x-admin-master>
    @section('content')
    
   @if(session()->has('updated'))
    <div class="alert alert-success">
        <h4>
            {{ session()->get('updated') }}
        </h4>
    </div>
    @endif
    <div class="row">
        <div class="col-sm-6">
            <h1>Edit permission:{{$permission->name}}</h1>
            <form method="post" action="{{route('permissions.update',$permission->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{$permission->name}}">
                </div>
                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
    @endsection
</x-admin-master>