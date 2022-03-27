<?php
const APP_PATH = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR;
const STORAGE_PATH = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR;
const VIEW_PATH =
    __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR;

require_once APP_PATH.'exception/RouteNotFoundException.php';
require_once APP_PATH.'exception/ViewNotFoundException.php';
require_once APP_PATH.'Router.php';
require_once APP_PATH.'DB.php';
require_once APP_PATH.'models/Book.php';
require_once APP_PATH.'View.php';
require_once APP_PATH.'Session.php';
require_once APP_PATH.'controller/LibraryController.php';       /**/

use App\Router;
use App\DB;
use App\View;
use App\Session;
use App\Controller\LibraryController;                           /**/

session_start();

//útvonalakhoz tartozó függvények regisztrációja
$router = new Router();

$router->get('/dbtest', function (){
    /*
    $db = DB::getInstance();
    $res = $db->query("SELECT * FROM books");
    var_dump($res->fetchAll());
    */
    var_dump(DB::getInstance()->query("SELECT * FROM books")->fetchAll());
});

$router->get('/viewtest', function (){
    /*
    $view = new View('viewtest',[
        'title' => 'kiskecske',
        'content' => 'tartalom'
    ]);
    return $view;
    */
    return new View('viewtest', [
        'title'=> 'kiskecske',
        'content' => 'tartalom'
    ]);
});
$router->register('get', '/test1', function (){
    /// Amit szeretnénk a '/' utvonalra...
    echo 'test1 route';
});
$router->get('/test2', function (){
    /// Amit szeretnénk a '/a' útvonalra.
    echo 'test2 route';
});

$router->get('/set/cookie', function (){
    // COOKIE (aliasz süti) létrehozása 'COOKIE_NAME' néven
   setcookie('COOKIE_sajt', 'trapista', time() + 86400, '/');
});
$router->get('/delete/cookie', function (){
    setcookie('COOKIE_sajt', '', time()-3600,'/');
});
$router->get('/show/cookie', function() {
    var_dump($_COOKIE);
});

$router->get('/set/session', function (){
    Session::addMessage('Session messages WORKING');
    //$_SESSION['sajt'] = "trapista";
    //$_SESSION['innivaló'] = "forrocsoki";
});
$router->get('/delete/session', function (){
    unset($_SESSION['sajt']);
    //session_destroy(); // A Sessionből minden elem törlése!
});
$router->get('/show/session', function (){
    var_dump(Session::getMessages());
    var_dump($_SESSION);
    //echo session_save_path();
});

$router
    ->get('/', [LibraryController::class, 'index'])
    ->get('/create', [LibraryController::class, 'create'])
    ->post('/create', [LibraryController::class, 'store'])
    ->get('/details', [LibraryController::class, 'show'])
    ->get('/delete', [LibraryController::class, 'delete'])
    ->get('/edit', [LibraryController::class, 'edit'])
    ->post('/edit', [LibraryController::class, 'update']);

//további útvonalak felvétele..

try {
    echo $router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
} catch (\App\Exception\RouteNotFoundException $ex) {
    echo $ex->getMessage();
} catch (\App\Exception\ViewNotFoundException $ex){
    echo $ex->getMessage();
}