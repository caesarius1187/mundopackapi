<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ordenesdetrabajos Model
 *
 * @property \App\Model\Table\OrdenesdepedidosTable&\Cake\ORM\Association\BelongsTo $Ordenesdepedidos
 *
 * @method \App\Model\Entity\Ordenesdetrabajo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ordenesdetrabajo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Ordenesdetrabajo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ordenesdetrabajo|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ordenesdetrabajo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ordenesdetrabajo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ordenesdetrabajo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ordenesdetrabajo findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrdenesdetrabajosTable extends Table
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

        $this->setTable('ordenesdetrabajos');
        $this->setDisplayField('numero');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Ordenesdepedidos', [
            'foreignKey' => 'ordenesdepedido_id',
            'joinType' => 'INNER',
        ]);

        $this->hasMany('Ordenots', [
            'foreignKey' => 'ordenesdetrabajo_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Bobinasdeextrusions', [
            'foreignKey' => 'ordenesdetrabajo_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Bobinasdeimpresions', [
            'foreignKey' => 'ordenesdetrabajo_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Bobinasdecortes', [
            'foreignKey' => 'ordenesdetrabajo_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Materialesots', [
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
            ->integer('cantidad')
            ->allowEmptyString('cantidad');

        $validator
            ->scalar('material')
            ->maxLength('material', 150)
            ->allowEmptyString('material');

        $validator
            ->scalar('tipo')
            ->maxLength('tipo', 150)
            ->allowEmptyString('tipo');

        $validator
            ->scalar('color')
            ->maxLength('color', 150)
            ->allowEmptyString('color');

        $validator
            ->scalar('fuelle')
            ->maxLength('fuelle', 150)
            ->allowEmptyString('fuelle');

        $validator
            ->scalar('medida')
            ->maxLength('medida', 150)
            ->allowEmptyString('medida');

        $validator
            ->scalar('perf')
            ->maxLength('perf', 150)
            ->allowEmptyString('perf');

        $validator
            ->scalar('impreso')
            ->maxLength('impreso', 150)
            ->allowEmptyString('impreso');

        $validator
            ->scalar('preciounitario')
            ->maxLength('preciounitario', 150)
            ->allowEmptyString('preciounitario');

        $validator
            ->scalar('observaciones')
            ->maxLength('observaciones', 250)
            ->allowEmptyString('observaciones');

        $validator
            ->scalar('numero')
            ->maxLength('numero', 50)
            ->allowEmptyString('numero');

        $validator
            ->dateTime('cierre')
            ->allowEmptyDateTime('cierre');

        $validator
            ->scalar('cierremicrones')
            ->maxLength('cierremicrones', 50)
            ->allowEmptyString('cierremicrones');

        $validator
            ->scalar('cierrescrap')
            ->maxLength('cierrescrap', 50)
            ->allowEmptyString('cierrescrap');

        $validator
            ->scalar('cierrediferenciakg')
            ->maxLength('cierrediferenciakg', 50)
            ->allowEmptyString('cierrediferenciakg');

        $validator
            ->scalar('concluciones')
            ->maxLength('concluciones', 500)
            ->allowEmptyString('concluciones');

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
        $rules->add($rules->existsIn(['ordenesdepedido_id'], 'Ordenesdepedidos'));

        return $rules;
    }
}
