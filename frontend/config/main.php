<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'SearchTasks' => [
            'class' => 'frontend\modules\SearchTasks\SearchTasks',
        ],
    ],
    'container' => [
        'definitions' => [
            \yii\widgets\LinkPager::class => \yii\bootstrap4\LinkPager::class,
        ],
    ],
    'components' => [
        'formatter' => [
            'dateFormat' => 'dd.MM.yyyy',
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => 'Не заполнено',
        ],
        'calendar' => [
            'class' => 'understeam\calendar\ActiveRecordCalendar',  // Имя класса календаря
            'modelClass' => 'app\models\Event',                     // Имя класса модели
            'dateAttribute' => 'date',                              // Атрибут модели, в котором хранится дата (тип в БД timestamp или datetime)
            'dateRange' => [time() + 86400, time() + 2592000]       // период, в который будет доступно событие onClick
            // Так же в dateRange можно передать функцию, которая должна вернуть нужный массив в случае если нужны динамические вычисления
            // 'dateRange' => ['app\models\User', 'getCalendarRange'],
            
            // Пример
            // 'filter' => function ($query, $startTime, $endTime) {
            //     return $query->andWhere(['userId' => Yii::$app->user->id]);
            // },
            // Или так
            // 'filter' => ['app\models\User', 'filterCalendarQuery'],
        ],
	 'errorHandler' => [
        'errorAction' => 'site/error',
     ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
			'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'image' => [
           'class' => 'yii\image\ImageDriver',
           'driver' => 'GD',  //GD or Imagick
           //Если выйдет ошика, заиенить imagick на GD
           ],
		'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' =>[
                '/' => 'task/index',
                'searchtasks' => 'SearchTasks',
                [
                    'pattern' => '<slug:.+>',
                    'route' => 'content/view',
                    'mode' => \yii\web\UrlRule::CREATION_ONLY
                ],
                
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<controller:\w+>/<id:\d+>' => '<controller>/index',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
            ],
        ],
    ],
    'as beforeRequest' => [
        'class' => 'yii\filters\AccessControl',
        'rules' => [
            [
                'allow' => true,
                'actions' => ['login'],
            ],
            [
                'allow' => true,
                'actions' => ['signup'],
            ],
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
        'denyCallback' => function () {
            return Yii::$app->response->redirect(['site/login']);
        },
    ],
    'params' => $params,
];
