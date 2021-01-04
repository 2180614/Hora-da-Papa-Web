<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;

class PedidoController extends ActiveController
{
    public $modelClass = 'app\models\Pedido';

    //http://localhost/Hora-da-Papa-Web/backend/web/api/pedido
    public function actionIndex()
    {
        $model = new $this->modelClass;
        $recs = $model::find()->all();
        return ['total' => count($recs)];
    }

    public function actionAdd()
    {
        $model = new $this->modelClass;
        $model->venda_id = \Yii::$app->request->post('venda_id');
        $model->prato_id = \Yii::$app->request->post('prato_id');
        $model->quantidade = \Yii::$app->request->post('quantidade');
        $model->descricao = \Yii::$app->request->post('descricao');
        $model->status = \Yii::$app->request->post('status');

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
