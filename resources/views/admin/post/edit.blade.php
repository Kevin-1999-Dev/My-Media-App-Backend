@extends('admin.layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-4 shadow-sm">
        <form action="{{ route('admin#postEdit',$postDetail->post_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" value="{{ old('postTitle',$postDetail->title) }}" name="postTitle" class="form-control" placeholder="Enter Title...">
                @error('postTitle')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
           </div>
           <div class="form-group">
            <label for="">Description</label>
            <textarea name="postDescription" id="" cols="30" rows="10" class="form-control" placeholder="Enter Description...">{{ old('postDescription',$postDetail->description) }}</textarea>
            @error('postDescription')
            <small class="text-danger">{{ $message }}</small>
        @enderror
       </div>
       <div class="form-group">
        <label for="">Category</label>
        <select name="postCategory" id="" class="form-control">
            <option value="">Choose Your Category</option>
            @foreach ($category as $c)
                <option value="{{ $c->category_id }}" @if (($c->category_id) == ($postDetail->category_id))
                    selected
                @endif >{{ $c->title }}</option>
            @endforeach
        </select>
        @error('postCategory')
        <small class="text-danger">{{ $message }}</small>
    @enderror
   </div>
       <div class="form-group">
        <label for="">Image</label>
        <div class="mb-1">
            <img class="img-thumbnail" width="400px" height="100px" @if ($postDetail->image != null)
            src="{{ asset('postImage/'.$postDetail->image) }}"
            @else
            src="{{ asset('defaultImage/default.png') }}"
            @endif alt="" srcset="">
        </div>
        <input type="file" name="postImage" id="" class="form-control">
   </div>
       <div class="">
            <input type="submit" value="Update" class="btn btn-primary">
       </div>
        </form>
        <div>
            <a href="{{ route('admin#post') }}">
                <button class="btn btn-danger">Create</button>
            </a>
        </div>
    </div>
    <div class="col-8">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Post List Page</h3>
            <div class="card-tools">
                <form action="" method="POST">
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
                <th>Image</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->post_id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>
                        <img width="100px" height="70px" @if ($post->image == null)
                        src="{{ asset('defaultImage/default.png') }}"
                        @else
                        src="{{ asset('postImage/'.$post->image) }}"
                        @endif>
                    </td>
                    <td>
                      <a href="{{ route('admin#postEditPage',$post->post_id) }}" class="text-decoration-none">
                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                      </a>
                      <a href="{{ route('admin#postDelete',$post->post_id) }}">
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
