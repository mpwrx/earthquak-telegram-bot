<?php

require 'vendor/autoload.php';

use Telegram\Bot\Api;
use Carbon\Carbon;


function convertToFa($string) {
    $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    $num = range(0, 9);
    return str_replace($num, $persian, $string);
}
function convertToEn($string) {
    $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    $num = range(0, 9);
    return str_replace($persian, $num, $string);
}
$telegram = new Api('271737428:AAF4nNsJS4o3TuWRAqJi_vuNyPexzVEC3KM');
    $items = new SimpleXMLElement(file_get_contents('http://irsc.ut.ac.ir/events_list_fa.xml'));
$y = convertToFa(date("h:i"));
    $text = " " . "\n";
    $text .= "آخرین ۲۰ زمین لرزه ثبت شده تا ساعت {$y} امروز :" . "\n";
    foreach ($items as $item) {
        $str = str_replace('/', '-', convertToEn($item->date));
        $dt = new DateTime($str);
        $x = convertToFa($dt->format('h:i'));
        $text .= "<a href=\"http://irsc.ut.ac.ir/newsview_fa.php?&eventid={$item->id}&network=earth_ismc__\">{$item->reg1}  {$item->mag} ریشتر در ساعت {$x}</a> \n";
    }

    $response2 = $telegram->sendMessage([
        'chat_id' => '63250673',
        'parse_mode' => 'HTML',
        'text' => $text,
        ]);

//    echo $text;





?>