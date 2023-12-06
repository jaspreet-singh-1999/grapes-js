@extends('admin.layouts.main')
@section('content')
<h3>{{$page->page_type}}</h3>
<div class="mb-2">
  <a href="#" class="btn btn-primary" id="add">Add New {{$page->page_type}}</a>
</div>
<div class="modal fade" id="pageModal" tabindex="-1" role="dialog" aria-labelledby="pageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pageModalLabel">Add page</h5>
        </div>
        <div class="modal-body">
          @foreach($fields as $field)
            <form id="page-details" >
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">{{$field->label}}</label>
                <input type="{{$field->fieldType->name}}" name="{{$field->name}}" class="form-control" id="page_title" value="">
              </div>
            </form>
          @endforeach

        </div>
        <div class="modal-footer">
          <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="save" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
</div>
<script>
  $(document).ready(function(){
    $('#add').on('click',function(e){
      $('#pageModal').modal('show');
    });
    $('#close').on('click',function(e){
      $('#pageModal').modal('hidde');
    });
  });
</script>
@endSection