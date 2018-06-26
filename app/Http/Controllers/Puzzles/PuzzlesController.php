<?php
//fit - sandi-puzzles

namespace App\Http\Controllers\Puzzles;

use App\Models\Picture;
use App\Models\Picture_1;
use App\Models\Picture_2;
use App\Models\Picture_3;
use App\Models\Picture_4;
use App\Models\Picture_5;
use App\Models\Picture_6;
use App\Models\Picture_7;
use App\Models\Picture_8;
use App\Models\Picture_9;
use App\Models\Picture_10;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

use Auth;
use Config;
use Image;

class PuzzlesController extends ContainerController
{

    public function profile()
    {

        $this->data['content_information'] = [
            'page_title' => 'Мой профиль',
            'breadcrumb' => [
                ['url' => route('fit_profile'), 'status' => 'active', 'name' => 'Мой профиль']
            ],
            'buttons' => [
//                ['class' => 'btn-default', 'url' => url()->previous(), 'name' => 'Назад'],
                ['class' => 'btn-success change_profile', 'name' => 'Сохранить'],
            ]
        ];

        $posts = User::getUser(Auth::user()->id);

        $this->data['posts'] = $this->user_constructor($posts);

        return view('fitter.profile', $this->data);

    }

    public function profile_update(Request $request)
    {
        $post = $request->input();
        $currentUser = User::getUser($post['id']);

        $oldAvatarName = User::getAvatarUser($post['id']);

        $images = self::saveAvatarImage($request);

        if($post['password'] == $currentUser['password']) {
            $password = $post['password'];
        }
        else {
            $password = bcrypt($post['password']);
        }

        $data = [
            'id'         => $post['id'],
            'avatar'     => $images['avatar'],
            'name'       => $post['name'],
            'email'      => $post['email'],
            'password'   => $password,
        ];

        if($oldAvatarName != $images['avatar']) {

            self::deleteOldAvatarId($post['id']);

        }

        User::updateMyProfile($data);

        return redirect()->route('game_list');
    }


    public function load_image()
    {

        $this->check_integrity();

        $this->data['content_information'] = [
            'page_title' => 'Добавить новую игру',
            'breadcrumb' => [
                ['url' => route('load_image'), 'status' => 'active', 'name' => 'Добавить новую игру']
            ],
            'buttons' => [
                ['class' => 'btn-default', 'url' => url()->previous(), 'name' => 'Назад'],
            ]
        ];

        $posts = User::getUser(Auth::user()->id);

        $this->data['posts'] = $this->user_constructor($posts);

        return view('load_image', $this->data);

    }

    public function image_update(Request $request)
    {
        $images = self::saveImage($request);

        $data = [
            'author_id'       => Auth::user()->id,
            'image_main'      => $images['image_main'],
            'image_main_mini' => $images['image_main_mini'],
            'title'           => $request->input('title'),
            'number_zone'     => $request->input('number_zone'),
            'wh_cut'          => $request->input('wh_cut'),
            'game_visible'    => '1',
        ];

        $result = Picture::insertImg($data);

        $image_id = $result['id'];

        $posts = Picture::getPicture($image_id);

        $this->setImageMini($posts);

        return redirect()->route('image_select', $image_id);

    }


