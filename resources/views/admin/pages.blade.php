@extends('admin.layouts.main')
@section('contant')
<h3> Pages list </h3>
<div class="mb-2">
    <a href="" class="btn btn-primary" id="add-new-page">Add New Page</a>
</div>
{{-- create page modal start  --}}
<div class="modal fade" id="pageModal" tabindex="-1" role="dialog" aria-labelledby="pageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pageModalLabel">Add page</h5>
        </div>
       
        <div class="modal-body">
          <form id="page-details" >
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Page title</label>
              <input type="text" name="page_title" class="form-control" id="page_title" value="">
            </div>

            <div class="form-group">
                <label for="message-text" class="col-form-label">Description</label>
                <textarea class="form-control" name="description" id="description" value=""></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="save" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
</div>
{{-- page modal end --}}
{{-- edit page modal start  --}}
<div class="modal fade" id="pageEditModal" tabindex="-1" role="dialog" aria-labelledby="pageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pageModalLabel">Add page</h5>
        </div>
       
        <div class="modal-body">
          <form id="page-details" >
            <input type="hidden" id="page_id" >
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Page title</label>
              <input type="text" name="page_title" class="form-control" id="edit_title" value="">
            </div>

            <div class="form-group">
                <label for="message-text" class="col-form-label">Description</label>
                <textarea class="form-control" name="description" id="edit_description" value=""></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" id="close_modal" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="save_data" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
</div>
{{-- edit page modal end --}}
<table class="table" id="pages-table">
    <thead>
        <tr>
            <th>Sr.No</th>
            <th>Page Slug</th>
            <th>Page Title</th>
            <th>Action</th>
        </tr>
    </thead>
</table>
<script>
    $(document).ready(function(){
        $('#add-new-page').on('click',function(e){    
            e.preventDefault();
            $('#pageModal').modal('show');
        });

        $('#close').on('click',function(e){
            $('#pageModal').modal('hide');
        });

        $('#close_modal').on('click',function(e){
            $('#pageEditModal').modal('hide');
        });

        let table = $('#pages-table').DataTable({
            processing: true,
            serverSide: true,
            ajax:"{{route('pages-list-data')}}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                { 
                    data: 'page_slug', 
                    name: 'page_slug' 
                },
                { 
                    data: 'page_title', 
                    name: 'page_title' 
                },
                { 
                    data: 'action', name: 'action', 
                    orderable: false, 
                    searchable: false 
                }
            ]
        });
        $('#save').on('click',function(){
            var page_title= $('#page_title').val();
            var description= $('#description').val();
            $.ajax({
                type:'POST',
                url:"{{route('save-page')}}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data:{
                    page_title: page_title,
                    description:description
                },
                success:function(data){
                    if(data.success== true){
                        $('#pageModal').modal('hide')
                        toastr.success(data.message);
                        table.draw();
                    }else{
                        toastr.error(data.message);
                    }
                }
            });
        });

        $('#pages-table').on('click','.editPage',function(){
            let id= $(this).data('id');
            $.ajax({
                type:'GET',
                url:"{{route('edit-page')}}",
                data:{
                    id:id
                },
                success:function(data){
                    if(data.success == true){
                        $('#page_id').val(data.pageDetails.page_id);
                        $('#edit_title').val(data.pageDetails.page_title);
                        $('#edit_description').val(data.pageDetails.description);
                        $('#pageEditModal').modal('show');
                        console.log(data.message);
                    }
                }
            });
        });

        $('#save_data').on('click',function(){
            var id= $('#page_id').val();
            var page_title= $('#edit_title').val();
            var description= $('#edit_description').val();

            $.ajax({
                type:'POST',
                url:"{{route('page-update')}}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data:{
                    id: id,
                    page_title: page_title,
                    description: description
                },
                success:function(data){
                    if(data.success== true){
                        $('#pageEditModal').modal('hide')
                        toastr.success(data.message)
                        table.draw();
                    }else{
                        toastr.error(data.message)
                    }
                }
            });
        });
    });
</script>
@endSection
