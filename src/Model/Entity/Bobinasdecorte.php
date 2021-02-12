<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bobinasdecorte Entity
 *
 * @property int $id
 * @property int $empleado_id
 * @property int $impresora_id
 * @property \Cake\I18n\FrozenTime|null $fecha
 * @property string|null $horas
 * @property string|null $kilogramos
 * @property string|null $scrap
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Empleado $empleado
 * @property \App\Model\Entity\Impresora $impresora
 * @property \App\Model\Entity\Bobinascorteorigen[] $bobinascorteorigen
 */
class Bobinasdecorte extends Entity
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
        'cortadora_id' => true,
        'ordenesdetrabajo_id' => true,
        'bobinasdecorte_id' => true,
        'terminacion' => true,
        'numero' => true,
        'fecha' => true,
        'horas' => true,
        'kilogramos' => true,
        'metros' => true,
        'scrap' => true,
        'scrapsacabocado' => true,
        'cantidad' => true,
        'observacion' => true,
        'created' => true,
        'modified' => true,
        'empleado' => true,
        'impresora' => true,
        'bobinascorteorigen' => true,
    ];
}
