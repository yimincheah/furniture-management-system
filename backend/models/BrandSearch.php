<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Brands;

/**
 * BrandSearch represents the model behind the search form of `backend\models\Brands`.
 */
class BrandSearch extends Brands
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['brand_id'], 'integer'],
            [['brand_name', 'brand_status', 'created_at', 'updated_at'], 'safe'],
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
        $query = Brands::find();

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
       
        if( $this->created_at ){
            $query->andFilterWhere(['between', 'created_at', strtotime($this->created_at), strtotime($this->created_at)+86400]);
        }

        if( $this->updated_at ){
            $query->andFilterWhere(['between', 'updated_at', strtotime($this->updated_at), strtotime($this->updated_at)+86400]);
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'brand_id' => $this->brand_id,
            'brand_status' => $this->brand_status,
        ]);

        $query->andFilterWhere(['like', 'brand_name', $this->brand_name]);

        return $dataProvider;
    }
}
