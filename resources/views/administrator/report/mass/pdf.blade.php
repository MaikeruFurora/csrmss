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
                        <td class="text-center" colspan="5"><b>MASS REPORT</b></td>
                    </tr>
                    <tr>
                        <td>#</td>
                        <td>Request By</td>
                        <td>Name</td>
                        <td>Category</td>
                        <td>Created</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mass as $key => $item)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->request_by }}</td>
                            <td>
                                <ol class="pt-0 pb-0">
                                    @foreach ($item->mass_first_name as $i => $fname)
                                        <li><b>{{ $fname.' '.$item->mass_middle_name[$i].' '.$item->mass_last_name[$i] }}</b></li>
                                    @endforeach
                                </ol>
                            </td>
                            <td>
                                <ol class="pt-0 pb-0">
                                    @foreach ($item->mass_option as $category)
                                        <li><b>{{ $category }}</b></li>
                                    @endforeach
                                </ol>
                            </td>
                            <td>{{ $item->created_at->format('m/d/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</body>
</html>