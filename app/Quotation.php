<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $table = 'quotations';

    protected $fillable = [
      'name',
      'description',
      'quotation_file',
      'authorization',
      'comments',
      'authorization_file',
      'incident_id'
    ];

    public function parts(){
        return $this->belongsToMany(Part::class, 'quotation_part', 'quotation_id', 'part_id')
            ->withPivot('price');
    }

    public function getTotalPrice(){
        return $this->parts()->sum('quotation_part.price');
    }

    public function incident(){
        return $this->belongsTo(Incident::class, 'incident_id', 'id');
    }

    public function getAuthorizationWord(){
        $authorizations = [
                    // <span class="label label-sm label-info">Pending</span>
            '0' => 'Pending',
            '1' => 'Authorized',
            '2' => 'Canceled',
            '3' => 'Canceled'
        ];
        return $authorizations[$this->authorization];
    }

    /*Obtiene el tipo o la extensión del archivo, $key=0:tipo, key=1:extension */
    public static function getFileMime($filename){
        try{
            return explode('/', mime_content_type($filename));
        } catch(\Exception $e) {
            return null;
        }
    }

    public static function getFileTypeIcon($key){
        $supported_extensions = [
            'pdf' => 'pdf',
            'msword' => 'doc',
            'plain' => 'txt',
            'vnd.ms-excel' => 'xls',
            'xml' => 'xml',
            'zip' => 'zip', 'x-rar-compressed' => 'zip',
            'default' => 'file'
        ];
        if(array_key_exists($key, $supported_extensions)) {return $supported_extensions[$key];}
        return $supported_extensions['default'];


    }

}
