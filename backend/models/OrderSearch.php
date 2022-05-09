<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Orders;

/**
 * OrderSearch represents the model behind the search form of `backend\models\Orders`.
 */
class OrderSearch extends Orders
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'post_code', 'order_quantity'], 'integer'],
            [['order_id', 'country', 'state', 'city', 'address_line1', 'address_line2', 'delivery_date', 'customer_id', 'staff_id', 'order_status', 'created_at'], 'safe'],
            [['total_price'], 'number'],
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
        $query = Orders::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'post_code' => $this->post_code,
            'delivery_date' => $this->delivery_date,
            'order_status' => $this->order_status,
            'order_quantity' => $this->order_quantity,
            'total_price' => $this->total_price,
        ]);

        if($this->created_at){
            $query->andFilterWhere(['between', 'created_at', strtotime($this->created_at), strtotime($this->created_at)+86400]);
        }
   
        else if($this->customer_id || $this->staff_id ){
            $query->joinWith('customer'); 
            $query->andFilterWhere(['like', 'customers.customer_name', $this->customer_id]);  

            $query->joinWith('staff'); 
            $query->andFilterWhere(['like', 'user.username', $this->staff_id]);
            
        }
      
        $query->orderBy(['created_at' => SORT_DESC]);
        
        $query->andFilterWhere(['like', 'order_id', $this->order_id])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'address_line1', $this->address_line1])
            ->andFilterWhere(['like', 'address_line2', $this->address_line2]);

        return $dataProvider;
    }
}
