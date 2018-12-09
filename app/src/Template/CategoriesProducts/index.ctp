<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CategoriesProduct[]|\Cake\Collection\CollectionInterface $categoriesProducts
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Categories Product'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="categoriesProducts index large-9 medium-8 columns content">
    <h3><?= __('Categories Products') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categoriesProducts as $categoriesProduct): ?>
            <tr>
                <td><?= $categoriesProduct->has('category') ? $this->Html->link($categoriesProduct->category->name, ['controller' => 'Categories', 'action' => 'view', $categoriesProduct->category->id]) : '' ?></td>
                <td><?= $categoriesProduct->has('product') ? $this->Html->link($categoriesProduct->product->name, ['controller' => 'Products', 'action' => 'view', $categoriesProduct->product->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $categoriesProduct->category_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $categoriesProduct->category_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $categoriesProduct->category_id], ['confirm' => __('Are you sure you want to delete # {0}?', $categoriesProduct->category_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
