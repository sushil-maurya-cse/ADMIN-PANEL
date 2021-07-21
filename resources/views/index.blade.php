<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <form action="useremail" id="usertable" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="">Name</label>
                <input type="text" class="@error('name') is-invalid @enderror form-control" id="name" name="name">

            </div>
            <div class="col-md-6 mb-3">
                <label for="">E-mail</label>
                <input type="text" class="@error('email') is-invalid @enderror form-control" id="email" name="email">

            </div>

            <div class="col-md-6 mb-3">
                <label for="">password</label>
                <input type="password" name="password" id="password"
                    class="@error('password') is-invalid @enderror form-control">

            </div>

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

    </body>

</html>
