<?php

namespace app\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "venda".
 *
 * @property int $id
 * @property int $user_id
 * @property int $takeaway
 * @property int $mesa
 * @property float $preco
 * @property string $data_entrada
 * @property string $data_saida
 *
 * @property Pedido[] $pedidos
 * @property User $user
 */
class Venda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'venda';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'takeaway', 'mesa', 'preco'], 'required'],
            [['user_id', 'takeaway', 'mesa'], 'integer'],
            [['preco'], 'number'],
            [['data_entrada', 'data_saida'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'takeaway' => 'Takeaway',
            'mesa' => 'Mesa',
            'preco' => 'Preco',
            'data_entrada' => 'Data Entrada',
            'data_saida' => 'Data Saida',
        ];
    }

    /**
     * Gets query for [[Pedidos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['venda_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
