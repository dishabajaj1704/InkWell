@extends('admin.layout.app')

@section('main-content')
    <div class="container-fluid">
        <!--Page Heading -->

        @include('admin.layout._alert-messages')
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Excerpt</th>
                        <th>Category</th>
                        <th>published_at</th>
                        <th>Actions</th>

                    </thead>
                    <tbody>
                        @foreach ($blogs as $blog)
                            <tr>
                                <td>{{ $blog->id }}</td>
                                <td>
                                    <img src="{{ asset($blog->image_path) }}" alt="{{ $blog->title }}" width="80px">
                                </td>
                                <td>{{ $blog->title }}</td>
                                <td>{{ $blog->excerpt }}</td>
                                <td>{{ $blog->category->name }}</td>
                                <td>{{ $blog->published_at }}</td>
                                <td>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#restoreModal"
                                        onclick="restoreModalHelper('{{ route('admin.blogs.undraft', $blog->id) }}')">
                                        <i class="fa fa-recycle"></i>
                                    </button>

                                    {{-- <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                                        onclick="deleteModalHelper('{{ route('admin.blogs.destroy', $blog->id) }}')">
                                        <i class="fa fa-trash"></i>
                                    </button> --}}

                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($blogs->count() == 0)
                    <p>No Blogs Found</p>
                @endif
                {{ $blogs->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>




    {{-- Restore Modal --}}
    <div class="modal fade" id="restoreModal" tabindex="-1" role="dialog" aria-labelledby="restoreModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="POST" id="restoreForm">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Restore category?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Are you sure you want to restore the category?</div>
                    <div class="form-group">
                        <label for="published_at" class="form-label">Published At</label>
                        <input type="date" name="published_at" id="published_at" required
                            value="{{ old('published_at') }}"
                            class="form-control @error('publsihed_at') border-danger text-danger @enderror"
                            placeholder="Enter published date">

                        @error('published_at')
                            <span class="text-danger">
                                {{ $message }};
                            </span>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-secondary" type="submit">Restore</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function deleteModalHelper(url) {

            console.log(url); //   http://localhost:8000/admin/categories/2
            document.getElementById("deleteForm").setAttribute('action', url);
        }


        function restoreModalHelper(url) {

            // console.log(url); //   http://localhost:8000/admin/categories/2
            document.getElementById("restoreForm").setAttribute('action', url);
        }
    </script>
@endsection
