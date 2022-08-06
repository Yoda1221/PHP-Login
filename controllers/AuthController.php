<?php

namespace App\controllers;

use App\core\Application;
use App\core\Controller;
use App\core\Request;
use App\core\Response;
use App\models\LoginForm;
use App\models\User;

class AuthController extends Controller {

    public function login(Request $request, Response $response) {
        $loginForm = new LoginForm();
        
        if ($request->isPost()) {
           $loginForm->loadData($request->getBody());
           if ($loginForm->validate() && $loginForm->login()) {
               $response->redirect('/');
               return;
           }
        }
        
        return Application::$app->router->renderView('login', [
            "model" => $loginForm
        ]);
    }
    
    public static function registration(Request $request) {

        $errors = [];
        $user   = new User();
        
        if ($request->isPost()) {
            $user->loadData($request->getBody());

            if ($user->validate() && $user->save()) {
                Application::$app->session->setFlashMesg('success', 'Thanks for registration!');
                Application::$app->response->redirect('/');
                exit;
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

    public function logout(Request $request, Response $response) {
        Application::$app->logout();
        $response->redirect('/');
    }

}
