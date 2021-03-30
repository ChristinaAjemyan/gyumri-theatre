<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 17.03.2021
 * Time: 17:11
 */

namespace frontend\controllers;


use Yii;
use yii\web\Controller;

class TicketController extends Controller
{

    public static function getTicketTimelines($id = '')
    {
        $par = (isset($_GET['orderID']) || isset($_GET['external_order_id']) && isset($_GET['order_id'])) ? "?" . http_build_query($_GET) : "";

        $curl_handle=curl_init();

        if($id != ''){
            $par = "?unik_id=".$id;
        }

        if (Yii::$app->request->cookies->getValue('language') == 'ru'){
            $lng = "ru";
        }elseif (Yii::$app->request->cookies->getValue('language') == 'en'){
            $lng = "en";
        }else {
            $lng = "hy";
        }

        curl_setopt($curl_handle, CURLOPT_URL,'https://api.haytoms.am/get/8a52a9c75db7a1f42c8c10fc62d397de/'.$lng.'/'.$par);

        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        $haytoms_data = curl_exec($curl_handle);
        curl_close($curl_handle);

        $result = json_decode($haytoms_data, false);

        return $result;
    }




}