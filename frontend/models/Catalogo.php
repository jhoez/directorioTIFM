<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "dirtelf.catalogo".
 *
 * @property int $idcata
 * @property int|null $idpadre
 * @property string|null $nombcata
 */
class Catalogo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dirtelf.catalogo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpadre'], 'default', 'value' => null],
            [['idpadre'], 'integer'],
            [['nombcata'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcata' => 'Idcata',
            'idpadre' => 'Idpadre',
            'nombcata' => 'Nombcata',
        ];
    }
}
