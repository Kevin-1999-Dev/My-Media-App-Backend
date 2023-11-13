@extends('admin.layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-4 shadow-sm">
        <form action="{{ route('admin#categoryEdit',$data->category_id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" value="{{ old('categoryTitle',$data->title) }}" name="categoryTitle" class="form-control" placeholder="Enter Title...">
                @error('categoryTitle')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
           </div>
           <div class="form-group">
            <label for="">Description</label>
            <textarea name="categoryDescription" id="" cols="30" rows="10" class="form-control" placeholder="Enter Description...">{{ old('categoryDescription',$data->description) }}</textarea>
            @error('categoryDescription')
            <small class="text-danger">{{ $message }}</small>
        @enderror
       </div>
       <div class="">
            <input type="submit" value="Update" class="btn btn-primary">
       </div>
        </form>
        <a href="{{ route('admin#category') }}">
            <button class="btn btn-success mt-2">Create</button>
          </a>
    </div>
    <div class="col-8">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Category List Page</h3>
            <div class="card-tools">
                <form action="{{ route('admin#categorySearch') }}" method="POST">
                    @csrf
                        <div class="input-group input-group-sm" style="width: 150px;">
                          <input type="text" name="searchKey" class="form-control float-right" placeholder="Search">

                          <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                              <i class="fas fa-search"></i>
                            </button>
                          </div>
                        </div>
                </form>
            </div>
        </div>

        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap text-center">
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($category as $c)
                <tr>
                    <td>{{ $c->category_id }}</td>
                    <td>{{ $c->title }}</td>
                    <td>{{ $c->description }}</td>
                    <td>
                        <a href="{{ route('admin#categoryEditPage',$c->category_id) }}">
                            <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                          </a>
                      <a href="{{ route('admin#categoryDelete',$c->category_id) }}">
                        <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                      </a>
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
