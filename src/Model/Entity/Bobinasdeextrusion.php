<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bobinasdeextrusion Entity
 *
 * @property int $id
 * @property int $empleado_id
 * @property int $extrusora_id
 * @property \Cake\I18n\FrozenTime|null $fecha
 * @property string|null $horas
 * @property string|null $kilogramos
 * @property string|null $scrap
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Empleado $empleado
 * @property \App\Model\Entity\Extrusora $extrusora
 * @property \App\Model\Entity\Bobinascorteorigen[] $bobinascorteorigen
 * @property \App\Model\Entity\Bobinasdeimpresion[] $bobinasdeimpresions
 */
class Bobinasdeextrusion extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'empleado_id' => true,
        'extrusora_id' => true,
        'ordenesdetrabajo_id' => true,
        'bobinasdeextrusion_id' => true,
        'numero' => true,
        'fecha' => true,
        'horas' => true,
        'kilogramos' => true,
        'metros' => true,
        'observacion' => true,
        'scrap' => true,
        'terminacion' => true,
        'created' => true,
        'modified' => true,
        'empleado' => true,
        'extrusora' => true,
        'bobinascorteorigen' => true,
        'bobinasdeimpresions' => true,
    ];
}
