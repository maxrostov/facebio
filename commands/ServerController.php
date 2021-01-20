<?php
namespace app\commands;

use app\commands\CommandsServer;
use yii\console\Controller;

//https://github.com/consik/yii2-websocket

class ServerController extends Controller
{
    public function actionStart($port = 5555)
    {
        $server = new CommandsServer();
        if ($port) {
            $server->port = $port;
        }


//        $server->loop->addPeriodicTimer(5, function () use ($server) {
//            foreach ($server->app->clients as $client) {
//
//                $server->actionInsertPersonIntoScanner($client);
//            }
//        });

        echo "-===[server start]===-\n";
        $server->start();

    }
}