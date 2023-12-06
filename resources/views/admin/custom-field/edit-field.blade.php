@extends('admin.layouts.main')
@section('content')

<form class="form repeater-default" id="form-submit" method="post" action="{{route('update')}}">
    @csrf
    <div data-repeater-list="data">
        <input name="pageType_id" type="hidden" value="{{$pageType->id}}">
        <h3> Edit Type</h3>
        <div class="col-md-2 col-sm-12 form-group">
            <input type="text" class="form-control" id="page_type" name= "page_type" value="{{$pageType->page_type}}" placeholder="type name">
        </div>
        <h4>Fields</h4>
        @foreach($fields as $field)
            <div data-repeater-item>
                <input name="field_id" type="hidden" id="field_id_{{$field->id}}" value="{{$field->id}}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Profession">Field Type:</label>
                            <select name="field_type" id="field_type" class="form-control">
                                <option selected value="">Select type</option>
                                @foreach ($fieldType as $type)
                                    <option value="{{ $type->id }}" @if($type->id == $field->fieldType->id) selected @endif>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lable_name">Field Label:</label>
                            <input type="text" class="form-control" id="lable_name" name="label" value="{{$field->label}}" placeholder="Field label*">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field_name">Field Name:</label>
                            <input type="text" class="form-control" id="field_name" name="name" value="{{$field->name}}" placeholder="Field name*">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="default_value">Default Value:</label>
                            <input type="text" class="form-control" id="default_value" name="default_value"  value="{{$field->default_value}}" placeholder="Default Value*">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group d-flex align-items-center pt-2">
                                <button class="btn btn-danger" id="delete" data-id="{{$field->id}}" data-repeater-delete type="button"> <i class="bx bx-x"></i>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        @endforeach
    </div>
    <div class="form-group">
        <div class="col p-0">
            <button class="btn btn-primary" id="add" data-repeater-create type="button"><i class="bx bx-plus"></i>
               + Add field
            </button>
        </div>
    </div>
    <div class="mb-2">
        <input type="submit" class="btn btn-primary" id="save">
    </div>
</form>
<script>
    $(document).ready(function(){
        $('.repeater-default').repeater({
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                let id= $(this).find(['input name="field_id"']).val();
                if(confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            }    
        });
    });
</script>
@endsection