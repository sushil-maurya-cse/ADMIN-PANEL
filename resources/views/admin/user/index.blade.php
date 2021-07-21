@extends('layouts.admin')




@section('content')






    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">




    <div class="card">
        <div class="card-header">
            <h4>User page</h4>
        </div>
        <div id="message">
        </div>
        <div class="card-body">
            <div class=m"col-md-2">
                <form action="{{ url('user') }}" method="GET">
                    <div class="row">
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="status" class="form-control">
                                <option value=" ">Select one</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <button type="submit: class=" btn btn-primary py-2>filter</button>
                        </div>
                    </div>
                </form>
            </div>
            <table class="table border ydatatable " id="userTable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Action</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>

                                @php $prodID= Crypt::encrypt($item->id); @endphp
                                <!--Encrypt ID and store as $prodID-->
                                <a href="{{ url('/edit-prod', $prodID) }}" class="btn btn-danger">Edit</a>

                                <a href="{{ url('delete-user/' . $item->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                            <td><input type="checkbox" class="toggle-class" data-id="{{ $item->id }}"
                                    data-toggle="toggle" data-style="slow" data-on="Enabled" data-off="Disabled"
                                    {{ $item->status == true ? 'checked' : '' }}>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>







    @push('new')

        <script src="{{ asset('assets/main.js') }}" defer></script>
    @endpush


    @push('disable')
        <script>
            $(function() {
                $('#toggle-two').bootstrapToggle({
                    on: 'Enabled',
                    off: 'Disabled'
                });
            })
        </script>





        <script>
            $('.toggle-class').on('change', function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var user_id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    dataType: 'JSON',
                    url: '{{ route('changeStatus') }}',
                    data: {
                        'status': status,
                        'user_id': user_id
                    },
                    success: function(data) {
                        $('#message').fadeIn();
                        $('#message').css('background', 'blue');
                        $('#message').text('Status Updated Successfully');
                        setTimeout(() => {
                            $('#message').fadeOut();
                        }, 1000)
                    }
                });
            });
        </script>



    @endpush





@endsection
