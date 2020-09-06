<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ordenesdepedidos Model
 *
 * @property \App\Model\Table\OrdenesdetrabajosTable&\Cake\ORM\Association\HasMany $Ordenesdetrabajos
 *
 * @method \App\Model\Entity\Ordenesdepedido get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ordenesdepedido newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Ordenesdepedido[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ordenesdepedido|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ordenesdepedido saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ordenesdepedido patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ordenesdepedido[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ordenesdepedido findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrdenesdepedidosTable extends Table
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

        $this->setTable('ordenesdepedidos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Ordenesdetrabajos', [
            'foreignKey' => 'ordenesdepedido_id',
        ]);       
        $this->belongsTo('Clientes', [
            'foreignKey' => 'cliente_id',
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
            ->dateTime('fecha')
            ->allowEmptyDateTime('fecha');

        return $validator;
    }
}
