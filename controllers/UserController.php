<?php

namespace app\controllers;

use Yii;
use app\models\UserCreate;
use app\models\UserLogin;
use app\src\user\application\CreateUserUseCase;
use app\src\user\application\LoginUserUseCase;
use app\src\user\application\LogoutUserUseCase;
use yii\web\Controller;
use app\traits\ApiResponse;
use app\src\user\infrastructure\repositories\RecordPatternUser;
use yii\filters\auth\HttpBearerAuth;

class UserController extends Controller
{
    use ApiResponse;

    private RecordPatternUser $repository;

    public function behaviors()
    {

        return [
            [
                'class' =>  HttpBearerAuth::class,
                'only' => ['logout']
            ],
        ];

    }

    /**
     * User repository injection.
     * @param RecordPatternUser
    */

    public function __construct($id, $module, RecordPatternUser $repository, $config = [])
    {
        $this->repository = $repository;

        parent::__construct($id, $module, $config);
    }

    public function actionCreate()
    {
        $dataUser = Yii::$app->request->post();
        $formValidation = new UserCreate();

        // validate data form request
        $formValidation->attributes = $dataUser;

        if( $formValidation->validate() ){
            $userName     = $dataUser['name'];
            $userEmail    = $dataUser['email'];
            $userPassword = $dataUser['password'];
    
            $createUserUseCase = new CreateUserUseCase($this->repository);
            $user = $createUserUseCase->registerUser($userName, $userEmail, $userPassword);
            
            return $this->successResponse($user);
        }

        return $this->errorResponse($formValidation->errors, 403);
    }

    /**
     * Login action.
     *
     * @return Response
    */

    public function actionLogin()
    {
        $dataUser = Yii::$app->request->post();
        $formValidation = new UserLogin();

        // validate data form request
        $formValidation->attributes = $dataUser;

        if( $formValidation->validate() ){
            $loginUserUseCase = new LoginUserUseCase($this->repository);
            
            if( $userAuth = $loginUserUseCase->loginUser($dataUser['email'], $dataUser['password']) ){
                return $this->successResponse($userAuth);
            }

            return $this->errorResponse('These credentials do not match our records', 403);
        }

        return $this->errorResponse($formValidation->errors, 403);
    }


    /**
     * Logout action.
     *
     * @return Response
    */
    
    public function actionLogout()
    {
        $user = Yii::$app->user->identity;

        if( $user != null ){
            $logoutUserUseCase = new LogoutUserUseCase($this->repository);
            $logoutUserUseCase->logoutUser($user->id);
        }

        return $this->successResponse(null);
    }

}