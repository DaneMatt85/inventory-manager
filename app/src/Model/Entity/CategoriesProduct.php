<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CategoriesProduct Entity
 *
 * @property int $category_id
 * @property int $product_id
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Product $product
 */
class CategoriesProduct extends Entity
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
        'category' => true,
        'product' => true
    ];

    protected $_hidden = [
        '_joinData'
    ];

}
