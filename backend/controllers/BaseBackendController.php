<?php
    
    namespace backend\controllers;
    
    use dektrium\user\filters\AccessRule;
    use Yii;
    use yii\filters\AccessControl;
    use yii\filters\VerbFilter;
    use yii\web\Controller;

    /**
     * Site controller
     */
    class BaseBackendController extends Controller
    {
        /**
         * @inheritdoc
         */
        public function behaviors()
        {
            return [
                'access' => [
                    'class'      => AccessControl::class,
                    'ruleConfig' => [
                        'class' => AccessRule::class,
                    ],
                    'rules'      => [
                        [
                            'actions' => ['login', 'error'],
                            'allow'   => true,
                        ],
                        [
                            'actions' => ['logout'],
                            'allow'   => true,
                            'roles'   => ['@'],
                        ],
                        [
                            'allow'        => true,
                            'roles'        => ['admin'],
                            'denyCallback' => function ($rule, $action) {
                                Yii::$app->session->setFlash('info', 'You are already logged in, no need to reset password');
                                
                                return $action->controller->redirect('/site/index');
                            },
                        ],
                    ],
                ],
                'verbs'  => [
                    'class'   => VerbFilter::class,
                    'actions' => [
                        'logout' => ['post'],
                    ],
                ],
            ];
        }
        
        /**
         * {@inheritdoc}
         */
        public function actions()
        {
            return [
                'error' => [
                    //'class' => 'yii\web\ErrorAction', // старая стандартная страница ошибок
                    'class' => 'backend\actions\Error',
                ],
            ];
        }
        
    }
