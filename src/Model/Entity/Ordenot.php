<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ordenot Entity
 *
 * @property int $id
 * @property int $extrusora_id
 * @property int $impresora_id
 * @property int $cortadora_id
 * @property int $ordenesdetrabajo_id
 *
 * @property \App\Model\Entity\Extrusora $extrusora
 * @property \App\Model\Entity\Impresora $impresora
 * @property \App\Model\Entity\Cortadora $cortadora
 * @property \App\Model\Entity\Ordenesdetrabajo $ordenesdetrabajo
 */
class Ordenot extends Entity
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
        'extrusora_id' => true,
        'impresora_id' => true,
        'cortadora_id' => true,
        'ordenesdetrabajo_id' => true,
        'extrusora' => true,
        'impresora' => true,
        'cortadora' => true,
        'ordenesdetrabajo' => true,
    ];
}
