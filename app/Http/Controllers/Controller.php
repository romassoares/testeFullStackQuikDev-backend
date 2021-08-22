<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{

    protected  $apiKey = '?api_key=4ec327e462149c3710d63be84b81cf4f&language=en-US';
    protected  $url = 'https://api.themoviedb.org/3/';

    public function curlOpt($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = json_decode(curl_exec($ch));
        return  $result;
    }

    public function index()
    {
        $url = $this->url . 'trending/all/day' . $this->apiKey;
        $curl = $this->curlOpt($url);
        return response()->json($curl)->header('Access-Control-Allow-Origin', '*');
    }

    public function details($id)
    {
        $url = "" . $this->url . "/" . "movie/" . $id  . $this->apiKey;
        $curl = $this->curlOpt($url);
        return response()->json($curl)->header('Access-Control-Allow-Origin', '*');
    }

    public function genre()
    {
        $url = "" . $this->url . '/genre/movie/list' . $this->apiKey;
        $curl = $this->curlOpt($url);
        return response()->json($curl)->header('Access-Control-Allow-Origin', '*');
    }

    public function search($label)
    {
        $url = "" . $this->url . 'search/movie' . $this->apiKey . '&query=' . $label;
        $curl = $this->curlOpt($url);
        return response()->json($curl)
            ->header('Access-Control-Allow-Origin', '*');
    }
}
