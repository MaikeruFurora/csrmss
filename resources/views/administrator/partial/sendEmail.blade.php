<form class="" id="sendEmailForm">@csrf
    <div class="modal fade" id="sendEmailModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="sendEmailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="sendEmailModalLabel">Compose Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body pb-0">
                        <div class="form-group mt-3">
                            <label >To</label>
                            <input class="form-control" type="text" name="to" required readonly>
                        </div>
                        <div class="form-group">
                            <label >Subject</label>
                            <input class="form-control" type="text" name="subject" required>
                        </div> 
                        <textarea name="body" class="summernote-simple"  data-height="20" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btnSendEmail pl-4 pr-4" ><i class="far fa-paper-plane"></i> Send</button>
                    <button type="button" class="btn btn-warning sendCancel" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>