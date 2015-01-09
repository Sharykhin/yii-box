<?php

namespace app\modules\backend\modules\catalog\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\backend\modules\catalog\models\CatalogProducts;

/**
 * CatalogProductsSearch represents the model behind the search form about `app\modules\backend\modules\catalog\models\CatalogProducts`.
 */
class CatalogProductsSearch extends CatalogProducts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'category_id'], 'integer'],
            [['title', 'description', 'date_created', 'date_modified'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = CatalogProducts::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }


        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'date_modified' => $this->date_modified,
            'category_id' => $this->category_id,
        ]);
        if($this->date_created) {
            $query->orWhere('date_created <= :date_created',[':date_created'=>$this->date_created]);
        }



        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
