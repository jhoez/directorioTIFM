<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "dirtelf.usuario".
 *
 * @property int $iduser
 * @property string|null $nombuser
 */
class Userextens extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dirtelf.userextens';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombuser'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iduser' => 'Iduser',
            'nombuser' => 'Nombuser',
        ];
    }
}
