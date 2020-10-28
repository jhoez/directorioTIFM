<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Telfextension;

/**
 * TelfextensionSearch represents the model behind the search form of `frontend\models\Telfextension`.
 */
class TelfextensionSearch extends Telfextension
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtelfext', 'fkdepart'], 'integer'],
            [['numextens'], 'safe'],
            [['numextens','ubicacion'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Telfextension::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idtelfext' => $this->idtelfext,
            'fkdepart' => $this->fkdepart,
        ]);

        $query->andFilterWhere(['ilike', 'numextens', $this->numextens])
                ->andFilterWhere(['ilike', 'ubicacion', $this->ubicacion]);

        return $dataProvider;
    }
}
