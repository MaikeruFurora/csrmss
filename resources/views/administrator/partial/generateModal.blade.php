<form id="generatePDF">
<div class="modal fade" id="generateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="generateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="generateModalLabel">Generate Report</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                <div class="form-group">
                    <label for="">Date from</label>
                    <input type="text" name="from" class="form-control" id="datepicker1">
                </div>
                <div class="form-group">
                    <label for="">Date to</label>
                    <input type="text" name="to" class="form-control" id="datepicker2">
                </div>
              </div>
              <div class="modal-footer p-2">
                <button type="submit" class="btn btn-sm btn-success" >Generate</button>
                <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Close</button>
              </div>
          </div>
        </div>
    </div>
</form>