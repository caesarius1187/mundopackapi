<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Impresoras Model
 *
 * @property \App\Model\Table\BobinasdecortesTable&\Cake\ORM\Association\HasMany $Bobinasdecortes
 *
 * @method \App\Model\Entity\Impresora get($primaryKey, $options = [])
 * @method \App\Model\Entity\Impresora newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Impresora[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Impresora|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Impresora saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Impresora patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Impresora[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Impresora findOrCreate($search, callable $callback = null, $options = [])
 */
class ImpresorasTable extends Table
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

        $this->setTable('impresoras');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Bobinasdeimpresions', [
            'foreignKey' => 'impresora_id',
        ]);

        $this->hasMany('Ordenots', [
            'foreignKey' => 'impresora_id',
            'order' => 'Ordenots.prioridad',
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
            ->maxLength('nombre', 50)
            ->notEmptyString('nombre');

        return $validator;
    }
}