    public function image_select($image_id)
    {
        $this->data['content_information'] = [
            'page_title' => 'Выбрать области для вставки',
            'breadcrumb' => [
                ['url' => route('image_select', $image_id), 'status' => 'active', 'name' => 'Выбрать области для вставки']
            ],
            'buttons' => [
                ['class' => 'btn-default', 'url' => url()->previous(), 'name' => 'Назад'],
            ]
        ];

        $posts = Picture::getPicture($image_id);

        $card_map = [];
        for($i = 0; $i < $posts['number_zone']; $i++){
            $card_map['activ'][$i] = 0;
            $card_map['image_url'][$i] = '';
            $card_map['image_path'][$i] = '';
            $card_map['description'][$i]['x1'] = 0;
            $card_map['description'][$i]['y1'] = 0;
            $card_map['description'][$i]['wh'] = 0;
        }
        $number_activ = 0;

        if (count( $posts ) == 0) {
            return view('no_pictures', $this->data);
        }

        $this->data['posts'] = $this->picture_constructor($posts);

        $this->data['number_activ'] = $number_activ;
        $this->data['card_map'] = $card_map;
        $this->data['isReady'] = 'false';
        $this->data['card_map_json'] = json_encode($card_map);

        Session::put('number_activ', $number_activ);
        Session::put('activ', $card_map['activ']);
        Session::put('image_url', $card_map['image_url']);
        Session::put('image_path', $card_map['image_path']);
        Session::put('description', $card_map['description']);

        return view('image_cut', $this->data);

    }

    public function image_cut(Request $request)
    {

        $post = $request->input();

        $number_activ =  Session::get('number_activ');
        $card_map['activ'] = Session::get('activ');
        $card_map['image_url'] = Session::get('image_url');
        $card_map['image_path'] = Session::get('image_path');
        $card_map['description'] = Session::get('description');
        $picture_id = Picture::getPicture($post['image_id']);
        $picture = $this->picture_constructor($picture_id);

        $x1    = $post['x'];
        $y1    = $post['y'];
        $wh     = $picture_id['wh_cut'];

        $img = Image::make($picture['image_main_url_mini'])->crop($wh, $wh, $x1, $y1);

        $path_part = md5(time());

        $path = public_path(Config::get('custom.images_folder')) . $post['image_id'] . '/' . $number_activ . '_' . $path_part. '_'  . $picture_id['image_main'];
        $path_crop = asset(Config::get('custom.images_folder')) . '/' . $post['image_id'] . '/' . $number_activ . '_' . $path_part . '_' . $picture_id['image_main'];
        $path_img = public_path(Config::get('custom.images_folder')) . '/' . $post['image_id'] . '/' . $number_activ . '_' . $path_part . '_' . $picture_id['image_main'];
        $img->save($path, 100);

        $number_activ = (int)$number_activ;

        $card_map['activ'][$number_activ] = 1;
        $card_map['image_url'][$number_activ] = $path_crop;
        $card_map['image_path'][$number_activ] = $path_img;
        $card_map['description'][$number_activ]['x1'] = $x1;
        $card_map['description'][$number_activ]['y1'] = $y1;
        $card_map['description'][$number_activ]['wh'] = $wh;

        $data = [
            'pic_id'    => $post['image_id'],
            'path_part' => $path_part,
            'x1'        => ($x1 / $picture['w_mini']),
            'y1'        => ($y1 / $picture['h_mini'])
        ];

        $number_pic_bd = $number_activ + 1;

        switch ($number_pic_bd)
        {
            case '1':
                Picture_1::insertPictureDescription($data);
            break;
            case '2':
                Picture_2::insertPictureDescription($data);
                break;
            case '3':
                Picture_3::insertPictureDescription($data);
                break;
            case '4':
                Picture_4::insertPictureDescription($data);
                break;
            case '5':
                Picture_5::insertPictureDescription($data);
                break;
            case '6':
                Picture_6::insertPictureDescription($data);
                break;
            case '7':
                Picture_7::insertPictureDescription($data);
                break;
            case '8':
                Picture_8::insertPictureDescription($data);
                break;
            case '9':
                Picture_9::insertPictureDescription($data);
                break;
            case '10':
                Picture_10::insertPictureDescription($data);
                break;
        };

        $isReady = 1;
        foreach ($card_map['activ'] as $key => $data){
            if($data == 0){
                $number_activ = $key;
                $number_activ = (int)$number_activ;
                $isReady = 0;
                break;
            }
        }

        $card_map['number_activ'] = $number_activ;
        $card_map['isReady'] = $isReady;

        $this->data['posts'] = $picture;
        $this->data['number_activ'] = $number_activ;
        $this->data['card_map'] = $card_map;
        $this->data['isReady'] = $isReady;
        $this->data['card_map_json'] = json_encode($card_map);

        Session::put('number_activ', $number_activ);
        Session::put('activ', $card_map['activ']);
        Session::put('image_url', $card_map['image_url']);
        Session::put('image_path', $card_map['image_path']);
        Session::put('description', $card_map['description']);

        echo $this->data['card_map_json'];
    }

