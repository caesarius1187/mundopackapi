<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bobinasdecortes Model
 *
 * @property \App\Model\Table\EmpleadosTable&\Cake\ORM\Association\BelongsTo $Empleados
 * @property \App\Model\Table\ImpresorasTable&\Cake\ORM\Association\BelongsTo $Impresoras
 * @property \App\Model\Table\BobinascorteorigenTable&\Cake\ORM\Association\HasMany $Bobinascorteorigen
 *
 * @method \App\Model\Entity\Bobinasdecorte get($primaryKey, $options = [])
 * @method \App\Model\Entity\Bobinasdecorte newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Bobinasdecorte[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Bobinasdecorte|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bobinasdecorte saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Bobinasdecorte patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Bobinasdecorte[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Bobinasdecorte findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BobinasdecortesTable extends Table
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

        $this->setTable('bobinasdecortes');
        $this->setDisplayField('numero');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Empleados', [
            'foreignKey' => 'empleado_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Cortadoras', [
            'foreignKey' => 'cortadora_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Bobinascorteorigens', [
            'foreignKey' => 'bobinasdecorte_id',
        ]);

        $this->hasMany('ComplementariasCorte',[            
             'className'=>'Bobinasdecortes',
             'foreignKey'=>'bobinasdecorte_id'
          ]
        );

        $this->belongsTo('ParcialesCorte',[
               'className'=>'Bobinasdecortes',
               'foreignKey'=>'bobinasdecorte_id'
            ]
        );
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
