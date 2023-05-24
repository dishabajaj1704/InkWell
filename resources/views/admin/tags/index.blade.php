@extends('admin.layout.app')

@section('main-content')
    <div class="container-fluid">
        <!--Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href={{ route('admin.tags.create') }} class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Create Tag</a>
        </div>
        @include('admin.layout._alert-messages');
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Post Count</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <td>{{ $tag->id }}</td>
                                <td>{{ $tag->name }}</td>
                                <td>0</td>
                                <td>
                                    <a href="{{ route('admin.tags.edit', $tag->id) }}" class="btn btn-primary">
                                        <i class="fas fa-pen"></i>
                                    </a>


                                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                        onclick="deleteModalHelper('{{ route('admin.tags.destroy', $tag->id) }}')">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $tags->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="POST" id="deleteForm">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete category?</h5>
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
@endsection

@section('scripts')
    <script>
        function deleteModalHelper(url) {
            document.getElementById("deleteForm").setAttribute('action', url);
        }
    </script>
@endsection
