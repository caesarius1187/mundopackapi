<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Empleados Model
 *
 * @property \App\Model\Table\BobinasdecortesTable&\Cake\ORM\Association\HasMany $Bobinasdecortes
 * @property \App\Model\Table\BobinasdeextrusionsTable&\Cake\ORM\Association\HasMany $Bobinasdeextrusions
 * @property \App\Model\Table\BobinasdeimpresionsTable&\Cake\ORM\Association\HasMany $Bobinasdeimpresions
 *
 * @method \App\Model\Entity\Empleado get($primaryKey, $options = [])
 * @method \App\Model\Entity\Empleado newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Empleado[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Empleado|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Empleado saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Empleado patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Empleado[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Empleado findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmpleadosTable extends Table
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

        $this->setTable('empleados');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Bobinasdecortes', [
            'foreignKey' => 'empleado_id',
        ]);
        $this->hasMany('Bobinasdeextrusions', [
            'foreignKey' => 'empleado_id',
        ]);
        $this->hasMany('Bobinasdeimpresions', [
            'foreignKey' => 'empleado_id',
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
            ->scalar('nombre')
            ->maxLength('nombre', 150)
            ->allowEmptyString('nombre');

        $validator
            ->scalar('legajo')
            ->maxLength('legajo', 150)
            ->allowEmptyString('legajo');

        $validator
            ->scalar('rol')
            ->maxLength('rol', 150)
            ->allowEmptyString('rol');

        $validator
            ->scalar('direccion')
            ->maxLength('direccion', 150)
            ->allowEmptyString('direccion');

        $validator
            ->scalar('celular')
            ->maxLength('celular', 150)
            ->allowEmptyString('celular');

        return $validator;
    }
}
