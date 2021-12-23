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
                        <td class="text-center" colspan="4"><b>WEDDING DETAILS</b></td>
                    </tr>
                    <tr>
                        <td>#</td>
                        <td>Bride name</td>
                        <td>Groom of date</td>
                        <td>Married</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wedding as $key => $item)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->bride_fullname }}</td>
                            <td>{{ $item->groom_fullname }}</td>
                            <td>{{ $item->married }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</body>
</html>