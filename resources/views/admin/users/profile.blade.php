<x-admin-master>
    @section('content')

        <h1>{{$user->name}} Profile</h1>

<div class="row">

    <div class="col-sm-6">

        <form method="POST" action="{{route('user.profile.update', $user)}}" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="mb-4">
                <img width="85px" height="100px" class="img-profile rounded-circle" src="{{$user->avatar}}">
            </div>

            <div class="form-group">
                <input type="file" name="avatar">
            </div>


            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" aria-describedby="" value="{{$user->username}}">
                @error('username')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="" value="{{$user->name}}">
                @error('name')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="" value="{{$user->email}}">
                @error('email')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" aria-describedby="">
                @error('password')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password-confirmation" aria-describedby="">
                @error('password_confirmation')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
</div>


        <div class="row">

            <div class="col-sm-12">

                <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Select</th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Attach</th>
                        <th>Detach</th>

                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Select</th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Attach</th>
                        <th>Detach</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <tr>
                        <td>

                            @foreach($roles as $role)
                                <tr>
                                    <td><input type="checkbox"
                                        @foreach($user->roles as $user_role)
                                            @if($user_role->slug == $role->slug)
                                                checked
                                                @endif

                                        @endforeach
                                        >
                                    </td>
                                    <td>{{$role->id}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->slug}}</td>
                                    <td>
                                        <form method="post" action="{{route('user.role.attach', $user)}}">
                                            @method('put')
                                            @csrf

                                            <input type="hidden" name="role" value="{{$role->id}}">

                                            <button class="btn btn-warning"
                                            @if($user->roles->contains($role))
                                               disabled
                                            @endif

                                            >Attach</button>

                                        </form>
                                    </td>
                                    <td>
                                    <form method="post" action="{{route('user.role.detach', $user)}}">
                                        @method('put')
                                        @csrf

                                        <input type="hidden" name="role" value="{{$role->id}}">

                                        <button class="btn btn-danger"
                                       @if(!$user->roles->contains($role))
                                           disabled
                                        @endif

                                        >Detach</button>
                                    </form>
                                    </td>
                                </tr>

                            @endforeach
                        </td>
                    </tr>
                    </tbody>

                </table>
            </div>

    @endsection
</x-admin-master>
