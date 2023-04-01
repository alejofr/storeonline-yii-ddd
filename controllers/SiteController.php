<?php

namespace app\controllers;

use yii\web\Controller;

class SiteController extends Controller
{
    
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
     * Displays dashboardpage.
     *
     * @return string
     */
    public function actionDashboard()
    {
        return $this->render('dashboard');
    }

}
