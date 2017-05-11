<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Components Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Dishes
 * @property \Cake\ORM\Association\BelongsTo $Ingredients
 *
 * @method \App\Model\Entity\Component get($primaryKey, $options = [])
 * @method \App\Model\Entity\Component newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Component[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Component|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Component patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Component[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Component findOrCreate($search, callable $callback = null)
 */
class ComponentsTable extends Table
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

        $this->table('components');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Dishes', [
            'foreignKey' => 'dish_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Ingredients', [
            'foreignKey' => 'ingredient_id',
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
        $rules->add($rules->existsIn(['ingredient_id'], 'Ingredients'));

        return $rules;
    }
}
