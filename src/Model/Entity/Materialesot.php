<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Materialesot Entity
 *
 * @property int $id
 * @property int $ordenesdetrabajo_id
 * @property string $material
 * @property float $porcentaje
 *
 * @property \App\Model\Entity\Ordenesdetrabajo $ordenesdetrabajo
 */
class Materialesot extends Entity
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
        'ordenesdetrabajo_id' => true,
        'material' => true,
        'porcentaje' => true,
        'ordenesdetrabajo' => true,
    ];
}
