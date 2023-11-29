@extends('admin.layouts.main')
@section('contant')

<h3> Custom pages </h3>

<form class="form repeater-default">
    <div data-repeater-list="group-a">
        <div data-repeater-item>
            <div class="row justify-content-between">
                
                <div class="col-md-2 col-sm-12 form-group">
                    <label for="lable_name">Field Group</label>
                    <input type="text" class="form-control" id="lable_name" name="lable_name" placeholder="field group">
                </div>
                
                <div class="col-md-2 col-sm-12 form-group">
                    <label for="Profession">Field Type</label>
                    <select name="profession" id="Profession" class="form-control">
                        <option selected value="">Type</option>
                        @foreach ($fieldType as $type)
                            <option value="{{$type->id}}">{{$type->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 col-sm-12 form-group">
                    <label for="lable_name">Field Label </label>
                    <input type="text" class="form-control" id="lable_name" name="lable_name" placeholder="field label">
                </div>

                <div class="col-md-2 col-sm-12 form-group">
                    <label for="field_name">Field Name</label>
                    <input type="text" class="form-control" id="field_name" name="field_name" placeholder="field name">
                </div>

                <div class="col-md-2 col-sm-12 form-group">
                    <label for="field_name">Default Value</label>
                    <input type="text" class="form-control" id="default_value" name="default_value" placeholder="default Value">
                </div>

                <div class="col-md-2 col-sm-12 form-group d-flex align-items-center pt-2">
                    <button class="btn btn-danger" data-repeater-delete type="button"> <i class="bx bx-x"></i>
                        Delete
                    </button>
                </div>
            </div>
            <hr>
        </div>
    </div>
    <div class="form-group">
      <div class="col p-0">
        <button class="btn btn-primary" id="add" data-repeater-create type="button"><i class="bx bx-plus"></i>
            Add
        </button>
      </div>
    </div>
  </form>
<script>
    $(document).ready(function(){
        $('#add-new').on('click',function(e){
            e.preventDefault();
            $('#fieldModal').modal('show');
        });

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
    });
</script>
@endsection