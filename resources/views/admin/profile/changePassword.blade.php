@extends('admin.layouts.app')

@section('content')
    <form action="{{ route('admin#changePassword') }}" method="POST" class="pt-3">
        @csrf
        @if (Session::has('updatePassword'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('updatePassword') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Old Password :</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="oldPassword" placeholder="Enter Old Password...">
                @error('oldPassword')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">New Passwrod :</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="newPassword" placeholder="Enter New Password...">
                @error('newPassword')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Confirm Password :</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="confirmPassword" placeholder="Enter Confirm Password...">
                @error('confirmPassword')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            </div>
        </div>

        <div class="float-right">
            <input type="submit" value="Change Password" class="btn btn-dark text-white">
        </div>
    </form>

@endsection