    public function image_cut_delete(Request $request)
    {

        $image_id = ($request->input('image_id'));
        $image_del = $request->input('image_del');

        $card_map['activ'] = Session::get('activ');
        $card_map['image_url'] = Session::get('image_url');
        $card_map['image_path'] = Session::get('image_path');
        $card_map['description'] = Session::get('description');

        File::delete($card_map['image_path'][$image_del]);

        $this->switch_image_del($image_del, $image_id);

        $number_activ = $image_del;
        $number_activ = (int)$number_activ;

        $card_map['activ'][$image_del] = 0;
        $card_map['image_url'][$image_del] = '';
        $card_map['image_path'][$image_del] = '';
        $card_map['description'][$image_del]['x1'] = 0;
        $card_map['description'][$image_del]['y1'] = 0;
        $card_map['description'][$image_del]['wh'] = 0;

        Session::put('number_activ', $number_activ);
        Session::put('activ', $card_map['activ']);
        Session::put('image_url', $card_map['image_url']);
        Session::put('image_path', $card_map['image_path']);
        Session::put('description', $card_map['description']);

        echo json_encode($card_map);

    }

    public function image_cut_change(Request $request)
    {

        $number_activ = $request->input('number_activ_new');
        Session::put('number_activ', $number_activ);

    }

    public function game_list()
    {
        $this->data['content_information'] = [
            'page_title' => 'Список игр',
            'breadcrumb' => [
                ['url' => route('game_list'), 'status' => 'active', 'name' => 'Список игр']
            ],
            'buttons' => [
                ['class' => 'btn-default', 'url' => url()->previous(), 'name' => 'Назад'],
            ]
        ];

        $this->check_integrity();

        $posts = Picture::getAllPictures();

        if (count( $posts ) == 0) {
            return view('no_pictures', $this->data);
        }

        $this->data['posts'] = $this->picture_constructor($posts);

        return view('image_list', $this->data);

    }

    public function delete_game($image_id)
    {

        $picture = Picture::getPicture($image_id);

        $number_zone = $picture['number_zone'];

        $pathDelImage = Config::get('custom.images_folder') . '/' . $image_id;
        File::deleteDirectory(public_path($pathDelImage));

        Picture::deletePicture($image_id);

        for($i=0; $i < $number_zone; $i++)
        {

            $this->switch_image_del($i, $image_id);

        }

        return redirect()->route('game_list');

    }

    public function game_visible_post(Request $request)
    {
        $id_visible = $request->input('id_visible');

        Picture::changeVisibleGame($id_visible);

        echo '1';
    }


    public function user_constructor($data) {

        if ( !empty($data[0]) ) {

            foreach ($data as $key => $post) {

                $data[$key]['avatar_url'] = !empty($post['avatar']) ? asset(Config::get('custom.avatars_folder') . $post['avatar']) : asset('default.jpg');

                $data[$key]['image_main_url'] = !empty($post['image_main']) ? asset(Config::get('custom.images_folder') . $post['image_main']) : asset('default.jpg');

            }

        } else {

            $data['avatar_url'] = !empty($data['avatar']) ? asset(Config::get('custom.avatars_folder') . $data['avatar']) : asset(Config::get('custom.avatars_folder') . 'default.jpg');

            $data['image_main_url'] = !empty($data['image_main']) ? asset(Config::get('custom.images_folder') . $data['image_main']) : asset(Config::get('custom.images_folder') . 'default.jpg');

        }

        return $data;

    }

