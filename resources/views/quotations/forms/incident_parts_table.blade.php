<div class="col-md-12" id="incident_parts_subcontainer">
    {!! Form::hidden('', count($incident_parts),  ['id' => 'incident_parts_length']) !!}
    <table class="table table-striped table-bordered table-hover" id="datatable_parts">
        <thead>
        <tr>
            <th width="2%">
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    {!! Form::checkbox(null, null, $check_all_status, ['class' => 'incident-parts-checkall']) !!}
                    <span></span>
                </label>
            </th>
            <th>Nombre</th>
            <th>Precio</th>
        </tr>
        </thead>
        <tbody>
        @foreach($incident_parts as $part)
            <tr>
                <td width="2%">
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        {!! Form::checkbox('incident_parts[' . $part->id . '][price]', ($quotation_edit == true) ? $part->price : '',
                        ($quotation_edit == true) ? $part->checkbox_status : false,
                        ['class' => 'incident-part-checkbox', 'id' => 'part_check_box' . $part->id]) !!}
                        <span></span>
                    </label>
                </td>
                <td>{{$part->name}}</td>
                <td>
                    {!! Form::text(null, ($quotation_edit == true) ? $part->price : '',
                    ['class' => 'incident-part-input form-control currency-format', 'placeholder' => 'Precio', 'id' => 'part_input' . $part->id]) !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>