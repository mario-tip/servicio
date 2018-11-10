<div class="col-md-12" id="equipment_parts_subcontainer">
    {!! Form::hidden('', count($asset_parts),  ['id' => 'equipment_parts_length']) !!}
    <table class="table table-striped table-bordered table-hover" id="datatable_parts">
        <thead>
            <tr>
                <th></th>
                <th>Name of the part </th>
            </tr>
        </thead>
        <tbody>
        @foreach($asset_parts as $part)
            <tr>
                <td width="2%">
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input name="parts[]" type="checkbox" class="checkboxes equipment-part-checkbox" value="{{$part->id}}" {{$part->checkbox_status}} id="part_check_box{{$part->id}}" />
                        <span></span>
                    </label>
                </td>
                <td>{{$part->name}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
