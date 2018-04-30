<h1>Edit: <?php echo $article->title; ?></h1>
<?php
    echo $this->Form->create($article);
    echo $this->Form->control('id', ['type'=>'hidden']);
    echo $this->Form->control('title');
    echo $this->Form->control('body', ['rows'=>5]);
    echo $this->Form->button('Update Activity');
    echo $this->Form->end();
