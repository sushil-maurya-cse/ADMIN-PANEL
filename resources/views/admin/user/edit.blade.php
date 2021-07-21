@extends('layouts.admin');

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Edit and update user</h1>
        </div>
        <div class="card-body">
            <form action="{{ url('update-user/' . $user->id) }}" id="usertable" method="POST" enctype="multipart/form-​data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" value="{{ $user->name }}"
                            class="@error('name') is-invalid @enderror form-control" name="name">
                        @error('name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Email</label>
                        <input type="text" value="{{ $user->email }}"
                            class="@error('email') is-invalid @enderror form-control" name="email">
                        @error('email')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="col-md-6 mb-3">
                    <label for="">password</label>
                    <input type="password" value="{{ $user->password }}"
                        class="@error('password') is-invalid @enderror form-control" name="password">
                    @error('password')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </div>
        </form>
    </div>
    </div>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>


    @push('jQuery')

        <script src="{{ asset('./assets/main.js') }}" defer></script>
    @endpush


@endsection
