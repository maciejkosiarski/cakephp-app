<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Meals Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Dishes
 * @property \Cake\ORM\Association\BelongsTo $Days
 *
 * @method \App\Model\Entity\Meal get($primaryKey, $options = [])
 * @method \App\Model\Entity\Meal newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Meal[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Meal|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Meal patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Meal[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Meal findOrCreate($search, callable $callback = null)
 */
class MealsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('meals');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Dishes', [
            'foreignKey' => 'dish_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Days', [
            'foreignKey' => 'day_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MealsTypes', [
            'foreignKey' => 'type',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('type')
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['dish_id'], 'Dishes'));
        $rules->add($rules->existsIn(['day_id'], 'Days'));

        return $rules;
    }
    
    /**
     * Returns a parse date ready to multiple insert
     * 
     * @param $dayId int
     * @param $dishes array
     * @return $mealsData array
     */
    public function parseData($dayId, $dishes){
        $mealsData = array();
        $i = 1;
        foreach ($dishes as $dish){
            $data['day_id'] = $dayId;
            $data['dish_id'] = $dish;
            $data['type'] = $i;
            array_push($mealsData, $data); 
            $i += 1;
                      
        }
        return $mealsData;
    }
    
    public function isOwnedDay($dayId, $userId)
    {
        $day = $this->Days->find()->select(['week_id'])->where(['id' => $dayId])->first();
        return $this->Days->Weeks->exists(['id' => $day->week_id, 'user_id' => $userId]);
    }
    
    public function isOwnedMeal($mealId, $userId)
    {
        $meal = $this->find()->select(['day_id'])->where(['id' => $mealId])->first();
        $day = $this->Days->find()->select(['week_id'])->where(['id' => $meal->day_id])->first();
        return $this->Days->Weeks->exists(['id' => $day->week_id, 'user_id' => $userId]);
    }
}
