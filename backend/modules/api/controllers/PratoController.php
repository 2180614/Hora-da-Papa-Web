<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use common\models\User;

class PratoController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => [$this, 'auth']
        ];
        return $behaviors;
    }
    public function auth($username, $password)
    {
        $user = User::findByUsername($username);
        if ($user && $user->validatePassword($password)) {
            return $user;
        }
    }

    public $modelClass = 'app\models\Prato';

    //http://localhost/Hora-da-Papa-Web/backend/web/api/prato
    public function actionIndex()
    {
        $model = new $this->modelClass;
        $recs = $model::find()->all();
        return ['total' => count($recs)];
    }

    public function actionAdd()
    {
        $model = new $this->modelClass;
        $model->nome = \Yii::$app->request->post('nome');
        $model->categoria = \Yii::$app->request->post('categoria');
        $model->descricao = \Yii::$app->request->post('descricao');
        $model->preco = \Yii::$app->request->post('preco');
        $model->imagem = \Yii::$app->request->post('imagem');

        $ret = $model->save();

        if ($ret) {
            return 'Saved';
            $this->FazPublish('MESSAGE', 'Novo Prato');
        } else {
            $err = json_encode($model->getErrors());
            throw new \yii\web\HttpException(422, $err);
        }
    }

    public function actionDelete($id)
    {
        $model = new $this->modelClass;
        $ret = $model->deleteAll("id=" . $id);

        if ($ret) {
            \Yii::$app->response->statusCode = 200;
            return ['code' => 'ok'];
        }
        \Yii::$app->response->statusCode = 404;
        return ['code' => 'error'];
    }

    public function FazPublish($canal, $msg)
    {
        $server = "127.0.0.1";
        $port = 1883;
        $username = ""; // set your username
        $password = ""; // set your password
        $client_id = "phpMQTT-publisher"; // unique!
        $mqtt = new \app\mosquitto\phpMQTT($server, $port, $client_id);
        if ($mqtt->connect(true, NULL, $username, $password)) {
            $mqtt->publish($canal, $msg, 0);
            $mqtt->close();
        } else {
            file_put_contents("debug.output", "Time out!");
        }
    }
}
