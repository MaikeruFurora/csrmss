<div class="modal fade" id="weddingModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Generate Certificate</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="">Priest:</label>
              <select name="priest" class="form-control">
                <option value="No Available">Choose priest</option>
                @foreach ($priests as $priest)
                  <option value="{{ $priest->fullname }}">{{ $priest->fullname }}</option>
                @endforeach
              </select>
          </div>
        </div>
        <div class="modal-footer p-2">
          <button type="button" class="btn btn-sm btn-success generate" >Generate</button>
          <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
