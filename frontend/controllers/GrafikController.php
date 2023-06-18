<?php
namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use yii\web\BadRequestHttpException;
use yii\helpers\Url;
use common\models\Grafik;
use common\models\User;


class GrafikController extends Controller
{

    public $days = array( 1 => 'Пн' , 'Вт' , 'Ср' , 'Чт' , 'Пт' , 'Сб' , 'Вс' );




	public function actionIndex()
    {
        $users = $this->findUsers();
        $dayArray = array(
            $this->days[date( 'N',  strtotime('-1 day'))] => date("Y-m-d",  strtotime('-2 day')),
            $this->days[date( 'N',  strtotime('-1 day'))] => date("Y-m-d",  strtotime('-1 day')),
            $this->days[date( 'N' )] => date("Y-m-d"),
            $this->days[date( 'N',  strtotime('+1 day'))] => date("Y-m-d",  strtotime('+1 day')),
            $this->days[date( 'N',  strtotime('+2 day'))] => date("Y-m-d",  strtotime('+2 day')),
            $this->days[date( 'N',  strtotime('+3 day'))] => date("Y-m-d",  strtotime('+3 day')),
            $this->days[date( 'N',  strtotime('+4 day'))] => date("Y-m-d",  strtotime('+4 day')),

         );


        return $this->render('index',
       [
        'users' => $users,
        'dayArray' => $dayArray,
        'days' => $this->days,
       ]
    );
    }

	public function actionSave()
    {
        if($this->days[date( 'N' )] != 'Сб' && $this->days[date( 'N' )] != 'Вс') {
                $users = $this->findUsers();
                $nextUser = $this->nextUser();
                $nextSave = $this->nextSave($users, $nextUser);

                $model = new Grafik;
                $model->user_id = $nextSave;
                $model->date = date("Y-m-d");
                $model->save();
        }
    }










    protected function nextSave($users, $nextUser) {
        foreach ($users as $key => $user) {
            if($nextUser->user_id == $user->id) {
            $keys = $key+1;
            break;
            }
        }
        foreach ($users as $key => $user) {
            if($keys == $key) { 
                return $user->id;
            }
        }
        return $users[0]->id;
    }
    protected function nextUser() {
        $grafik = Grafik::find()->orderby(['id' => SORT_DESC])->One();
        return  $grafik;
    }
    protected function findUsers() {
        if($users = User::find()->where(['status' => 10])->all()) {
            return $users;
        }
    }
	
}
