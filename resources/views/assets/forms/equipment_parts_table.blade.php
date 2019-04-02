<div class="col-md-12 table-scrollable" id="equipment_parts_subcontainer">
    {!! Form::hidden('', count($equipment_parts),  ['id' => 'equipment_parts_length']) !!}
    <table class="table table-striped table-bordered table-hover" id="datatable_parts">
        <thead>
            <tr>
                <th width="2%">
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        {!! Form::checkbox(null, null, $check_all_status, ['class' => 'equipment-parts-checkall']) !!}
                        <span></span>
                    </label>
                </th>
                <th>Part name</th>
                <th>Part number</th>
                <th>Price</th>
                <th>Description</th>
                <th>Serie number</th>
            </tr>
        </thead>
        <tbody>
            @foreach($equipment_parts as $part)
            <tr>
                <td width="2%">
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        {!! Form::checkbox('equipment_parts[' . $part->id . '][serial]', ($asset_edit == true) ? $part->serial : '',
                        ($asset_edit == true) ? $part->checkbox_status : false,
                        ['class' => 'equipment-part-checkbox', 'id' => 'part_check_box' . $part->id]) !!}
                        <span></span>
                    </label>
                </td>
                <td>{{$part->name}}</td>
                <td>{{$part->number}}</td>
                <td class="currency-format">{{$part->price}}</td>
                <td>{{$part->description}}</td>
                <td>
                    {!! Form::text(null, $part->serial, ['class' => 'equipment-part-input form-control', 'placeholder' => 'Serie number', 'id' => 'part_input' . $part->id]) !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
