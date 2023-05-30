@extends('admin.layout.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection


@section('scripts')
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        $('.select2').select2({
            placeholder: "Select a value",
            allowClear: true //used to claer the selected value (cross button)
        });

        flatpickr("#published_at", {
            enableTime: true,
            altInput: true,
            altFormat: "F j, Y H:i",
            dateForrmat: "Y-m-d H:i",
            maxDate: "today"

        });

        function saveAsDraft() {

            console.log("Hey saveDraft")
            var saveDraft = document.getElementById("saveDraft");
            var published_at = document.getElementById("published_at_fg");
            if (saveDraft.checked == true) {
                published_at.style.display = "none";
            } else {
                published_at.style.display = "block";
            }
        }
    </script>
@endsection

@section('main-content')
    <div class="container-fluid">
        <!-- Page Heading -->
        {{-- <div class="d-sm-flex align-items-center justify-content-between mh-4">

        </div> --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!--tittle -->
                            <div class="form-group">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" value="{{ old('title') }}"
                                    class="form-control @error('title') border-danger text-danger @enderror"
                                    placeholder="Enter Title" id="title" name="title">
                                @error('title')
                                    <span class="text-danger">
                                        {{ $message }};
                                        {{-- This provides all the errors at once --}}
                                    </span>
                                @enderror
                            </div>
                            <!--end of title -->
                            <!-- excerpt -->
                            <div class="form-group">
                                <label for="excerpt" class="form-label">Excerpt</label>
                                <input type="text" value="{{ old('excerpt') }}"
                                    class="form-control @error('excerpt') border-danger text-danger @enderror"
                                    placeholder="Enter Excerpt" id="excerpt" name="excerpt">
                                @error('excerpt')
                                    <span class="text-danger">
                                        {{ $message }};
                                        {{-- This provides all the errors at once --}}
                                    </span>
                                @enderror
                            </div>
                            <!--end of excerpt -->
                            <!-- body -->
                            <div class="form-group">
                                <label for="body" class="form-label">Body</label>
                                <input type="hidden" value="{{ old('body') }}"
                                    class="form-control @error('body') border-danger text-danger @enderror"
                                    placeholder="Enter body" id="body" name="body">
                                <trix-editor input="body"></trix-editor>
                                @error('body')
                                    <span class="text-danger">
                                        {{ $message }};
                                        {{-- This provides all the errors at once --}}
                                    </span>
                                @enderror
                            </div>
                            <!--end of body -->

                            <!-- category id -->
                            <div class="form-group">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id" class="form-control select2">
                                    <option></option> {{-- used when we dont want that first itme should be bydefaultly selected --}}
                                    @foreach ($categories as $category)
                                        @if ($category->id == old('category_id'))
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @error('category_id')
                                    <span class="text-danger">
                                        {{ $message }};
                                        {{-- This provides all the errors at once --}}
                                    </span>
                                @enderror
                            </div>
                            <!--end of category id -->


                            <!-- tags -->
                            <div class="form-group">
                                <label for="tags" class="form-label">Tags</label>
                                <select name="tags[]" id="tags" class="form-control select2" multiple>
                                    <option></option> {{-- used when we dont want that first itme should be bydefaultly selected --}}
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                            {{ old('tags') && in_array($tag->id, old('tags')) ? 'selected' : '' }}>
                                            {{ $tag->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('tags')
                                    <span class="text-danger">
                                        {{ $message }};
                                    </span>
                                @enderror
                            </div>
                            <!--end of tags -->

                            <input type="checkbox" id="saveDraft" name="saveDraft" value="" onclick="saveAsDraft()">
                            <label for="saveDraft">Save as Draft</label>

                            <!-- puublished at -->
                            <div class="form-group" id="published_at_fg">
                                <label for="published_at" class="form-label">Published At</label>
                                <input type="date" name="published_at" id="published_at"
                                    value="{{ old('published_at') }}"
                                    class="form-control @error('publsihed_at') border-danger text-danger @enderror"
                                    placeholder="Enter published date">

                                @error('published_at')
                                    <span class="text-danger">
                                        {{ $message }};
                                    </span>
                                @enderror
                            </div>
                            <!--end of puublished at -->


                            <!-- image file -->
                            <div class="form-group">
                                <label for="image_path" class="form-label">Image</label>
                                <input type="file" name="image" id="image_path"
                                    class="form-control @error('image_path') border-danger text-danger @enderror"
                                    placeholder="Select Image file">

                                @error('image')
                                    <span class="text-danger">
                                        {{ $message }};
                                    </span>
                                @enderror
                            </div>
                            <!--end of image file-->

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="addBlog">Submit</button>
                            </div>
                        </form>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
