<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Dish Entity
 *
 * @property int $id
 * @property string $name
 * @property string $notes
 * @property bool $type
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $deleted
 *
 * @property \App\Model\Entity\Component[] $components
 * @property \App\Model\Entity\Day $day
 */
class Dish extends Entity
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
        '*' => true,
        'id' => false
    ];
}
