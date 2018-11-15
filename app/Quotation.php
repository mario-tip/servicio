<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'quotations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'quotation_file', 'authorization', 'comments', 'authorization_file', 'incident_id'];

    public function parts()
    {
        return $this->belongsToMany('App\Part', 'quotation_part', 'quotation_id', 'part_id')
            ->withPivot('price');
    }

    public function getTotalPrice()
    {
        return $this->parts()->sum('quotation_part.price');
    }

    public function incident()
    {
        return $this->belongsTo('App\Incident', 'incident_id', 'id');
    }

    public function getAuthorizationWord()
    {
        $authorizations = [
            '0' => 'Pendiente',
            '1' => 'Si',
            '2' => 'No',
            '3' => 'Cancelada'
        ];
        return $authorizations[$this->authorization];
    }

    /*Obtiene el tipo o la extensión del archivo, $key=0:tipo, key=1:extension */
    public static function getFileMime($filename)
    {
        try{
            return explode('/', mime_content_type($filename));
        } catch(\Exception $e) {
            return null;
        }
    }

    public static function getFileTypeIcon($key)
    {
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
