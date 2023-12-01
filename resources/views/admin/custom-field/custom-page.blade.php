@extends('admin.layouts.main')
@section('contant')

<h3> Custom pages </h3>
<div class="mb-2">
    <a href="{{route('add-field')}}" class="btn btn-primary" id="add-new-page">Add New Page</a>
</div>

<table id='field-table'>
    <thead>
        <tr>
            <th>#</th>
            <th>Label</th>
            <th>Name</th>
            <th>key</th>
            <th>Type</th>
            <th>Action</th>
        </tr>
    </thead>
</table>
<script>
    $(document).ready(function(){
        $('#field-table').DataTable({
            processing: true,
            serverside: true,
            ajax: "{{route('field_list')}}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'label',
                    name: 'label',
                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'field_key',
                    name: 'field_key',
                },
                {
                    data: 'type',
                    name: 'type',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#field-table').on('click','.status',function(){
            let field_id= $(this).data();
            let button= $(this);
            $.ajax({
                type: "GET",
                url: "{{route('change-status')}}",
                data:field_id,
                success:function(data){
                    if(data.field_status == 0){
                        button.text('Activate');
                    }else if (data.field_status == 1){
                        button.text('Deactivate');
                    }
                    toastr.success(data.message);
                }
            });
        });
    });
</script>

@endsection