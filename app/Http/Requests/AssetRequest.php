<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssetRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            /*'asset.asset_custom_id' => 'required',*/
            'asset.adquisition_date' => 'required',
            'asset.name' => 'required',
            'asset.model' => 'required',
            'asset.condition' => 'required',
            'asset.serial' => 'required',
            'asset.status' => 'required',
            'asset.brand' => 'required',
            'asset.location_id' => 'required',
            'asset.barcode' => 'required',
            'asset.subcategory_id' => 'required',
            /*'asset_parts' => 'required|array|min:1',*/
            'asset.maintenance_date' => 'required',
            // 'asset.asset_customer_id' => 'required'
        ];
    }

    public function messages() {
        return [
            'asset.asset_custom_id.required' => 'El id del activo es requerido',
            'asset.adquisition_date.required' => 'La fecha de compra del activo es requerida',
            'asset.name.required' => 'El nombre del activo es requerido',
            'asset.model.required' => 'El modelo del activo es requrerido',
            'asset.condition.required' => 'La condición del activo es requerida',
            'asset.serial.required' => 'El número de serie del activo es requerido',
            'asset.status.required' => 'El estatus del activo es requerido',
            'asset.brand.required' => 'La marca del activo es requerida',
            'asset.location_id.required' => 'La ubicación del activo es requerida',
            'asset.barcode.required' => 'El código de barras es requerido',
            'asset.subcategory_id.required' => 'LA subcategoria es requerida',
            /*'asset_parts.required' => 'Las partes del activo son requeridas',*/
            'asset.maintenance_date.required' => 'La fecha de mantenimiento es requerida',
            // 'asset.asset_customer_id.required' => ''
        ];
    }
}
