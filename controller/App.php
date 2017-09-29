<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/app/mainController.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/app/controllers/rolesController.php');
require_once ('config-crm/db/db-connection.php');
class App{
    private $url = [];
    private $controller;
    private $params = [];
    public function __construct(){
        global $app;
        $app = $this;
        //$this->add(RouteName, UrlYouWant, MethodOfClass, ClassController)
        $this->add('homepage', '/', 'index' , 'mainPage');
        $this->add('userProfile', '/myprofile/', 'getProfile', 'users');
        $this->add('listUsers', '/users/', 'getUsersPage', 'users');
        $this->add('listUsers', '/users/page/([0-9]+)', 'getUsersPage', 'users');
        $this->add('removeUser', '/users/removeuser/([0-9]+)', 'deleteUser', 'users');
        $this->add('addUser', '/users/newUser', 'newUser', 'users');
        $this->add('showUser', '/users/user/([0-9]+)', 'getUsers', 'users');
        $this->add('editUsers', '/users/edit/([0-9]+)', 'editUser', 'users');
        $this->add('activateAccount', '/activate/', 'activateAccount', 'clients');
        $this->add('login', '/login/', 'login', 'mainPage');
        $this->add('logout', '/logout/', 'logout', 'mainPage');
        $this->add('register', '/register/', 'register', 'mainPage');
        $this->add('dbinstall', '/db-install/', 'dbinstall', 'mainPage');
        $this->add('settings', '/settings/', 'index', 'adminPage');
        
    }
    public function add($routename, $url, $method, $controller)
    {
        $url = "/". trim($url,"/");
        $urlnoparam = preg_replace('/\([^)]+\)/','',$url);
        $urlnoparam = preg_match("#^$urlnoparam$#", $urlnoparam, $params);
        $urlnoparam = $params[0];
        $this->_URL[$url] = array(
                'routename' => $routename,
                'url' => $url,
                'urlnoparam' => $urlnoparam,
                'method' => $method,
                'controller' => $controller,
        );
    }
    public function getUrl($routename){
        foreach($this->_URL as $key => $value){
            if($value['routename'] == $routename){
                    $getUrl = $value['urlnoparam'];
                    break;
            }
        }
        return isset($getUrl)? $getUrl : '';
    }
    public function submit(){
       
        $url = (isset($_GET['url']) && $_GET['url'] != "") ? $_GET['url'] : "/";
        $url = "/". trim($url, "/");
        foreach($this->_URL as $key => $value){

            if(preg_match("#^$value[url]$#", $url, $params)){
                    $route = $this->_URL[$key];
                    break;
            }
        }
        if (isset($route)){
           
                if(file_exists('./app/controllers/'. $route['controller'] .'Controller.php' )){

                        require_once ($_SERVER['DOCUMENT_ROOT'].'/app/controllers/' . $route['controller'] . 'Controller.php');
                        $controller = new $route['controller'];
                        if(method_exists($controller, $route['method']))
                        {
                                $method = $route['method'];
                        }else{
                            
                                echo "Page not found";
                                exit();
                        }

                }else{
                    
                        echo "Page not found";
                        exit();
                        }
        unset($params[0]);
        call_user_func_array([$controller, $method], $params);

        }else{
                echo "Page not found";
        }
    }
    public function checkUserActive(){
        $time = time();
        if(isset($_SESSION['auth'])){
        $sessionstart = isset($_SESSION['end'])? $_SESSION['end'] : 0;
        if($time > $sessionstart){
            session_unset();
            session_destroy();
            $message['message'] = 'Your session has been expired';
            $view = new Controller;
            return $view->view('../views/mainPage',$message);
        }else{
            $_SESSION['end'] = $time + 60;
        }
        }
    }
	/*public function parseUrl(){
		if (isset($_GET['url'])){
			return $url = explode('/',filter_var(rtrim($_GET['url'], '/'),FILTER_SANITIZE_URL));
		}
	}*/

}

?>