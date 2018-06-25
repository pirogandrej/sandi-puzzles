<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Picture extends Model
{

    protected $guarded = [];

    public static function getMaxImageId() {

        return self::max('id');

    }

    public static function insertImg($data) {

        return self::updateOrCreate(
            ['id' => !empty($data['id']) ? $data['id'] : self::max('id') + 1],
            [
                'author_id'         => $data['author_id'],
                'title'             => $data['title'],
                'image_main'        => $data['image_main'],
                'image_main_mini'   => $data['image_main_mini'],
                'number_zone'       => $data['number_zone'],
                'wh_cut'            => $data['wh_cut'],
                'game_visible'      => $data['game_visible'],
                'created_at'        => Carbon::now()->addHours(3)->format('Y-m-d H:i:s'),
                'updated_at'        => Carbon::now()->addHours(3)->format('Y-m-d H:i:s')
            ]
        );
    }

    public static function getPicture($id) {

        return self::where('id', '=', $id)->first();

    }

    public static function getPictureWithUser($id) {

        return self::where('author_id', '=', $id)->first();

    }

    public static function saveWH($id, $width, $height) {
        self::where('id','=', $id)
            ->update([
                'w_mini' => $width,
                'h_mini' => $height
            ]);
        return;
    }

    public static function getAllPictures() {

        return self::all();

    }

    public static function deletePicture($id)
    {
        return self::where('id','=', $id)->delete();
    }

    public static function changeVisibleGame($id)
    {
        $val = self::where('id','=', $id)->value('game_visible');
        if($val == 0){
            return self::where('id','=', $id)
                ->update([
                    'game_visible' => '1',
                    'updated_at' => Carbon::now()->addHours(3)->format('Y-m-d H:i:s')
                ]);
        }
        else{
            return self::where('id','=', $id)
                ->update([
                    'game_visible' => '0',
                    'updated_at' => Carbon::now()->addHours(3)->format('Y-m-d H:i:s')
                ]);
        }

    }

}

