<x-admin-master>

    @section('content')
    <h1>Profile Page : {{$user->name}}</h1>
    <div class="col-sm-6">
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
    @endsection
</x-admin-master>