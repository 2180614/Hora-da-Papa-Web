<?php

namespace app\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "utilizador".
 *
 * @property int $user_id
 * @property string $p_nome
 * @property string|null $u_nome
 * @property string|null $tlm
 *
 * @property User $user
 */
class Utilizador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'utilizador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'p_nome'], 'required'],
            [['user_id'], 'integer'],
            [['p_nome', 'u_nome', 'tlm'], 'string', 'max' => 255],
            [['tlm'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'p_nome' => 'P Nome',
            'u_nome' => 'U Nome',
            'tlm' => 'Tlm',
        ];
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
