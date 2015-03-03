<div id="attachment-selection-id-<?php echo $attachment['Attachment']['id']; ?>" class="attachment-thumb ">
    <div class="attachment-data" >
        <input class="attchment-input-id" name="[Attachment][id]" type="hidden" value="<?php echo $attachment['Attachment']['id']; ?>">
        <script class="attachment-data-json" type="text/x-3xw-json">
<?php echo json_encode($attachment['Attachment']); ?>
        </script>
    </div>
    <div class="attachment-image">
        <?php
        switch ($attachment['Attachment']['subtype']) {
            case 'jpg':
            case 'jpeg':
            case 'gif':
            case 'png':
            case 'vimeo':
            case 'youtube':
                echo $this->Image->image(
                        array(
                    'image' => $attachment['Attachment']['path'],
                    'width' => 677,
                    'cropratio' => '16:9'
                        ), array(
                    'class' => 'img-rounded img-responsive'
                        )
                );
                break;

            default:
                echo $this->Html->image('http://placehold.it/677x381&text=' . $attachment['Attachment']['type'] . '/' . $attachment['Attachment']['subtype'], array(
                    'class' => 'img-rounded img-responsive'
                    )
                );
                break;
                break;
        }
        ?>
    </div>

    <div class="attachment-info">
        <div class="attachment-title">
            <?php echo $attachment['Attachment']['name']; ?>
        </div>
        <div class="attachment-details">
            <?php
            echo $attachment['Attachment']['size'] . ' KB - ' . $attachment['Attachment']['type'] . '/' . $attachment['Attachment']['subtype'];
            ?>
            <br/>
            <?php echo $attachment['Attachment']['date']; ?>
        </div>
    </div>
    <div class="attachment-actions">
        <?php echo $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>', array('action' => 'edit', $attachment['Attachment']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>
        <?php echo ( $attachment['Attachment']['type'] != 'embed' ) ? $this->Html->link('<span class="glyphicon glyphicon-arrow-down"></span>', array('action' => 'download', $attachment['Attachment']['id']), array('class' => 'btn btn-primary', 'escape' => false)) : ''; ?>
        <?php echo $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span>', array('action' => 'delete', $attachment['Attachment']['id']), array('class' => 'btn btn-danger', 'escape' => false), __('Are you sure you want to delete the Attachment: %s?', $attachment['Attachment']['name'])); ?>
    </div>
</div>