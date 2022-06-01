<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Orders;
use Yii;
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
            'created_at' => $this->created_at,
            'order_status' => $this->order_status,
            'order_quantity' => $this->order_quantity,
            'total_price' => $this->total_price,
        ]);

        // if($this->created_at){
        //     $query->andFilterWhere(['between', 'created_at', strtotime($this->created_at), strtotime($this->created_at)+86400]);
        // }

        // if ($this->startDate && $this->endDate) {
        //     $create_start = strtotime($this->startDate);
        //     $create_end   = strtotime($this->endDate);
        //     $query->andWhere(['between', 'created_at', $create_start, $create_end]);
        // }

        // if ( !is_null($this->created_at) && strpos($this->created_at, ' - ') !== false ) {
        //     list($start_date, $end_date) = explode(' - ', $this->created_at);
        //     $query->andFilterWhere(['>=', 'created_at', $start_date])
        //     ->andFilterWhere(['<', 'created_at', $end_date]);
        //     //$this->created_at = null;
        // }

        // $query->andFilterWhere(['>=', 'created_at', $this->startDate ? strtotime($this->startDate . ' 00:00:00') : null])
        // ->andFilterWhere(['<=', 'created_at', $this->endDate ? strtotime($this->endDate . ' 23:59:59') : null]);


        if($this->customer_id || $this->staff_id ){
            $query->joinWith('customer'); 
            $query->andFilterWhere(['like', 'customers.customer_name', $this->customer_id]);  

            $query->joinWith('staff'); 
            $query->andFilterWhere(['like', 'user.username', $this->staff_id]);
            
        }

        // if(!empty($this->created_at) && strpos($this->created_at, '-') !== false) {
		// 	list($start_date, $end_date) = explode(' - ', $this->created_at);
		// 	$query->andFilterWhere(['between', 'created_at', $start_date, $end_date]);
		// }	
        $query->orderBy(['created_at' => SORT_DESC]);
        
        $query->andFilterWhere(['like', 'order_id', $this->order_id])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'address_line1', $this->address_line1])
            ->andFilterWhere(['like', 'address_line2', $this->address_line2]);

        return $dataProvider;
    }

    public function searchStaffSchedule($params)
    {
        $query = Orders::find()->where(['staff_id'=>Yii::$app->user->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->joinWith('staff');

        $query->andFilterWhere(['like', 'order_id', $this->order_id])
            ->andFilterWhere(['like', 'delivery_date' ,$this->delivery_date])
            ->andFilterWhere(['like', 'order_status', $this->order_status]);

        return $dataProvider;
    }

   
}
