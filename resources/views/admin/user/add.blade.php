@extends('layouts.admin');



@section('content')


    <div class="card">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="card-header">
            <h1>New User</h1>
        </div>
        <div class="card-body">
            <form action="{{ url('insert-user') }}" id="usertable" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" class="@error('name') is-invalid @enderror form-control" id="name" name="name">
                        @error('name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">E-mail</label>
                        <input type="text" class="@error('email') is-invalid @enderror form-control" id="email"
                            name="email">
                        @error('email')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">password</label>
                        <input type="password" name="password" id="password"
                            class="@error('password') is-invalid @enderror form-control">
                        @error('password')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Images</label>
                        <img id="preimage" width="100px" height="100px">
                        <input type="file" name="file_path"  class="form-control" onchange="loadfile(event)"
                            class="@error('file_path') is-invalid @enderror form-control">
                        @error('file_path')
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


    <script type="text/javascript">
        function loadfile(event){
            var output=document.getElementById('preimage')
            output.src=URL.createObjectURL(event.target.files[0]);
        }
        </script>
    @push('jQuery')

        <script src="{{ asset('./assets/main.js') }}" defer></script>
    @endpush







@endsection
