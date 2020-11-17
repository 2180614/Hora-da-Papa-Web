<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prato".
 *
 * @property int $id
 * @property string $nome
 * @property string $categoria
 * @property string|null $descricao
 * @property float $preco
 * @property string|null $imagem
 *
 * @property Pedido[] $pedidos
 */
class Prato extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prato';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'categoria', 'preco'], 'required'],
            [['categoria', 'descricao'], 'string'],
            [['preco'], 'number'],
            [['nome', 'imagem'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'categoria' => 'Categoria',
            'descricao' => 'Descricao',
            'preco' => 'Preco',
            'imagem' => 'Imagem',
        ];
    }

    /**
     * Gets query for [[Pedidos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['prato_id' => 'id']);
    }
}
