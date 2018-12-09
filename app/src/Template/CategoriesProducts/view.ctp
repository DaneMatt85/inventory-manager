<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CategoriesProduct $categoriesProduct
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Categories Product'), ['action' => 'edit', $categoriesProduct->category_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Categories Product'), ['action' => 'delete', $categoriesProduct->category_id], ['confirm' => __('Are you sure you want to delete # {0}?', $categoriesProduct->category_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Categories Products'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Categories Product'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="categoriesProducts view large-9 medium-8 columns content">
    <h3><?= h($categoriesProduct->category_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= $categoriesProduct->has('category') ? $this->Html->link($categoriesProduct->category->name, ['controller' => 'Categories', 'action' => 'view', $categoriesProduct->category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product') ?></th>
            <td><?= $categoriesProduct->has('product') ? $this->Html->link($categoriesProduct->product->name, ['controller' => 'Products', 'action' => 'view', $categoriesProduct->product->id]) : '' ?></td>
        </tr>
    </table>
</div>
