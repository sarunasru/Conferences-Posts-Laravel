<x-admin-master>
    @section('content')

        <h1>Roles</h1>
<div class="row">

        @if(session()->has('role-delete'))
            <div class="alert alert-danger">
                {{session('role-delete')}}
            </div>
        @endif

</div>

        <div class="row">

            <div class="col-sm-3">

                <form method="post" action="{{route('roles.store')}}">
                  @csrf

                    <div class="form-group">

                        <br>
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control  @error('name') is-invalid @enderror">

                        <div>
                            @error('name')
                            <span><strong>{{$message}}</strong></span>
                            @enderror
                        </div>

                    </div>

                    <button class="btn btn-primary btn-block" type="submit">Create</button>

                </form>

            </div>

            <div class="col-sm-9">


                <div class="table-responsive">
                <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Delete</th>


                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Delete</th>

                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($roles as $role)


                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>{{$role->slug}}</td>
                            <td>
                                <form method="post" action="{{route('roles.destroy', $role->id)}}">
                                    @csrf
                                    @method('delete')

                                    <button type="submit" class="btn btn-danger">Delete</button>
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

    @endsection
</x-admin-master>
