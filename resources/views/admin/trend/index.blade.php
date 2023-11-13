@extends('admin.layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Trend Post Page</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap text-center">
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>View Count</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($post as $p)
              <tr>
                <td>{{ $p->post_id   }}</td>
                <td>{{ $p->title }}</td>
                <td>
                    <img width="100px" height="70px" @if ($p->image == null)
                        src="{{ asset('defaultImage/default.png') }}"
                    @else
                    src="{{ asset('postImage/'.$p->image) }}"
                    @endif alt="">
                </td>
                <td>0</td>
                <td>
                  <button class="btn btn-sm bg-dark text-white"><i class="fa-solid fa-info"></i></button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  <div class="float-end">
    {{ $post->links() }}
  </div>
@endsection
