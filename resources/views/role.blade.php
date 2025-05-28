@extends('layouts.app')

@section('content')
    <div class="container">
        @if(auth()->user()->hasPermissionTo('Create Role'))
        <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-whatever="@mdo">Add Role</button>
        </div>
        @endif
        <div class="row justify-content-center">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Roles</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <th scope="row">{{$role->id}}</th>
                        <td>{{$role->name}}</td>
                        <td>
                            @if(!empty($role->getPermissionNames()))
                                @foreach($role->getPermissionNames() as $permission)
                                    <label class="badge bg-success">{{ $permission }}</label>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Role</h5>
                    </div>
                    <form method="POST" action="{{ route('role.store') }}">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <div class="form-group mt-3">
                                    <label for="permissions">Permissions</label>
                                    <select id="dropdown" name="permissions[]" multiple placeholder="Select permissions...">
                                        @foreach ($permissions as $value => $label)
                                            <option value="{{ $label }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            new TomSelect("#dropdown", {
                plugins: ['remove_button'],
                persist: false,
                create: false,
                maxItems: null
            });
        });
    </script>
@endsection
