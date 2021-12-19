
<title>CSRMSS &mdash; Print Certificate</title>
<link rel="shortcut icon" href="{{ asset('asset/img/logo.png') }}">
   {{-- <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}"> --}}
   <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.css') }}">

   <style type="text/css">
       body{
           font-family: Times New Roman;
       }
       p{
           /* font-size: 20px; */
       }
       h5{
           font-size: 22px;
       }
       .containers {
           margin: 10px auto 0;
           width: 90%;
           text-transform: uppercase
       }

       .element {
           height: 900px;
           border-color: skyblue;
           border-width: 10px;
           border-style: double solid;
       }
       .imahe{
           float: left;
           margin-left: 10%;
       }
       .headerr{
           text-align: center;
           font-size: 20px;
       }
       .coll1{
           text-align: center;
           margin-top: 5%;
       }
       .coll2{
           text-align: center;
       }
      
       .cert{
           text-align: center;
           font-size: 25px;
       }
       .name{
           float: right;
           word-spacing: 0px;
           margin-top: 2%;
           font-size: 23px;
       }
       .designation{
           word-spacing: 0px;
           margin-left: 60%;
          
       }
       .parag{
           text-align: justify;
           text-transform: uppercase;
       }
       .footer{
           font-style: italic;
           font-family: Arial;
           margin-top: 48%;
       }
       .btn{
           float: right;
       }
        input[type="text"]{
     border-style: none;
     font-weight: bold;
     font-size: 15px;
   }
   </style>
</head>
<body onload="window.print()">
   <div class="containers">
    <div class="element">
    <div class="containers content2">
        <p class="headerr">
                    Archdiocese of Caceres <br>
            The Roman Catholic Parish of the St. Paul The Apostle <br>
            Buhi, Camarines Sur <br> 
        </p>
            
            <div style="text-align: center">
                <img src="{{ asset('asset/img/com.jpg') }}" width="15%">
                <h3 style="margin-top: 50px"><u><b>CERTIFICATE OF CONFIRMATION</b></u></h3>
                <h4 style="margin-top: 50px"><u><b>-o0o- THIS IS TO CERTIFY -o0o- </b></u></h4>
                <h4 style="margin-top: 50px"><u><b> {{ $confirmation->fullname }}</b></u></h4>
                <p style="margin-top: 50px;font-size:18px;" class="">
                    This Certifies that <b><u>{{ $confirmation->fullname }}</u></b> Having already been reborn
                    in Baptism, was sealed with the Holy Spirit in Confirmation and
                    recieve the Holy Eucharist for the first time. On the Day of {{ $confirmation->confirm }}
                </p>
                 <br><br>
                    <p style="font-size: 15px">Date: {{ date("Y-m-d") }}</p>
                 <br><br><br>
                
                <h3 style="margin-bottom: -20px"><u>{{ $priest }}</u></h3>
                <p style="text-transform:capitalize">Parish Priest</p>
            </div>


            
        </div>
    </div>
   </div>
   <script type="text/javascript">
     var date = new Date();
     var year = date.getFullYear();
     var month = date.getMonth()+1;
     var todayDate = String(date.getDate()).padStart(2,'0');
     var datePattern = year + '-' + month + '-' + todayDate;
     document.getElementById("date-created").value = datePattern;

   </script>
   

