<?php

namespace backend\modules\api\controllers;

use yii\rest\ActiveController;

class PratoController extends ActiveController
{
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
