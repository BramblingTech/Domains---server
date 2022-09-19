<?php

use App\Router;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\Http\Middleware\Exceptions\TokenMismatchException;

require_once 'helpers/functions.php';
require_once 'helpers/helpers.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

response()->headers([
    'Access-Control-Allow-Origin: *',
    'Access-Control-Allow-Methods: *',
    'Access-Control-Allow-Headers: *'
]);

try {
    Router::start();
} catch (TokenMismatchException $e) {
    echo 'token mismatch';
} catch (NotFoundHttpException $e) {
    echo 'not found';
} catch (\Pecee\SimpleRouter\Exceptions\HttpException $e) {
    echo 'http exception';
} catch (Exception $e) {
    echo 'global exception';
}