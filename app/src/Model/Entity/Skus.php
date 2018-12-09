<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Skus Entity
 *
 * @property int $id
 * @property int $product_id
 * @property string|null $sku
 * @property float|null $price
 * @property int|null $quantity
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Product $product
 */
class Skus extends Entity
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
        'product_id' => true,
        'sku' => true,
        'price' => true,
        'quantity' => true,
        'created' => true,
        'modified' => true,
        'product' => true
    ];

    protected $_hidden = [
        '_joinData',
        'user_id',
        
    ];
}
