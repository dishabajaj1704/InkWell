@extends('admin.layout.app')

@section('main-content')
    <div class="container-fluid">


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.tags.update', $tag->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" value="{{ old('name', $tag->name) }}"
                                    class="form-control @error('name') border-danger text-danger @enderror"
                                    placeholder="Enter Tag Name" id="name" name="name">
                                @error('name')
                                    <span class="text-danger">
                                        {{-- {{$errors->has('name')?'ERROR':'No Error'}} --}}
                                        {{ $errors->first('name') }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="updatetag">Submit</button>
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
