<div class="pitches index">
        <h2><?php echo __('Pitches'); ?> <?php echo $this->Html->link(\__('+'), array('action' => 'add'), array('class'=>'btn btn-success btn-sm')); ?></h2>
        <table cellpadding="0" cellspacing="0" class="table">
                <tr>
                                                        <th><?php echo $this->Paginator->sort('id'); ?></th>
                                                        <th><?php echo $this->Paginator->sort('title'); ?></th>
                                                        <th><?php echo $this->Paginator->sort('description'); ?></th>
                                                        <th><?php echo $this->Paginator->sort('start'); ?></th>
                                                        <th><?php echo $this->Paginator->sort('end'); ?></th>
                                                        <th><?php echo $this->Paginator->sort('max_user'); ?></th>
                                                <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
                <?php foreach ($pitches as $pitch): ?>
	<tr>
		<td><?php echo h($pitch['Pitch']['id']); ?>&nbsp;</td>
		<td><?php echo h($pitch['Pitch']['title']); ?>&nbsp;</td>
		<td><?php echo h($pitch['Pitch']['description']); ?>&nbsp;</td>
		<td><?php echo h($pitch['Pitch']['start']); ?>&nbsp;</td>
		<td><?php echo h($pitch['Pitch']['end']); ?>&nbsp;</td>
		<td><?php echo h($pitch['Pitch']['max_user']); ?>&nbsp;</td>
		<td class="actions">
		<div class="btn-group">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $pitch['Pitch']['id']), array('class'=>'btn btn-default btn-xs')); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $pitch['Pitch']['id']), array('class'=>'btn btn-default btn-xs')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $pitch['Pitch']['id']), array('class'=>'btn btn-danger btn-xs'), __('Are you sure you want to delete # %s?', $pitch['Pitch']['id'])); ?>
		</div>
		</td>
	</tr>
<?php endforeach; ?>
        </table>
        <div class="well well-sm">
                <?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>
        </div>
        <ul class="pagination">
                <?php echo '<li>'.$this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled')).'</li>' ?>
                <?php echo '<li>'.$this->Paginator->numbers(array('separator' => '')).'</li>' ?>
                <?php echo '<li>'.$this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled')).'</li>' ?>
        </ul>
</div>
