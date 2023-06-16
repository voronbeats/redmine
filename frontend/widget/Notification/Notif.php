<?php

namespace frontend\widget\Notification;

use common\models\Notification;
use yii;

use yii\base\Widget;
class Notif extends Widget
{
    public function run () {
        $models = Notification::find()->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['flag' => '0'])->orderBy(['date_add' => SORT_DESC])->limit(10)->all();
        $flag = $this->flag($models);
        return $this->render('index', [  
            'models' => $models,
            'flag' => $flag
        ]); 
    }
    public function flag($models) {
        foreach ($models as $res) {
            if($res->flag == '0') {
                return true;
            }
        }
        return false;
    }
}
?>
