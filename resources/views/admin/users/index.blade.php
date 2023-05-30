@extends('admin.layout.app')

@section('main-content')
    <div class="container-fluid">
        <!--Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Users</h1>
            {{-- <a href={{ route('admin.blogs.create') }} class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Create Blog</a> --}}
        </div>
        @include('admin.layout._alert-messages')
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>email_verified_at</th>
                        <th>Role</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->email_verified_at }}</td>
                                <td>{{ $user->role }}</td>

                                <td>
                                    <button
                                        class="{{ $user->email_verified_at == null ? 'btn btn-success' : 'btn btn-danger' }}"
                                        data-toggle="modal" data-target="#verifyEmailModal"
                                        onclick="verifyEmailModalHelper('{{ route('admin.users.verifyEmail', $user->id) }}')">
                                        {{ $user->email_verified_at == null ? 'Verify Email' : 'Unverify Email' }}
                                    </button>

                                    <button class="{{ $user->role === 'author' ? 'btn btn-success' : 'btn btn-danger' }}"
                                        data-toggle="modal" data-target="#adminModal"
                                        onclick=" adminModalHelper('{{ route('admin.users.makeRevokeAdmin', $user->id) }}')">

                                        {{ $user->role === 'author' ? 'Make Admin' : 'Revoke Admin' }}
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($users->count() == 0)
                    <p>No Blogs Found</p>
                @endif
                {{ $users->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
    {{-- Admin Modal --}}
    <div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="POST" id="adminForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Make Admin?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Are you sure you want to make changes?</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-secondary" type="submit">Yes</button>
                    </div>
                </div>

            </form>
        </div>
    </div>


    {{-- Verify  Email Modal --}}
    <div class="modal fade" id="verifyEmailModal" tabindex="-1" role="dialog" aria-labelledby="verifyEmailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="POST" id="verifyEmailForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Verify Email?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Are you sure you want to make changes?</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-secondary" type="submit">Yes</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection





@section('scripts')
    <script>
        function adminModalHelper(url) {

            console.log(url);
            document.getElementById("adminForm").setAttribute('action', url);
        }

        function verifyEmailModalHelper(url) {

            console.log(url);
            document.getElementById("verifyEmailForm").setAttribute('action', url);
        }
    </script>
@endsection
