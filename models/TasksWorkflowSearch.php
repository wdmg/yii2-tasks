<?php

namespace wdmg\tasks\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use wdmg\tasks\models\TasksWorkflow;

/**
 * TasksWorkflowSearch represents the model behind the search form of `wdmg\tasks\models\TasksWorkflow`.
 */
class TasksWorkflowSearch extends TasksWorkflow
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'task_id', 'owner_id', 'assigned_id', 'status'], 'integer'],
            [['description', 'deadline_at', 'started_at', 'completed_at', 'created_at', 'updated_at'], 'safe'],
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
        $query = TasksWorkflow::find();

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
            'id' => $this->id,
            'task_id' => $this->task_id,
            'owner_id' => $this->owner_id,
            'assigned_id' => $this->assigned_id,
            'deadline_at' => $this->deadline_at,
            'started_at' => $this->started_at,
            'completed_at' => $this->completed_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