    public static function saveAvatarImage($data) {

        $result = [];

        if ( !empty($data->file('avatar')) ) {

            $file = $data->file('avatar');

            $result['avatar'] = md5( 'avatar' . date('Hms')) . '.' . $file->getClientOriginalExtension();

            $configAvatar = Config::get('custom.avatars_folder');

            $path = public_path($configAvatar);

            $file->move($path, $result['avatar']);

            $img = Image::make($path . $result['avatar']);

            $img->save($path . $result['avatar'], 100);

        } else {

            $result['avatar'] = !empty($data->input('latest_avatar')) ? $data->input('latest_avatar') : '';

        }

        return $result;

    }

    public static function deleteOldAvatarId($id) {

        $path = Config::get('custom.avatars_folder');

        $avatarName = User::getAvatarUser($id);

        File::delete(public_path($path . $avatarName));

    }


    public static function saveImage($data) {

        $new_image_id = Picture::getMaxImageId() + 1;

        $configImage = Config::get('custom.images_folder');

        $path = public_path($configImage);

        $path_id = $path . $new_image_id . '/';

        $result = [];

        if ( !empty($data->file('image_main')) ) {

            $file = $data->file('image_main');

            $result['image_main'] = md5( 'image_main' . date('Hms')) . '.' . $file->getClientOriginalExtension();

            $file->move($path_id, $result['image_main']);

            $img = Image::make($path_id . $result['image_main']);

            $img->save($path_id . $result['image_main'], 100);

        } else {

            $img = Image::make($path . 'default.jpg');

            $result['image_main'] = md5( 'default') . '.' . 'jpg';

            File::makeDirectory($path_id, 0777, true, true);

            $img->save($path_id . $result['image_main'], 100);

        }

        $result['image_main_mini'] = 'mini_' . $result['image_main'];

        return $result;

    }

    public function picture_constructor($data) {

        if ( !empty($data[0]) ) {
            foreach ($data as $key => $post) {
                $data[$key]['image_main_url'] = !empty($post['image_main']) ? asset(Config::get('custom.images_folder') . $post['id'] . '/' . $post['image_main']) : asset(Config::get('custom.images_folder') . '/' . 'default.jpg');
                $data[$key]['image_main_url_mini'] = !empty($post['image_main']) ? asset(Config::get('custom.images_folder') . $post['id'] . '/mini_' . $post['image_main']) : asset(Config::get('custom.images_folder') . '/' . 'default.jpg');
                $data[$key]['image_main_url_fit'] = !empty($post['image_main']) ? asset(Config::get('custom.images_folder') . $post['id'] . '/mini_' . $post['image_main']) : asset(Config::get('custom.images_folder') . '/' . 'default.jpg');
                $img = Image::make($data[$key]['image_main_url_fit'])->fit(500);
                $constructor_image_path = public_path(Config::get('custom.images_folder')) . $post['id'] . '/';
                $filename_fit = $constructor_image_path . 'fit_' . $post['image_main'];
                $img->save($filename_fit, 100);
                $data[$key]['image_main_url_fit'] = asset(Config::get('custom.images_folder') . $post['id'] . '/fit_' . $post['image_main']);
            }

        } else {

            $data['image_main_url'] = !empty($data['image_main']) ? asset(Config::get('custom.images_folder') . $data['id'] . '/' . $data['image_main']) : asset(Config::get('custom.images_folder') . 'default.jpg');
            $data['image_main_url_mini'] = !empty($data['image_main']) ? asset(Config::get('custom.images_folder') . $data['id'] . '/mini_' . $data['image_main']) : asset(Config::get('custom.images_folder') . 'default.jpg');
            $data['image_main_url_fit'] = !empty($data['image_main']) ? asset(Config::get('custom.images_folder') . $data['id'] . '/mini_' . $data['image_main']) : asset(Config::get('custom.images_folder') . 'default.jpg');
            $img = Image::make($data['image_main_url_fit'])->fit(500);
            $constructor_image_path = public_path(Config::get('custom.images_folder')) . $data['id'] . '/';
            $filename_fit = $constructor_image_path . 'fit_' . $data['image_main'];
            $img->save($filename_fit, 100);
            $data['image_main_url_fit'] = asset(Config::get('custom.images_folder') . $data['id'] . '/fit_' . $data['image_main']);

        }

        return $data;

    }

