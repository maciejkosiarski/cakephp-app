<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Weeks Model
 *
 * @property \Cake\ORM\Association\HasMany $Days
 *
 * @method \App\Model\Entity\Week get($primaryKey, $options = [])
 * @method \App\Model\Entity\Week newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Week[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Week|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Week patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Week[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Week findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WeeksTable extends Table
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

        $this->table('weeks');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Days', [
            'foreignKey' => 'week_id',
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
            ->allowEmpty('name');

        $validator
            ->dateTime('deleted')
            ->allowEmpty('deleted');

        return $validator;
    }
    
    public function isOwnedBy($weekId, $userId)
    {
        return $this->exists(['id' => $weekId, 'user_id' => $userId]);
    }
    
    public function getShoppingList($week)
    {
        $shopingList = array();
        foreach ($week->days as $day){
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
        }
        
        return $shopingList;
    }
    
    public function getThumbNames($thumbnails)
    {
        foreach($thumbnails as $key => $thumbnail){
            $info = pathinfo($thumbnail);
            $thumbnails[$key] = $info['filename'];
        }
        
        return $thumbnails;
    }
    
}
