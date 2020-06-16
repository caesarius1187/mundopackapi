<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bobinascorteorigens Model
 *
 * @property \App\Model\Table\BobinasdeimpresionsTable&\Cake\ORM\Association\BelongsTo $Bobinasdeimpresions
 * @property \App\Model\Table\BobinasdecortesTable&\Cake\ORM\Association\BelongsTo $Bobinasdecortes
 * @property \App\Model\Table\BobinasdeextrusionsTable&\Cake\ORM\Association\BelongsTo $Bobinasdeextrusions
 *
 * @method \App\Model\Entity\Bobinascorteorigen get($primaryKey, $options = [])
 * @method \App\Model\Entity\Bobinascorteorigen newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Bobinascorteorigen[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bobinascorteorigen|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bobinascorteorigen saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bobinascorteorigen patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Bobinascorteorigen[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bobinascorteorigen findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BobinascorteorigensTable extends Table
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

        $this->setTable('bobinascorteorigens');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Bobinasdeimpresions', [
            'foreignKey' => 'bobinasdeimpresion_id',
        ]);
        $this->belongsTo('Bobinasdecortes', [
            'foreignKey' => 'bobinasdecorte_id',
        ]);
        $this->belongsTo('Bobinasdeextrusions', [
            'foreignKey' => 'bobinasdeextrusion_id',
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
        $rules->add($rules->existsIn(['bobinasdeimpresion_id'], 'Bobinasdeimpresions'));
        $rules->add($rules->existsIn(['bobinasdecorte_id'], 'Bobinasdecortes'));
        $rules->add($rules->existsIn(['bobinasdeextrusion_id'], 'Bobinasdeextrusions'));

        return $rules;
    }
}
