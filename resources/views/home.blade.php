@extends('layouts.app')

@section('content')
    <div class="container">
        @if(auth()->user()->hasPermissionTo('Create User'))
            <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-whatever="@mdo">Add User
                </button>
            </div>
        @endif
        <div class="row justify-content-center">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->name}}
                            @if(auth()->user()->name === $user->name)
                                <label class="badge bg-primary">Login</label></td>
                        @endif
                        <td>{{$user->email}}</td>
                        <td>
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $role)
                                    <label class="badge bg-success">{{ $role }}</label>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    </div>
                    <form method="POST" action="{{ route('user.store') }}">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>

                            <div class="form-group">
                                <div class="form-group mt-3">
                                    <label for="role">Role:</label>
                                    <select id="dropdown" name="roles" placeholder="Select a role...">
                                        <option value="" disabled selected>Select a role...</option>
                                        @foreach ($roles as $value => $label)
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
                maxItems: 1
            });
        });
    </script>
@endsection
