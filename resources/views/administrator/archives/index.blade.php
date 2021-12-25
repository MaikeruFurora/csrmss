@extends('../layout/app')
@section('title','Manage Priest')
@section('content')
@include('administrator/partial/DeleteConfirmation')
<section class="section">
    <h2 class="section-title">Archive Masterlist</h2>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
               <div class="card">
                   <div class="card-header">
                       <h4>Information</h4>
                       <div class="card-header-action">
                               <select name="" id="" class="custom-select">
                                   <option value="">---- Choose ----</option>
                                   <option value="priest">Priest</option>
                                   <option value="client_request">Client request</option>
                               </select>
                       </div>
                   </div>
                   <div class="card-body">
                       
                   </div>
               </div>
            </div>
        </div>
    </div>
    

</section>
@endsection

@section('moreJs')
 
@endsection