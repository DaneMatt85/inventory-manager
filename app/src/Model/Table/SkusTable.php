<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Skus Model
 *
 * @property \App\Model\Table\ProductsTable|\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \App\Model\Entity\Skus get($primaryKey, $options = [])
 * @method \App\Model\Entity\Skus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Skus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Skus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Skus|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Skus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Skus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Skus findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SkusTable extends Table
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

        $this->addBehavior('Timestamp');

        $this->setTable('skus');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
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
            ->nonNegativeInteger('id')
            ->allowEmpty('id', 'create');
        
        $validator
            ->nonNegativeInteger('product_id');                 

        $validator
            ->scalar('sku')
            ->maxLength('sku', 50)
            ->notEmpty('sku')
            ->requirePresence('sku', 'create');

        $validator
            ->numeric('price')
            ->notEmpty('price')
            ->requirePresence('price', 'create');

        $validator
            ->integer('quantity')
            ->notEmpty('quantity')
            ->requirePresence('quantity', 'create');

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
        $rules->add($rules->existsIn(['product_id'], 'Products'));
        $rules->add($rules->isUnique(
            ['sku'],
            'This SKU already exists.'
        ));

        return $rules;
    }
}
