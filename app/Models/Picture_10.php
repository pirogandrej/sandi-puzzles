<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Picture_10 extends Model
{

    protected $guarded = [];

    public static function insertPictureDescription($data) {

        return self::updateOrCreate(
            ['id' => !empty($data['id']) ? $data['id'] : self::max('id') + 1],
            [
                'pic_id' => $data['pic_id'],
                'path_part' => $data['path_part'],
                'x1' => $data['x1'],
                'y1' => $data['y1'],
                'created_at' => Carbon::now()->addHours(3)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->addHours(3)->format('Y-m-d H:i:s')
            ]);
    }

    public static function getDescription($id) {

        return self::where('pic_id', '=', $id)->first();
    }

    public static function deletePicture($id)
    {
        return self::where('pic_id','=', $id)->delete();
    }

    public static function checkId($id) {

        $picture = self::where('pic_id', '=', $id)->first();
        $isId = ($picture != null) ? true : false ;
        return $isId;

    }

}

