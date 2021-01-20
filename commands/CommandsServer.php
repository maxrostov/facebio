<?php

namespace app\commands;

use consik\yii2websocket\WebSocketServer;
use Ratchet\ConnectionInterface;
use app\models\Visit;
use app\models\Person;
use yii\db\Expression;

//https://github.com/consik/yii2-websocket

class CommandsServer extends WebSocketServer
{
    public $login = FALSE;
    public $serial_num = '';

    /**
     * override method getCommand( ... )
     *
     * For example, we think that all user's message is a command
     */
    protected function getCommand(ConnectionInterface $from, $msg)
    {
//        if ($this->login) $this->insertPersonIntoScanner($from);
        //   echo "MSG=".$msg."\n\n\n";
        $xml = simplexml_load_string($msg);
        if ($xml->Request) {
            $command = strtolower($xml->Request);
        } elseif ($xml->Event) {
            $command = strtolower($xml->Event);
        } elseif ($xml->Response) {
            $command = strtolower($xml->Response);
        }

        $datetime = date('d/m H:s.v');
        echo "\n--- SCANNER >>> server [$command ] $datetime\n" . $msg . "\n\n\n";
        return $command;
    }

    function actionGetFingerData(ConnectionInterface $client)
    {
        echo 'actionGet FINGER Data start';
        $no_finger_person = Person::find()->where(['finger_data' => NULL])->orderBy(new Expression('random()'))->one();
        //tmp hack - пока сюда ж не могу вставить полноценныц перебор
        // (ответ на запрос же в другом месте обрабатывается),
        // поэтому рандомно какбы переберу всех

        if ($no_finger_person) {

            $xml = "<?xml version=\"1.0\"?><Message><Request>GetFingerData</Request><UserID>" . $no_finger_person->id .
                "</UserID><FingerNo>0</FingerNo><Token>1234567</Token></Message>";
            $client->send($xml);
            echo "\n-- scanner <<< SERVER [actionGetFingerData]---------\n" . $xml . "\n\n\n";
        }

    }

    function actionGetFaceData(ConnectionInterface $client)
    {
        echo 'actionGet FACE Data start';
        $no_face_person = Person::find()->where(['face_data' => NULL])->orderBy(new Expression('random()'))->one();
        //tmp hack - пока сюда ж не могу вставить полноценныц перебор
        // (ответ на запрос же в другом месте обрабатывается),
        // поэтому рандомно какбы переберу всех

        if ($no_face_person) {

            $xml = "<?xml version=\"1.0\"?><Message><Request>GetFaceData</Request><UserID>" . $no_face_person->id .
                "</UserID><Token>1234567</Token></Message>";
            $client->send($xml);
            echo "\n-- scanner <<< SERVER [actionGetFaceData]---------\n" . $xml . "\n\n\n";
        }

    }


    function actionInsertPersonIntoScanner(ConnectionInterface $client)
    {
        echo "\n-- [INSERT_PERSON SetUserData] start\n";
        $new_person = Person::find()->where(['scanner_task' => 'INSERT'])->one();
        // TODO!!!! почему-то не срабатывает  поиск по двум запросам или или... хотя в консоли срабатывает
        //      $new_person = Person::find()->where(['scanner_task' => 'DISABLE'])->one();
        //     $new_person = Person::find()->where("scanner_task= 'INSERT' OR scanner_task = 'DISABLE'")->one();


        if ($new_person) {
            if ($new_person->scanner_task == 'DISABLE') $disable = "<Enabled>No</Enabled>"; else $disable = '';
            echo 'SetUserData 3';
//$name = base64_encode($new_person->name_scanner,'UTF-16LE','UTF-8');
            $name = base64_encode(mb_convert_encoding($new_person->name_scanner, 'UTF-16LE', 'UTF-8'));
            $xml = "<?xml version=\"1.0\"?><Message><Request>SetUserData</Request><UserID>" . $new_person->id . "</UserID>$disable<Type>Set</Type><Name>$name</Name><AllowNoCertificate>Yes</AllowNoCertificate><Token>1234567</Token></Message>";

            $client->send($xml);

            echo "\n-- scanner <<< SERVER [INSERT_PERSON SetUserData]---------\n" . $xml . "\n\n\n";

        } else {
            echo 'SetUserData no person';
            $this->doRandomJob($client);
        }
    }


