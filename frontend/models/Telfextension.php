<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "dirtelf.telfextension".
 *
 * @property int $idtelfext
 * @property string|null $numextens
 * @property int|null $fkdepart
 * @property bool|null $ubicacion
 */
class Telfextension extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dirtelf.telfextension';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fkdepart'], 'default', 'value' => null],
            [['fkdepart'], 'integer'],
            [['numextens','ubicacion'], 'string', 'max' => 255],
            [['fkdepart'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::className(), 'targetAttribute' => ['fkdepart' => 'iddepart']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtelfext' => 'Idtelfext',
            'numextens' => 'Numextens',
            'fkdepart' => 'Fkdepart',
            'ubicacion' => 'Ubicación',
        ];
    }

    public function getdepart()
    {
        $departamento = Departamento::find()->where(['iddepart'=>$this->fkdepart])-one();
        return $departamento;
    }
}
