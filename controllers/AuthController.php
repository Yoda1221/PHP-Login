<?php

namespace App\controllers;

use App\core\Application;
use App\core\Controller;
use App\core\Request;
use App\models\RegModel;

class AuthController extends Controller {

    public static function login(Request $request) {
        
        $body = $request->getBody();
        
        if ($request->isPost()) {
            return "Submitted login data!";
        }
        
        return Application::$app->router->renderView('login');
        
    }
    
    public static function registration(Request $request) {

        $errors = [];
        
        $regModel = new RegModel();
        if ($request->isPost()) {
            $regModel->loadData($request->getBody());

            dump($regModel);

            if ($regModel->validate() && $regModel->register()) {
                return "SUCCESS";
            }
             
            return Application::$app->router->renderView('registration', [
                'model' => $regModel
            ]);
        }
        
        $body = $request->getBody();
        
        
        return Application::$app->router->renderView('registration', [
            'model' => $regModel
        ]);


    }


}
