<div class="users view">
        <h2><?php echo __('User'); ?></h2>
        <dl>
                		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Role']['name'], array('controller' => 'roles', 'action' => 'view', $user['Role']['id'])); ?>
			&nbsp;
		</dd>
        </dl>
</div>
<div class="actions">

        <div class="btn-group">
                		<?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id']), array('class'=>'btn btn-sm btn-default')); ?>
		<?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), array('class'=>'btn btn-sm btn-danger'), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> 
        </div>
</div>
        <div class="related">
                <h3><?php echo __('Related Invitations'); ?></h3>
                <?php if (!empty($user['Invitation'])): ?>
                <table cellpadding = "0" cellspacing = "0">
                        <tr>
                                		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th><?php echo __('Is Active'); ?></th>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th><?php echo __('Gender'); ?></th>
		<th><?php echo __('Partner Id'); ?></th>
                                <th class="actions"><?php echo __('Actions'); ?></th>
                        </tr>
                        	<?php
		$i = 0;
		foreach ($user['Invitation'] as $invitation): ?>
		<tr>
			<td><?php echo $invitation['id']; ?></td>
			<td><?php echo $invitation['code']; ?></td>
			<td><?php echo $invitation['is_active']; ?></td>
			<td><?php echo $invitation['first_name']; ?></td>
			<td><?php echo $invitation['last_name']; ?></td>
			<td><?php echo $invitation['phone']; ?></td>
			<td><?php echo $invitation['gender']; ?></td>
			<td><?php echo $invitation['partner_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'invitations', 'action' => 'view', $invitation['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'invitations', 'action' => 'edit', $invitation['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'invitations', 'action' => 'delete', $invitation['id']), null, __('Are you sure you want to delete # %s?', $invitation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
                </table>
                <?php endif; ?>

        </div>
