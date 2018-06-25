<?php

namespace App\Http\Controllers;

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
use Image;
use Config;
use Illuminate\Support\Facades\File;


class PuzzlesController extends Controller
{

    public function __construct()
    {
    }

    public function games()
    {

        $posts = $this->check_integrity();

        $data['posts'] = $this->picture_constructor($posts, null);

        $data['large_image'] = asset('images/backimg.jpg');

        return view('games_main', $data);
    }

    public function game_id($image_id)
    {
        $picDescriptions = [];

        $post = Picture::getPicture($image_id);

        $number_zone = $post['number_zone'];
        for($i=0; $i < $number_zone; $i++)
        {
            switch ($i)
            {
                case '0':
                    $picDescriptions[$i] = Picture_1::getDescription($image_id);
                    break;
                case '1':
                    $picDescriptions[$i] = Picture_2::getDescription($image_id);
                    break;
                case '2':
                    $picDescriptions[$i] = Picture_3::getDescription($image_id);
                    break;
                case '3':
                    $picDescriptions[$i] = Picture_4::getDescription($image_id);
                    break;
                case '4':
                    $picDescriptions[$i] = Picture_5::getDescription($image_id);
                    break;
                case '5':
                    $picDescriptions[$i] = Picture_6::getDescription($image_id);
                    break;
                case '6':
                    $picDescriptions[$i] = Picture_7::getDescription($image_id);
                    break;
                case '7':
                    $picDescriptions[$i] = Picture_8::getDescription($image_id);
                    break;
                case '8':
                    $picDescriptions[$i] = Picture_9::getDescription($image_id);
                    break;
                case '9':
                    $picDescriptions[$i] = Picture_10::getDescription($image_id);
                    break;
            };

        }

        $data['posts'] = $this->picture_constructor($post, $picDescriptions);

        $data['large_image'] = asset('images/backimg.jpg');

        $data['smile_no'] = asset('images/smile-no.jpg');

        $data['smile_yes'] = asset('images/smile-yes.jpg');

        return view('game_id', $data);

    }

    public function picture_constructor($data, $descriptions)
    {

        if ( !empty($data[0]) )
        {
            foreach ($data as $key => $post) {
                $data[$key]['image_main_url'] = !empty($post['image_main']) ? asset(Config::get('custom.images_folder') . $post['id'] . '/' . $post['image_main']) : asset(Config::get('custom.images_folder') . '/' . 'default.jpg');
                $data[$key]['image_main_url_mini'] = !empty($post['image_main']) ? asset(Config::get('custom.images_folder') . $post['id'] . '/mini_' . $post['image_main']) : asset(Config::get('custom.images_folder') . '/' . 'default.jpg');
                $data[$key]['image_main_url_fit'] = !empty($post['image_main']) ? asset(Config::get('custom.images_folder') . $post['id'] . '/fit_' . $post['image_main']) : asset(Config::get('custom.images_folder') . '/' . 'default.jpg');
            }

        }
        else
        {

            $data['image_main_url'] = !empty($data['image_main']) ? asset(Config::get('custom.images_folder') . $data['id'] . '/' . $data['image_main']) : asset(Config::get('custom.images_folder') . 'default.jpg');
            $data['image_main_url_mini'] = !empty($data['image_main']) ? asset(Config::get('custom.images_folder') . $data['id'] . '/mini_' . $data['image_main']) : asset(Config::get('custom.images_folder') . 'default.jpg');
            $data['image_main_url_fit'] = !empty($data['image_main']) ? asset(Config::get('custom.images_folder') . $data['id'] . '/fit_' . $data['image_main']) : asset(Config::get('custom.images_folder') . 'default.jpg');

            if (count($descriptions) > 0) {
                foreach ($descriptions as $key => $description) {

                    $description['image'] = asset(Config::get('custom.images_folder') . $data['id'] . '/' . $key . '_' . $description['path_part'] . '_' . $data['image_main']);

                }
                $data['description'] = $descriptions;
            }
        }

        return $data;

    }

    public function check_integrity()
    {
        $posts = Picture::getAllPictures();
        $posts_new = [];
        $j = 0;
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

                if($isId)
                {
                   $posts_new[$j] = $post;
                   $j++;
                }
            }
        }

        return $posts_new;

    }

}


