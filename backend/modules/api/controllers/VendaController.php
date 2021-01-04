<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use common\models\User;

class VendaController extends ActiveController
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

    public $modelClass = 'app\models\Venda';

    //http://localhost/Hora-da-Papa-Web/backend/web/api/venda
    public function actionIndex()
    {
        $model = new $this->modelClass;
        $recs = $model::find()->all();
        return ['total' => count($recs)];
    }

    public function actionAdd()
    {
        $model = new $this->modelClass;
        $model->user_id = \Yii::$app->request->post('user_id');
        $model->takeaway = \Yii::$app->request->post('takeaway');
        $model->mesa = \Yii::$app->request->post('mesa');
        $model->preco = \Yii::$app->request->post('preco');
        $model->data_entrada = \Yii::$app->request->post('data_entrada');
        $model->data_saida = \Yii::$app->request->post('data_saida');

        $ret = $model->save();

        if ($ret)
            return 'Saved';
        else {
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
}
