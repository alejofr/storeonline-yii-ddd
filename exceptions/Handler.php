<?php

namespace app\exceptions;

use app\traits\ApiResponse;
use InvalidArgumentException;
use yii\base\ErrorHandler;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class Handler extends ErrorHandler{
    use ApiResponse;

    /**
     * Renders the exception.
     * @param \Exception $exception the exception to be rendered.
    */
 

    protected function renderException($exception)
    {
       

        if($exception instanceof NotFoundHttpException || $exception instanceof HttpException)
        {
            $code = $exception->statusCode;
            $message = $exception->getMessage();
        

            $this->errorResponse($message, $code);
        }

        if( $exception instanceof InvalidArgumentException ){
            $message = $exception->getMessage();
            $code = $exception->getCode();

            return $this->errorResponse($message, $code);
        }



        return $this->errorResponse(['exception' => $exception], 500);
        
    }

}