<?
namespace common\models;
use Yii;
use yii\helpers\Html;
use yii\base\Model;
use common\models\BotSearch;
use common\models\BotAdd;
use common\models\Region;
use common\models\Passanger;
use common\models\PassangerFields;
use common\models\Point;
use common\models\PointOt;
class Tgram extends Model
{
	protected $token = '6090651812:AAEdHKinP0EZ8_PLyz1zQX58gKrVXU-DWZs'; //ваш токен
	public $return;
	
	public function getReq($method,$params=[],$decoded=0){ //параметр 1 это метод, 2 - это массив параметров к методу, 3 - декодированный ли будет результат будет или нет.
		$url =  "https://api.telegram.org/bot{$this->token}/$method"; //основная строка и метод
		if(count($params)){
			$url=$url.'?'.http_build_query($params);//к нему мы прибавляем парметры, в виде GET-параметров
		}
 
		
		$curl = curl_init($url);    //инициализируем curl по нашему урлу
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);   //здесь мы говорим, чтобы запром вернул нам ответ сервера телеграмма в виде строки, нежели напрямую.
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);   //Не проверяем сертификат сервера телеграмма.
		$result = curl_exec($curl);   // исполняем сессию curl
		curl_close($curl); // завершаем сессию
		if($decoded){
			return json_decode($result);// если установили, значит декодируем полученную строку json формата в объект языка PHP
		}
	
		$this->return = json_decode($result);
		return $result; //Или просто возращаем ответ в виде строки
	}
	
	

    public function sendTelegram($text, $chat_id)
    {
        //pr($text); exit();
        $tgm = new Tgram();
        $tgm->getReq(
            'sendMessage',
            [
                'chat_id' => $chat_id,
                'text' => $text,
                'parse_mode' => 'html',
  
            ]
        );
    }
}
