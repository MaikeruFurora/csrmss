<div class="card card-warning">
  <div class="card-header">
    <h4> <a href="{{ route('admin.registered.client') }}" class="btn btn-warning pl-3 pr-3 mr-3"><i class="fas fa-arrow-circle-left"></i> Back</a> Client Information</h4>
  </div>
    <div class="card-body">
        <form action="">
            <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="">Name</label>
                  <input type="text" readonly class="form-control" value="{{ $clientData->fullname ?? '' }}">
                </div>
                <div class="form-group col-md-4">
                  <label for="">Contact No.</label>
                  <input type="text" readonly class="form-control" value="{{ $clientData->contact_no ?? '' }}">
                </div>
                <div class="form-group col-md-4">
                  <label for="">Address</label>
                  <input type="text" readonly class="form-control" value="{{ $clientData->address ?? '' }}">
                </div>
              </div>
        </form>
    </div>
</div>