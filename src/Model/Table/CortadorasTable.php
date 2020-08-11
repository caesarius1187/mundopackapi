<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cortadoras Model
 *
 * @property \App\Model\Table\BobinasdeimpresionsTable&\Cake\ORM\Association\HasMany $Bobinasdeimpresions
 *
 * @method \App\Model\Entity\Cortadora get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cortadora newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Cortadora[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cortadora|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cortadora saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cortadora patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cortadora[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cortadora findOrCreate($search, callable $callback = null, $options = [])
 */
class CortadorasTable extends Table
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

        $this->setTable('cortadoras');
        $this->setDisplayField('nombre');
        $this->setPrimaryKey('id');

        $this->hasMany('Bobinasdecortes', [
            'foreignKey' => 'cortadora_id',
        ]);

        $this->hasMany('Ordenots', [
            'foreignKey' => 'cortadora_id',
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
