<?php

namespace App\Services\Links;

use App\Models\Link;
use Session;
use Auth;

class Service
{

    // Получаем все ссылки пользователя
    public function get()
    {
        return Link::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(20);
    }

    // Создаем ссылку
    public function create($data)
    {
        // Проверяем, что это ссылка, а не 45767578
        $is_link = filter_var($data->link, FILTER_VALIDATE_URL);
        if(!$is_link) return Session::flash('error', "Введите ссылку!");

        try {
            $link = self::generate($data->link);

            Link::firstOrCreate([
                'default_link' => $link
            ], [
                'default_link' => $data->link,
                'generate_link' => $link,
                'user_id' => Auth::user()->id,
            ]);

            Session::flash('success', "Успешно!");

            return response()->json([
                'error' => false,
                'data' => 'success'
            ]);

        } catch (\Throwable $th) {
            Session::flash('error', "Ошибка!");
            return response()->json($th);
        }
    }

    // remove
    public function delete($id)
    {
        Link::find($id)->delete();
        Session::flash('info', "Успешно удалено!");
    }

    public function redirect($link)
    {
        $http = 'http://';
        if($_SERVER['APP_URL'][5] == 's') $http = 'https://';  
        $data = Link::where('generate_link', $http.$_SERVER['HTTP_HOST'].'/'.$link)->first();
        return $data->default_link;
    }

    // Сокращаем ссылку
    private function generate($link)
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $length = strlen($chars);
        $data = '';
        for($i = 0; $i < 3; $i++) {
            $random = $chars[mt_rand(0, $length - 1)];
            $data .= $random;
        }

        $http = 'http://';
        if($_SERVER['APP_URL'][5] == 's') $http = 'https://';  
        return $http.$_SERVER['HTTP_HOST'].'/'.$data;
    }

}

?>