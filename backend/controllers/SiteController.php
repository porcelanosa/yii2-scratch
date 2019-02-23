<?php
    
    namespace backend\controllers;
    
    use common\models\LoginForm;
    use Yii;
    use yii\helpers\ArrayHelper;

    /**
     * Site controller
     */
    class SiteController extends BasebackendController
    {
        /**
         * {@inheritdoc}
         */
        public function behaviors()
        {
            //I use array_merge() because ParentController extends from another custom controller.
            return ArrayHelper::merge(
                parent::behaviors(),
                [
                
                ]
            );
        }
        
        /**
         * {@inheritdoc}
         */
        public function actions()
        {
            return ArrayHelper::merge(
                parent::actions(),
                [
        
                ]
            );
        }
        
        /**
         * Displays homepage.
         *
         * @return string
         */
        public function actionIndex()
        {
            return $this->render('index');
        }
        
        /**
         * Login action.
         *
         * @return string
         */
        public function actionLogin()
        {
            if ( ! Yii::$app->user->isGuest) {
                return $this->goHome();
            }
            
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->goBack();
            } else {
                $model->password = '';
                
                return $this->render('login', [
                    'model' => $model,
                ]);
            }
        }
        
        /**
         * Logout action.
         *
         * @return string
         */
        public function actionLogout()
        {
            Yii::$app->user->logout();
            
            return $this->goHome();
        }
    }
