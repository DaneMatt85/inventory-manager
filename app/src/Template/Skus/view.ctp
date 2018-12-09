<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Skus $skus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Skus'), ['action' => 'edit', $skus->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Skus'), ['action' => 'delete', $skus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $skus->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Skus'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Skus'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="skus view large-9 medium-8 columns content">
    <h3><?= h($skus->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Product') ?></th>
            <td><?= $skus->has('product') ? $this->Html->link($skus->product->name, ['controller' => 'Products', 'action' => 'view', $skus->product->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sku') ?></th>
            <td><?= h($skus->sku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($skus->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($skus->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($skus->quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($skus->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($skus->modified) ?></td>
        </tr>
    </table>
</div>
