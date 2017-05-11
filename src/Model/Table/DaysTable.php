<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Days Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Weeks
 * @property \Cake\ORM\Association\BelongsTo $Daytimes
 * @property \Cake\ORM\Association\HasMany $Meals
 *
 * @method \App\Model\Entity\Day get($primaryKey, $options = [])
 * @method \App\Model\Entity\Day newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Day[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Day|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Day patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Day[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Day findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DaysTable extends Table
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

        $this->table('days');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Weeks', [
            'foreignKey' => 'week_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Daytimes', [
            'foreignKey' => 'daytime_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Meals', [
            'foreignKey' => 'day_id',
            'dependent' => true,
            'cascadeCallbacks' => true
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
            ->dateTime('deleted')
            ->allowEmpty('deleted');

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
        $rules->add($rules->existsIn(['week_id'], 'Weeks'));
        $rules->add($rules->existsIn(['daytime_id'], 'Daytimes'));

        return $rules;
    }
    
    public function getShoppingList($day)
    {
        $shopingList = array();

        foreach ($day->meals as $meal){
            foreach($meal->dish['components'] as $component){

                if(!isset($shopingList[$component['ingredient']->ingredients_type->name])){
                    $shopingList[$component['ingredient']->ingredients_type->name] = array();
                }
                if(!in_array($component['ingredient']['name'], $shopingList[$component['ingredient']->ingredients_type->name])){
                    array_push($shopingList[$component['ingredient']->ingredients_type->name], $component['ingredient']['name']);
                }
            }
        }
        
        return $shopingList;
    }
}
