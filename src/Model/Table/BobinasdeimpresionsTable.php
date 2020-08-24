<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bobinasdeimpresions Model
 *
 * @property \App\Model\Table\EmpleadosTable&\Cake\ORM\Association\BelongsTo $Empleados
 * @property \App\Model\Table\CortadorasTable&\Cake\ORM\Association\BelongsTo $Cortadoras
 * @property \App\Model\Table\BobinasdeextrusionsTable&\Cake\ORM\Association\BelongsTo $Bobinasdeextrusions
 * @property \App\Model\Table\BobinascorteorigenTable&\Cake\ORM\Association\HasMany $Bobinascorteorigen
 *
 * @method \App\Model\Entity\Bobinasdeimpresion get($primaryKey, $options = [])
 * @method \App\Model\Entity\Bobinasdeimpresion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Bobinasdeimpresion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bobinasdeimpresion|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bobinasdeimpresion saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bobinasdeimpresion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Bobinasdeimpresion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bobinasdeimpresion findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BobinasdeimpresionsTable extends Table
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

        $this->setTable('bobinasdeimpresions');
        $this->setDisplayField('numero');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Empleados', [
            'foreignKey' => 'empleado_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Impresoras', [
            'foreignKey' => 'impresora_id',
            'joinType' => 'INNER',
        ]); 
        $this->belongsTo('Bobinasdeextrusions', [
            'foreignKey' => 'bobinasdeextrusion_id',
            'joinType' => 'INNER',
        ]);        
        $this->hasMany('Bobinascorteorigens', [
            'foreignKey' => 'bobinascorteorigen_id',
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
        return $rules;
    }
}
