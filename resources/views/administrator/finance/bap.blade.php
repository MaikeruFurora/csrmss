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
<body onload="window.print()">
    <div class="row mt-5">
        <div class="col-md-6 offset-md-3 text-center">
            Archdiocese of Caceres <br>
            The Roman Catholic Parish of the {{ $church_name ?? 'no church name' }} <br>
            {{ $church_address ?? 'no church address'}}
        </div>
        <table class="table table-striped table-bordered mt-3" style="font-size: 10px">
           
        </table>
    </div>
</body>
</html>