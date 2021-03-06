<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Graphic Entity
 *
 * @property int $id
 * @property int $release_id
 * @property string $title
 * @property string $url
 * @property string $image
 * @property string $dir
 * @property int $weight
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Release $release
 */
class Graphic extends Entity
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
        'release_id' => true,
        'title' => true,
        'url' => true,
        'image' => true,
        'dir' => true,
        'weight' => true,
        'created' => true,
        'modified' => true,
        'release' => true
    ];
}
