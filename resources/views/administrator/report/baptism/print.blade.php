
<title>CSRMSS &mdash; Print Certificate</title>
<link rel="shortcut icon" href="{{ asset('asset/img/logo.png') }}">
   {{-- <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}"> --}}
   <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.css') }}">

   <style type="text/css">
       body{
           font-family: Times New Roman;
       }
       p{
           font-size: 20px;
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
                <img src="{{ asset('asset/img/baptism.jpg') }}" width="10%">
                <h3 style="margin-top: 50px"><u><b> CERTIFICATE OF BAPTISM </b></u></h3>
                <h4 style="margin-top: 50px"><u><b>  THIS IS TO CERTIFY </b></u></h4>
                <h3 ><u><b>  {{ $baptism->fullname }} </b></u></h3>
                <p style="margin-top: 50px;font-size:18px" class=" parag">
                    THAT  <u><b>{{ $baptism->fulname }}</b></u> CHILD OF <u><b>{{ $baptism->mother_fullname }}</b></u> AND <u><b>{{ $baptism->father_fullname }}</b></u> BORN ON THE DAY OF <u><b>{{ $baptism->child_date_of_birth }}</b></u> WAS SOLEMNLY BAPTIZED ON THE DAY OF {{ $baptism->baptized }}.
                </p>
                <h4 class="mt-5"><u><b>ACCORDING TO THE RITE OF THE <br>
                    ROMAN CATHOLIC CHURCH</b></u></h4><br>
                <h4>By the {{ $priest }}</h4><br>

                <p style="font-size:18px;text-transform: capitalize" class="parag">The Sponsors being <u><b>{{ $baptism->god_mother_fullname }}</b></u> and <u><b>{{ $baptism->god_father_fullname }}</b></u>  as appears from the Baptisal Register No. <u><b > {{ $register }} </b></u> page <u><b> {{ $page }} </b></u> line <u><b> 6</b></u> of this Church Dated <b><u>{{ date("Y m d") }}</u></b></p>
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
   

