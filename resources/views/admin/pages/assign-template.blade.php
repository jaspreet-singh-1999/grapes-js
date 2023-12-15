
  <div class="modal fade" id="assignTemplate" tabindex="-1" role="dialog" aria-labelledby="assignTemplateLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Assign</h5>
        </div>
        <div class="modal-body">    

          <div class="form-group">
            <div class="dropdown page-status">
              <select class="form-select" type="text" name="status_id" id="select_PageType_id" required>
                <option selected value="">Select Page</option>
                @foreach ($pageTemplate as $template)
                  <option value="{{ $template->page->id }}">{{$template->page->page_type}}</option>
                @endforeach
              
              </select>
            </div>
            <span class="input-error-message" id="admin_id_error"></span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="closeModal" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="assign" class="btn btn-primary">Assign</button>
        </div>
      </div>
    </div>
</div>
