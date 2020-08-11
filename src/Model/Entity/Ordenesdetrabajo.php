<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ordenesdetrabajo Entity
 *
 * @property int $id
 * @property int $ordenesdepedido_id
 * @property int|null $cantidad
 * @property string|null $material
 * @property string|null $tipo
 * @property string|null $color
 * @property string|null $fuelle
 * @property string|null $medida
 * @property string|null $perf
 * @property string|null $impreso
 * @property string|null $preciounitario
 * @property string|null $observaciones
 * @property string|null $numero
 * @property \Cake\I18n\FrozenTime|null $cierre
 * @property string|null $cierremicrones
 * @property string|null $cierrescrap
 * @property string|null $cierrediferenciakg
 * @property string|null $concluciones
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Ordenesdepedido $ordenesdepedido
 */
class Ordenesdetrabajo extends Entity
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
        'ordenesdepedido_id' => true,
        'numero' => true,
        'cantidad' => true,
        'aextrusar' => true,
        'impreso' => true,
        'impresas' => true,
        'cortado' => true,
        'cortadas' => true,
        'material' => true,
        'tipo' => true,
        'color' => true,
        'fuelle' => true,
        'medida' => true,
        'perf' => true,
        'preciounitario' => true,
        'observaciones' => true,
        'cierre' => true,
        'cierremicrones' => true,
        'cierrescrap' => true,
        'cierrediferenciakg' => true,
        'concluciones' => true,
        'created' => true,
        'modified' => true,
    ];
}