    public function setImageMini($posts)
    {

        $w_init = 1000;
        $h_init = 700;

        $constructor_image_path = public_path(Config::get('custom.images_folder')) . $posts['id'] . '/';

        $name_image = $constructor_image_path . '/' . $posts['image_main'];
        $name_image_mini = $constructor_image_path . '/' . $posts['image_main_mini'];

        $img = Image::make($name_image);

        $w_load = $img->width();
        $h_load = $img->height();
        $w_proc = null;
        $h_proc = null;
        if(($w_load >= $w_init) && ($h_load < $h_init))
        {
            $w_proc = $w_init;
            $h_proc = null;
        }
        if(($w_load < $w_init) && ($h_load >= $h_init))
        {
            $w_proc = null;
            $h_proc = $h_init;
        }
        if((($w_load >= $w_init) && ($h_load >= $h_init)) || (($w_load < $w_init) && ($h_load < $h_init)))
        {
            $p_w = $w_load/$w_init;
            $p_h = $h_load/$h_init;
            if($p_w > $p_h)
            {
                $w_proc = $w_init;
                $h_proc = null;
            }
            else
            {
                $w_proc = null;
                $h_proc = $h_init;
            };
        };

        $img->resize($w_proc, $h_proc, function ($constraint) {
            $constraint->aspectRatio();
        });

        $img->save($name_image_mini, 100);

        $w_mini = $img->width();
        $h_mini = $img->height();
        Picture::saveWH($posts['id'], $w_mini, $h_mini);

        return;

    }

    public function check_integrity()
    {
        $posts = Picture::getAllPictures();
        if (count($posts) > 0)
        {
            foreach ($posts as $key => $post)
            {
                $id = $post['id'];
                $number_zone = $post['number_zone'];
                $isId = true;
                for($i=0; $i < $number_zone; $i++)
                {
                    switch ($i)
                    {
                        case '0':
                            $isId = Picture_1::checkId($id);
                            break;
                        case '1':
                            $isId = Picture_2::checkId($id);
                            break;
                        case '2':
                            $isId = Picture_3::checkId($id);
                            break;
                        case '3':
                            $isId = Picture_4::checkId($id);
                            break;
                        case '4':
                            $isId = Picture_5::checkId($id);
                            break;
                        case '5':
                            $isId = Picture_6::checkId($id);
                            break;
                        case '6':
                            $isId = Picture_7::checkId($id);
                            break;
                        case '7':
                            $isId = Picture_8::checkId($id);
                            break;
                        case '8':
                            $isId = Picture_9::checkId($id);
                            break;
                        case '9':
                            $isId = Picture_10::checkId($id);
                            break;
                    };

                    if(!$isId)
                    {
                        break;
                    }
                }

                if(!$isId)
                {
                    $this->delete_game($id);
                }
            }
        }

        return;

    }

    public function switch_image_del($image_del, $image_id){

        switch ($image_del)
        {
            case '0':
                Picture_1::deletePicture($image_id);
                break;
            case '1':
                Picture_2::deletePicture($image_id);
                break;
            case '2':
                Picture_3::deletePicture($image_id);
                break;
            case '3':
                Picture_4::deletePicture($image_id);
                break;
            case '4':
                Picture_5::deletePicture($image_id);
                break;
            case '5':
                Picture_6::deletePicture($image_id);
                break;
            case '6':
                Picture_7::deletePicture($image_id);
                break;
            case '7':
                Picture_8::deletePicture($image_id);
                break;
            case '8':
                Picture_9::deletePicture($image_id);
                break;
            case '9':
                Picture_10::deletePicture($image_id);
                break;
        };

        return;
    }


}

