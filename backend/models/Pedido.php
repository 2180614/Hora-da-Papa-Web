<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedido".
 *
 * @property int $id
 * @property int $venda_id
 * @property int $prato_id
 * @property int $quantidade
 * @property string|null $descricao
 * @property int $status
 *
 * @property Prato $prato
 * @property Venda $venda
 */
class Pedido extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['venda_id', 'prato_id', 'quantidade', 'status'], 'required'],
            [['venda_id', 'prato_id', 'quantidade', 'status'], 'integer'],
            [['descricao'], 'string'],
            [['prato_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prato::className(), 'targetAttribute' => ['prato_id' => 'id']],
            [['venda_id'], 'exist', 'skipOnError' => true, 'targetClass' => Venda::className(), 'targetAttribute' => ['venda_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'venda_id' => 'Venda ID',
            'prato_id' => 'Prato ID',
            'quantidade' => 'Quantidade',
            'descricao' => 'Descricao',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Prato]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrato()
    {
        return $this->hasOne(Prato::className(), ['id' => 'prato_id']);
    }

    /**
     * Gets query for [[Venda]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVenda()
    {
        return $this->hasOne(Venda::className(), ['id' => 'venda_id']);
    }
}
