<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Skus[] $skus
 * @property \App\Model\Entity\Category[] $categories
 */
class Product extends Entity
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
        'user_id' => true,
        'name' => true,
        'user' => true,
        'skus' => true,
        'categories' => true
    ];

    protected $_hidden = [
        '_joinData',
        'user_id'
    ];

}
