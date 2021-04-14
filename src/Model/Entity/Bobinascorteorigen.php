<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bobinascorteorigen Entity
 *
 * @property int $id
 * @property int|null $bobinasdeimpresion_id
 * @property int|null $bobinasdecorte_id
 * @property int|null $bobinasdeextrusion_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Bobinasdeimpresion $bobinasdeimpresion
 * @property \App\Model\Entity\Bobinasdecorte $bobinasdecorte
 * @property \App\Model\Entity\Bobinasdeextrusion $bobinasdeextrusion
 */
class Bobinascorteorigen extends Entity
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
        'bobinasdeimpresion_id' => true,
        'bobinasdecorte_id' => true,
        'bobinasdeextrusion_id' => true,
        'terminacion' => true,
        'created' => true,
        'modified' => true,
        'bobinasdeimpresion' => true,
        'bobinasdecorte' => true,
        'bobinasdeextrusion' => true,
    ];
}
