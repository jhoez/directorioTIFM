<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Departamento;

/**
 * DepartamentoSearch represents the model behind the search form of `frontend\models\Departamento`.
 */
class DepartamentoSearch extends Departamento
{
    public $numextens;
    public $nombuser;
    public $ubicacion;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iddepart', 'fkuser'], 'integer'],
            [['nombdepart'], 'string', 'max' => 255],
            [['numextens'], 'string', 'max' => 255],
            [['nombuser'], 'string', 'max' => 255],
            [['ubicacion'], 'string', 'max' => 255],
            [['nombdepart'], 'safe'],
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
        $query = Departamento::find()->joinWith(['fkuser'])->joinWith(['extension']);

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
            'iddepart' => $this->iddepart,
            'fkuser' => $this->fkuser,
        ]);

        $query->andFilterWhere(['ilike', 'nombdepart', $this->nombdepart])
                ->andFilterWhere(['ilike', 'nombuser', $this->nombuser])
                ->andFilterWhere(['ilike', 'numextens', $this->numextens])
                ->andFilterWhere(['ilike', 'ubicacion', $this->ubicacion]);

        return $dataProvider;
    }
}
