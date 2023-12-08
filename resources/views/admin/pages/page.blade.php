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
                    <form id="page-details" action="{{route('save-field-data')}}" method="Post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page_id" value="{{$page->id}}">
                        @foreach($fields as $field)
                            <div class="form-group">
                                <label for="{{$field->name}}" class="col-form-label">{{$field->label}}</label>
                                <input type="{{$field->fieldType->name}}" name="{{$field->name}}" class="form-control" id="page_title" value="">
                            </div>
                        @endforeach
                        <div class="modal-footer">
                            <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="save" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
               
            </div>
        </div>
    </div>
    <table id="table">
        <thead>
            <tr>
                <th>#</th>
                @foreach($fields as $field)
                    <th>{{$field->label}}</th>
                @endforeach
                <th>Action</th>
            </tr>
        </thead>
    </table>
  <script>
    $(document).ready(function(){
        $('#add').on('click',function(e){
          $('#pageModal').modal('show');
        });
        
        $('#close').on('click',function(e){
          $('#pageModal').modal('hide');
        });

        let table= $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('listing',$page->id)}}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
    
                @foreach($fields as $field)
                {
                    data:'{{$field->name}}',
                    name:'{{$field->name}}',
                },
                @endforeach
                { 
                    data: 'action', name: 'action', 
                    orderable: false, 
                    searchable: false 
                }
            ]
        });
    });
  </script>
@endSection