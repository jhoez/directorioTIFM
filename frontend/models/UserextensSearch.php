<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Userextens;

/**
 * UsuarioSearch represents the model behind the search form of `frontend\models\Usuario`.
 */
class UserextensSearch extends Userextens
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iduserextens'], 'integer'],
            [['nombuser'], 'string', 'max' => 255],
            [['nombuser'], 'safe'],
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
        $query = Userextens::find();

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
            'iduserextens' => $this->iduserextens,
        ]);

        $query->andFilterWhere(['ilike', 'nombuser', $this->nombuser]);

        return $dataProvider;
    }
}
