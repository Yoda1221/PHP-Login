<?php

namespace App\core;

use App\core\Model;
use App\core\DbModel;
use App\core\Controller;

/**
 ** Class Application
 *
 */
class Application {

    public string $userClass;
    public Database $db;
    public ?Model $user;
    public Model $model;
    public Router $router;
    public Session $session;
    public Request $request;
    public Response $response;
    public Controller $controller;
    public static string $ROOT_DIR;
    public static Application $app;

    public function __construct($rootPath, array $config) {
        self::$app      = $this;
        self::$ROOT_DIR = $rootPath;
        $this->userClass = $config['userClass'];
        $this->session  = new Session();    
        $this->request  = new Request();    
        $this->response = new Response();    
        $this->db       = new Database($config['db']);
        $this->router   = new Router($this->request, $this->response);
        $this->model = new Model();

        $primaryVal = $this->session->get('user');
        if ($primaryVal) {
            $primaryKey = $this->model->primaryKey();
            $this->user = $this->model->findData([$primaryKey => $primaryVal], 'users'); //$this->userClass->findUser([$primaryKey, $primaryVal]);
        } else {
            $this->user = null;
        }
    }

    public function run() {
        echo $this->router->resolve();
    }

    /**
     ** GET CONTROLLER
     *
     * @return Controller
     */
    public function getController(): Controller {
        return $this->controller;
    }

    /**
     ** SET CONTROLLER
     *
     * @return Controller $controller
     */
    public function setController(Controller $controller): void {
        $this->controller = $controller;
    }

    public function login(DbModel $user) {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryVal = $user->{$primaryKey};
        $this->session->set('user', $primaryVal);
        return true;
    }

    public static function isGuest() {
        return !self::$app->user;
    }

    public function logout() {
        $this->user = null;
        $this->session->remove('user');
    }

}