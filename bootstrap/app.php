<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application(
    realpath(__DIR__.'/../')
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

//環境判定
if( strpos($_SERVER['SERVER_NAME'],'vagrant') ){
    define("IS_LOCAL", true);
}else{
    define("IS_LOCAL", false);
}

//ドメイン
if( IS_LOCAL ){
    define("APP_URL", "http://www.gladiator.vagrant.com/");
} else {
    define("APP_URL", "http://esmile-sys.sakura.ne.jp/gladiator/");
}

//サーバURL
define("SERVER_URL", "http://esmile-sys.sakura.ne.jp/gladiator/");
//画像サーバ
define("IMG_URL", SERVER_URL."img/");
//DBサーバ
define("DB_API_URL", SERVER_URL."dbapi/");

define("IMGTEST_URL", SERVER_URL."img/test/");

//URL解釈
$redirectUrl	= ( isset( $_SERVER['REDIRECT_URL'] ) )? explode('/', $_SERVER['REDIRECT_URL']) : array();
$controllerName = ( isset($redirectUrl[1]) )? $redirectUrl[1] : 'top';
$actionName	= ( isset($redirectUrl[2]) )? $redirectUrl[2] : 'index' ;
define("CONTROLLER_NAME", $controllerName);
define("ACTION_NAME", $actionName);

return $app;
