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
                        <th>User Email</th>
                        <th>User Name</th>
                        <th>Blog Id</th>
                        <th>Comment Verification</th>
                        <th>Verified_by</th>
                        <th>Message</th>
                        <th>Verify Comment</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                            <tr>
                                <td>{{ $comment->id }}</td>
                                <td>{{ $comment->user_email }}</td>
                                <td>{{ $comment->user_name }}</td>
                                <td>{{ $comment->blog_id }}</td>
                                <td>{{ $comment->verified_at }}</td>
                                <td>{{ $comment->verified_by }}</td>
                                <td>{{ $comment->message }}</td>


                                <td>
                                    <button
                                        class="{{ $comment->verified_at == null ? 'btn btn-success' : 'btn btn-danger' }}"
                                        data-toggle="modal" data-target="#verifyCommentModal"
                                        onclick=" verifyCommentModalHelper('{{ route('admin.comments.verify', $comment->id) }}')">

                                        {{ $comment->verified_at == null ? 'Verify Comment' : 'Unverify Comment' }}
                                    </button>
                                </td>

                                <td>

                                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                        onclick="deleteModalHelper('{{ route('frontend.comments.destroy', $comment->id) }}')">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($comments->count() == 0)
                    <p>No Blogs Found</p>
                @endif
                {{ $comments->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>



    {{-- Verify  Email Modal --}}
    <div class="modal fade" id="verifyCommentModal" tabindex="-1" role="dialog" aria-labelledby="verifyCommentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="POST" id="verifyCommentForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Verify Comment?</h5>
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


{{-- Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" id="deleteForm">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Comment?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to delete the category?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-secondary" type="submit">Delete</button>
                </div>
            </div>

        </form>
    </div>
</div>


@section('scripts')
    <script>
        function verifyCommentModalHelper(url) {

            console.log(url);
            document.getElementById("verifyCommentForm").setAttribute('action', url);
        }

        function deleteModalHelper(url) {

            console.log(url); //   http://localhost:8000/admin/categories/2
            document.getElementById("deleteForm").setAttribute('action', url);
        }
    </script>
@endsection
