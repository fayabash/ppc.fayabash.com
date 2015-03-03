<div class="pitches view">
        <h2><?php echo __('Pitch'); ?></h2>
        <dl>
                		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($pitch['Pitch']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($pitch['Pitch']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($pitch['Pitch']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start'); ?></dt>
		<dd>
			<?php echo h($pitch['Pitch']['start']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End'); ?></dt>
		<dd>
			<?php echo h($pitch['Pitch']['end']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Max User'); ?></dt>
		<dd>
			<?php echo h($pitch['Pitch']['max_user']); ?>
			&nbsp;
		</dd>
        </dl>
</div>
<div class="actions">

        <div class="btn-group">
                		<?php echo $this->Html->link(__('Edit Pitch'), array('action' => 'edit', $pitch['Pitch']['id']), array('class'=>'btn btn-sm btn-default')); ?>
		<?php echo $this->Form->postLink(__('Delete Pitch'), array('action' => 'delete', $pitch['Pitch']['id']), array('class'=>'btn btn-sm btn-danger'), __('Are you sure you want to delete # %s?', $pitch['Pitch']['id'])); ?> 
        </div>
</div>
        <div class="related">
                <h3><?php echo __('Related Users'); ?></h3>
                <?php if (!empty($pitch['User'])): ?>
                <table cellpadding = "0" cellspacing = "0">
                        <tr>
                                		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Role Id'); ?></th>
		<th><?php echo __('Score'); ?></th>
		<th><?php echo __('Username'); ?></th>
                                <th class="actions"><?php echo __('Actions'); ?></th>
                        </tr>
                        	<?php
		$i = 0;
		foreach ($pitch['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['email']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['role_id']; ?></td>
			<td><?php echo $user['score']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
                </table>
                <?php endif; ?>

        </div>
