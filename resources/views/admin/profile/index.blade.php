@extends('admin.layouts.app')

@section('content')
    <form action="{{ route('admin#profileUpdate') }}" method="POST" class="pt-3">
        @csrf
        @if (Session::has('updateSuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('updateSuccess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Name :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{ old('name',$user->name) }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Email :</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="email" value="{{ old('email',$user->email) }}">
                @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Phone :</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="phone" value="{{ old('phone',$user->phone) }}">
                @error('phone')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Address :</label>
            <div class="col-sm-10">
                <textarea name="address" cols="30" rows="10" class="form-control" >{{ old('address',$user->address) }}</textarea>
                @error('address')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">Gender :</label>
            <div class="col-sm-10">
                <select name="gender" class="form-control">
                    <option value="">Choose Your Gender</option>
                    <option value="male" {{ old('gender',$user->gender ) == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender',$user->gender ) == 'female' ? 'selected' : '' }}>Female</option>
                </select>
                @error('gender')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            </div>
        </div>
        <div class="float-right">
            <input type="submit" value="Update" class="btn btn-dark text-white">
        </div>
    </form>
    <a href="{{ route('admin#directChangePassword') }}" class="text-decoration-none">Change Password</a>
@endsection
