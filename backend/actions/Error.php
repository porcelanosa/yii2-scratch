<?php
    
    namespace backend\actions;
    
    use yii\web\ErrorAction;

    class Error extends ErrorAction
    {
        
        /**
         * Renders a view that represents the exception.
         *
         * @return string
         * @since 2.0.11
         */
        protected function renderHtmlResponse()
        {
            $this->controller->layout = 'errorLayout'; // определяем layout для страницы ошибок
            
            return $this->controller->render($this->view ? : $this->id, $this->getViewRenderParams());
        }
    }
