@extends('admin.layouts.main')
@section('contant')

<h3> Add New Field Group</h3>
<div class="col-md-2 col-sm-12 form-group">
    <input type="text" class="form-control" id="group_name" name= "group_name" placeholder="group name">
</div>
<div class="mb-2">
    <a href="#" class="btn btn-primary" id="save">Save changes</a>
</div>

<form class="form repeater-default" id="form-submit">
    <div data-repeater-list="group-a">
        <h4>Fields</h4>
        <div data-repeater-item>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Profession">Field Type:</label>
                        <select name="type[]" id="field_type" class="form-control">
                            <option selected value="">select type</option>
                            @foreach ($fieldType as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lable_name">Field Label:</label>
                        <input type="text" class="form-control" id="lable_name" name="lable[]" placeholder="Field label*">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="field_name">Field Name:</label>
                        <input type="text" class="form-control" id="field_name" name="name[]" placeholder="Field name*">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="default_value">Default Value:</label>
                        <input type="text" class="form-control" id="default_value" name="default_value[]" placeholder="Default Value*">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group d-flex align-items-center pt-2">
                        <button class="btn btn-danger" data-repeater-delete type="button"> <i class="bx bx-x"></i>
                            Delete
                        </button>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>

    <div class="form-group">
        <div class="col p-0">
            <button class="btn btn-primary" id="add" data-repeater-create type="button"><i class="bx bx-plus"></i>
               + Add field
            </button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function(){
        $('.repeater-default').repeater({
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
                }
            }
        });

        $('#save').on('click', function(){
            let group_name= $('#group_name').val();
            let type= $('#field_type').val() ;
            let label= $('#lable_name').val();
            let name= $('#field_name').val();
            let default_value= $('#default_value').val();
           
            $.ajax({
                url: "{{route('save-field')}}",
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data:{
                    group_name: group_name,
                    type: type,
                    label: label,
                    name: name,
                    default_value: default_value
                },
                success:function(data){
                    if(data.success == true){
                        toastr.success(data.message);
                        window.location.href= "{{route('custom-field')}}";
                    }else{
                        toastr.error(data.message);
                    }
                }
            });
        });
    });
</script>
@endsection