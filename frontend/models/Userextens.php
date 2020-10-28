<?php

namespace frontend\models;

use Yii;
use frontend\models\Departamento;

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
            [['fkuser'], 'default', 'value' => null],
            [['fkuser'], 'integer'],
            [['nombuser'], 'string', 'max' => 255],
            [['fkuser'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['fkuser' => 'iduser']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iduserextens' => 'Iduserextens',
            'nombuser' => 'Nomb. Usuario extensión',
            'fkuser' => 'Fkuser',
        ];
    }

    public function getdepartamento()
    {
        $departamento = Departamento::find()->where(['fkuser'=>$this->iduserextens])->one();
        return $departamento;
    }
}
