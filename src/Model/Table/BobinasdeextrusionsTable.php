<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bobinasdeextrusions Model
 *
 * @property \App\Model\Table\EmpleadosTable&\Cake\ORM\Association\BelongsTo $Empleados
 * @property \App\Model\Table\ExtrusorasTable&\Cake\ORM\Association\BelongsTo $Extrusoras
 * @property \App\Model\Table\BobinascorteorigenTable&\Cake\ORM\Association\HasMany $Bobinascorteorigen
 * @property \App\Model\Table\BobinasdeimpresionsTable&\Cake\ORM\Association\HasMany $Bobinasdeimpresions
 *
 * @method \App\Model\Entity\Bobinasdeextrusion get($primaryKey, $options = [])
 * @method \App\Model\Entity\Bobinasdeextrusion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Bobinasdeextrusion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bobinasdeextrusion|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bobinasdeextrusion saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bobinasdeextrusion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Bobinasdeextrusion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bobinasdeextrusion findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BobinasdeextrusionsTable extends Table
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

        $this->setTable('bobinasdeextrusions');
        $this->setDisplayField('numero');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Empleados', [
            'foreignKey' => 'empleado_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Extrusoras', [
            'foreignKey' => 'extrusora_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Bobinascorteorigens', [
            'foreignKey' => 'bobinascorteorigen_id',
        ]);
        $this->hasMany('Bobinasdeimpresions', [
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

        $validator
            ->dateTime('fecha')
            ->allowEmptyDateTime('fecha');

        $validator
            ->scalar('horas')
            ->maxLength('horas', 50)
            ->allowEmptyString('horas');

        $validator
            ->scalar('kilogramos')
            ->maxLength('kilogramos', 50)
            ->allowEmptyString('kilogramos');

        $validator
            ->scalar('scrap')
            ->maxLength('scrap', 50)
            ->allowEmptyString('scrap');

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
        $rules->add($rules->existsIn(['empleado_id'], 'Empleados'));
        $rules->add($rules->existsIn(['extrusora_id'], 'Extrusoras'));

        return $rules;
    }
}
