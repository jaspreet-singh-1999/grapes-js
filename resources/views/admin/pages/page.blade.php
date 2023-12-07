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
            <form id="page-details" >
                @foreach($fields as $field)
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{$field->label}}</label>
                        <input type="{{$field->fieldType->name}}" name="{{$field->name}}" id="field-data" class="form-control" id="page_title" value="">
                    </div>
                @endforeach
            </form>
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
            $('#pageModal').modal('hide');
        });

        $('#save').on('click',function(){
            let field_data= $('#field-data').val();
            let field_name= $('input [name="{{$field->name}}"]').val();

            console.log(field_data,field_name);
        })
    });
  </script>
@endSection