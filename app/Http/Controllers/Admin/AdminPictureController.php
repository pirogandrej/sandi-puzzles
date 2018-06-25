<?php

namespace App\Http\Controllers\Admin;

use App\Models\Picture;
use Illuminate\Http\Request;

class AdminPictureController extends AdminContainerController
{

    public function admin_pictures_check(Request $request){

        $id = $request->input('image_id');

        $pictures = Picture::getPictureWithUser($id);

        $flag = count($pictures);

        return $flag;
    }

}

