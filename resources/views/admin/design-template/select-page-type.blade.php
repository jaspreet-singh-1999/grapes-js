@extends('admin.layouts.main')
@section('content')
<div class="mb-2">
  <a href="#" class="btn btn-primary" id="select_Page_type">Select page type</a>
</div>
  <div class="modal fade" id="selectPageType" tabindex="-1" role="dialog" aria-labelledby="selectPageTypeLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Select page type</h5>
        </div>
        <div class="modal-body">
          {{-- <div class="form-group">
            <label for="message-text" class="col-form-label">Description</label>
            <input type="text" class="form-control" name="description" id="description" value=""></textarea>
          </div> --}}

          <div class="form-group">
            <div class="dropdown page-status">
              <select class="form-select" type="text" name="status_id" id="select_PageType_id" required>
                <option selected value="">Select Page</option>
                @foreach($pageTypes as $types)
                  <option value="{{$types->id}}">{{$types->page_type}}</option>
                @endforeach
              </select>
            </div>
            <span class="input-error-message" id="admin_id_error"></span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="edit-template" class="btn btn-primary">Edit Template</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function(){
      $('#select_Page_type').on('click',function(e){
        $('#selectPageType').modal('show');
      });

      $('#edit-template').on('click',function(){
        let page_type_id= $('#select_PageType_id').val();        
        $.ajax({
          url: "{{route('edit-template')}}",
          type: 'get',
          data:{
            page_type_id: page_type_id
          },
          success:function(response){
            if(response.success == true){
              let newURL = "{{ route('template-editor', ['id' => ':id']) }}";
              newURL = newURL.replace(':id', response.page_type_id);
              window.location.href= newURL;
            }else{
              toastr.error(response.message);
            }
          }
        });
      });
    });
  </script>
@endSection