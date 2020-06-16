<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ordenesdepedido Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime|null $fecha
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Ordenesdetrabajo[] $ordenesdetrabajos
 */
class Ordenesdepedido extends Entity
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
        'fecha' => true,
        'created' => true,
        'modified' => true,
        'ordenesdetrabajos' => true,
    ];
}
