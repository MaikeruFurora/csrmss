<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
    <link rel="shortcut icon" href="{{ asset('image/'.$church_logo) }}">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3 text-center">
                Archdiocese of Caceres <br>
            The Roman Catholic Parish of the {{ $church_name ?? 'no church name' }} <br>
            {{ $church_address ?? 'no church address'}}
            </div>
        </div>
        {{-- <div class="row mt-5">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">sas</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">sas</div>
                </div>
            </div>
           
        </div> --}}
        <div class="row mt-2">
            
            <table class="table table-striped table-bordered" style="font-size: 10px">
                <thead>
                    <tr>
                        <td colspan="1"></td>
                        <td class="text-center" colspan="3"><b>CONFIRMATION REPORT </b></td>
                    </tr>
                    <tr>
                        <td>#</td>
                        <td>Name</td>
                        <td>Address</td>
                        <td>Gender</td>
                        <td>Age</td>
                        <td>Contact No.</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($confirmation as $key=> $item)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->fullname }}</td>
                            <td>{{ $item->confirmation_complete_address }}</td>
                            <td>{{ $item->confirmation_gender }}</td>
                            <td>{{ $item->confirmation_age }}</td>
                            <td>{{ $item->confirmation_contact_no }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</body>
</html>