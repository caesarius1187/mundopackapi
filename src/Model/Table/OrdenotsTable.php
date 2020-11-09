<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ordenots Model
 *
 * @property \App\Model\Table\ExtrusorasTable&\Cake\ORM\Association\BelongsTo $Extrusoras
 * @property \App\Model\Table\ImpresorasTable&\Cake\ORM\Association\BelongsTo $Impresoras
 * @property \App\Model\Table\CortadorasTable&\Cake\ORM\Association\BelongsTo $Cortadoras
 * @property \App\Model\Table\OrdenesdetrabajosTable&\Cake\ORM\Association\BelongsTo $Ordenesdetrabajos
 *
 * @method \App\Model\Entity\Ordenot get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ordenot newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Ordenot[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ordenot|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ordenot saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ordenot patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ordenot[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ordenot findOrCreate($search, callable $callback = null, $options = [])
 */
class OrdenotsTable extends Table
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

        $this->setTable('ordenots');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Extrusoras', [
            'foreignKey' => 'extrusora_id',
        ]);
        $this->belongsTo('Impresoras', [
            'foreignKey' => 'impresora_id',
        ]);
        $this->belongsTo('Cortadoras', [
            'foreignKey' => 'cortadora_id',
        ]);
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
            ->integer('prioridadpendientes')
            ->allowEmptyString('prioridadpendientes');

        $validator
            ->integer('prioridadextrusion')
            ->allowEmptyString('prioridadextrusion');

        $validator
            ->integer('prioridadimpresion')
            ->allowEmptyString('prioridadimpresion');

        $validator
            ->integer('prioridadcorte')
            ->allowEmptyString('prioridadcorte');

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
