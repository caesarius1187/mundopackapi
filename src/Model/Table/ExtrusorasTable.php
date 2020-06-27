<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Extrusoras Model
 *
 * @property \App\Model\Table\BobinasdeextrusionsTable&\Cake\ORM\Association\HasMany $Bobinasdeextrusions
 *
 * @method \App\Model\Entity\Extrusora get($primaryKey, $options = [])
 * @method \App\Model\Entity\Extrusora newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Extrusora[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Extrusora|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Extrusora saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Extrusora patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Extrusora[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Extrusora findOrCreate($search, callable $callback = null, $options = [])
 */
class ExtrusorasTable extends Table
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

        $this->setTable('extrusoras');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Bobinasdeextrusions', [
            'foreignKey' => 'extrusora_id',
        ]);
        
        $this->hasMany('Ordenots', [
            'foreignKey' => 'cortadora_id',
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
