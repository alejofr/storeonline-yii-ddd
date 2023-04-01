<?php

namespace app\traits;

use yii\web\Response;

trait ApiResponse

{

    /**
     * Build a success response
     * @param string|array $data
     * @param int $code
     * @return Illuminate\Http\JSONResponse
     */

    public function formatJson(){
        $this->response->format = Response::FORMAT_JSON;
    }

    public function responseJson($data, $code){
        $response = \Yii::$app->has('response') ? \Yii::$app->response : new Response();
        $response->format = Response::FORMAT_JSON;

        $response->statusCode = $code;
        $response->data= $data;
        $response->send();

    }

    public function successResponse($data, $code = 200)
    {
        $this->responseJson($data, $code);
    }

    /**
     * Build a error response
     * @param string $message
     * @param int $code
     * @return Illuminate\Http\JSONResponse
     */

    public function errorResponse($message, $code)
    {

        $this->responseJson(['error' => $message], $code);
    }
}