@extends('admin.layout.app')

@section('main-content')
    <div class="container-fluid">
        {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Create Category</a>
        </div> --}}

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.categories.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" value="{{ old('name') }}"
                                    class="form-control @error('name') border-danger text-danger @enderror"
                                    placeholder="Enter Category Name" id="name" name="name">
                                @error('name')
                                    <span class="text-danger">
                                        {{-- {{$errors->has('name')?'ERROR':'No Error'}} --}}
                                        {{ $errors->first('name') }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="addCategory">Submit</button>
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
