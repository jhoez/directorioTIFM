<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "dirtelf.departamento".
 *
 * @property int $iddepart
 * @property string|null $nombdepart
 * @property int|null $fkuser
 */
class Departamento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dirtelf.departamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fkuser'], 'default', 'value' => null],
            [['fkuser'], 'integer'],
            [['nombdepart'], 'string', 'max' => 255],
            [['fkuser'], 'exist', 'skipOnError' => true, 'targetClass' => Userextens::className(), 'targetAttribute' => ['fkuser' => 'iduserextens']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iddepart' => 'Iddepart',
            'nombdepart' => 'Nomb. departamento',
            'fkuser' => 'Fkuser',
        ];
    }

    public function getuser()
    {
        $usuario = Userextens::find()->where(['iduserextens'=>$this->fkuser])-one();
        return $usuario;
    }

    public function getfkuser()
    {
        return $this->hasOne(Userextens::className(),['iduserextens'=>'fkuser']);
    }

    public function getextension()
    {
        return $this->hasOne(Telfextension::className(),['fkdepart'=>'iddepart']);
    }
}
