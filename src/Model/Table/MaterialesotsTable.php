<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Materialesots Model
 *
 * @property \App\Model\Table\OrdenesdetrabajosTable&\Cake\ORM\Association\BelongsTo $Ordenesdetrabajos
 *
 * @method \App\Model\Entity\Materialesot get($primaryKey, $options = [])
 * @method \App\Model\Entity\Materialesot newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Materialesot[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Materialesot|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Materialesot saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Materialesot patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Materialesot[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Materialesot findOrCreate($search, callable $callback = null, $options = [])
 */
class MaterialesotsTable extends Table
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

        $this->setTable('materialesots');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Ordenesdetrabajos', [
            'foreignKey' => 'ordenesdetrabajo_id',
            'joinType' => 'INNER',
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
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('material')
            ->maxLength('material', 50)
            ->notEmptyString('material');

        $validator
            ->numeric('porcentaje')
            ->notEmptyString('porcentaje');

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
        $rules->add($rules->existsIn(['ordenesdetrabajo_id'], 'Ordenesdetrabajos'));

        return $rules;
    }
}
