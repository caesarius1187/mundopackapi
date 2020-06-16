<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Empleado Entity
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $legajo
 * @property string|null $rol
 * @property string|null $direccion
 * @property string|null $celular
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Bobinasdecorte[] $bobinasdecortes
 * @property \App\Model\Entity\Bobinasdeextrusion[] $bobinasdeextrusions
 * @property \App\Model\Entity\Bobinasdeimpresion[] $bobinasdeimpresions
 */
class Empleado extends Entity
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
        'nombre' => true,
        'legajo' => true,
        'rol' => true,
        'direccion' => true,
        'celular' => true,
        'created' => true,
        'modified' => true,
        'bobinasdecortes' => true,
        'bobinasdeextrusions' => true,
        'bobinasdeimpresions' => true,
    ];
}
