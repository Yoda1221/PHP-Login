<?php

namespace App\controllers;

use App\core\Application;
use App\core\Controller;
use App\core\Request;
use App\models\User;

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
        $user   = new User();
        
        if ($request->isPost()) {
            $user->loadData($request->getBody());

            if ($user->validate() && $user->save()) {
                return "SUCCESS";
            }
            
            return Application::$app->router->renderView('registration', [
                'model' => $user
            ]);
        }
        
        $body = $request->getBody();
        
        return Application::$app->router->renderView('registration', [
            'model' => $user
        ]);


    }


}