    function commandSetuserdata(ConnectionInterface $client, $msg)
    {
        $xml = simplexml_load_string($msg);

//    echo "\n--[SetUserData start xml->result = " . $xml->Result ."=".$xml->UserID."\n";
        if ($xml->Result == 'OK') {
            $person = Person::findOne($xml->UserID);
            $person->scanner_task = '';
            $person->save();
            echo "\n--[INSERT_PERSON SetUserData OK]---------\n" . $xml->id . "\n\n\n";
            if ($this->login) $this->doRandomJob($client);
        }
    }

    function commandTimelog_v2(ConnectionInterface $client, $msg)
    {
        echo "commandTimelog_v2 [1]\n";
        $xml = simplexml_load_string($msg);
        echo "commandTimelog_v2 [2]\n";
        $model1 = new Visit();
        $model1->person_id = (string)$xml->UserID;
        $model1->auth_type = (string)$xml->Action;
        $model1->trans_id = (integer)$xml->TransID;
        $model1->log_id = (integer)$xml->LogID;
        echo "commandTimelog_v2 [3]\n";
        $model1->visited_at = str_replace(['-T', 'Z'], [' ', ''], (string)$xml->Time);// индусы такие индусы! неправильная дата ISO 8601
        echo "commandTimelog_v2 [4]\n";
        $model1->save();
        echo "commandTimelog_v2 [5]\n";

        echo $responce = '<?xml version="1.0"?><Message><Response>TimeLog_v2</Response><TransID>'
            . $xml->TransID . '</TransID><Token>1234567</Token><Result>OK</Result></Message>';
        $client->send($responce);
        echo "commandTimelog_v2 [6]\n";
    }

    function commandGetFingerData(ConnectionInterface $client, $msg)
    {
        $xml = simplexml_load_string($msg);

        if ($xml->FingerData) {
            $person = Person::findOne($xml->UserID);
            $person->finger_data = $xml->FingerData;
            $person->save();
            echo "\n--[commandGetFingerData OK]---------\n\n\n\n";

        } elseif ($xml->Result == 'Fail') {
            echo "\n--[commandGetFingerData Fail]---------\n\n\n\n";
        }

        if ($this->login) $this->doRandomJob($client);
    }

    function commandGetFaceData(ConnectionInterface $client, $msg)
    {
        $xml = simplexml_load_string($msg);

        if ($xml->FaceData) {
            $person = Person::findOne($xml->UserID);
            $person->face_data = $xml->FaceData;
            $person->save();
            echo "\n--[commandGetFaceData OK]---------\n\n\n\n";

        } else //if ($xml->Result == 'Fail')
        {
            echo "\n--[commandGetFaceData Fail]---------\n\n\n\n";
        }

        if ($this->login) $this->doRandomJob($client);
    }

    function doRandomJob(ConnectionInterface $client)
    {
        $rand = rand(1, 3);
        if ($rand == 1) {
            $this->actionGetFingerData($client);
        } elseif ($rand == 2) {
            $this->actionGetFaceData($client);
        } elseif ($rand == 3) {
            $this->actionInsertPersonIntoScanner($client);
        }

    }

    function responceOK(ConnectionInterface $client, $responce_action)
    {

        $responce = '<?xml version="1.0"?><Message><Response>' . $responce_action . '</Response><DeviceSerialNo>' . $this->serial_num . '</DeviceSerialNo><Token>1234567</Token><Result>OK</Result></Message>';

        $client->send($responce);
        echo "\n-- scanner <<< SERVER [$responce_action OK]-----\n$responce\n\n\n";


    }

    function commandAdminlog_v2(ConnectionInterface $client, $msg)
    {
//        $this->responceOK($client, $msg);
        $xml = simplexml_load_string($msg);
        $id = $xml->TransID;
        echo $responce = '<?xml version="1.0"?><Message><Response>AdminLog_v2</Response><TransID>' . $id . '</TransID><Token>1234567</Token><Result>OK</Result></Message>';
        $client->send($responce);
        if ($this->login) $this->actionInsertPersonIntoScanner($client);
    }

    function commandRegister(ConnectionInterface $client, $msg)
    {
//        $this->responceOK($client, $msg);
        $xml = simplexml_load_string($msg);
        echo $responce = '<?xml version="1.0"?><Message><Response>Register</Response><DeviceSerialNo>' . $xml->DeviceSerialNo . '</DeviceSerialNo><Token>1234567</Token><Result>OK</Result></Message>';
        $client->send($responce);
    }


    function commandLogin(ConnectionInterface $client, $msg)
    {
        $xml = simplexml_load_string($msg);
        $this->responceOK($client, 'Login');
        $this->login = TRUE;
        $this->serial_num = $xml->DeviceSerialNo;

        if ($this->login) $this->actionInsertPersonIntoScanner($client);

    }


}

