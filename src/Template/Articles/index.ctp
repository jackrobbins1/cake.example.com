<h1>Articles</h1>
<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Created</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($articles as $article): ?>
            <tr>
                <td><?php echo $this->Html->link(
                    $article->title,
                        [
                            'action'=>'view',
                            $article->slug
                        ]
                        );
                    ?>
                </td>
                <td><?php echo $article->created; ?></td>
                <td>
                <?php echo $this->Html->link(
                    'Edit',
                        [
                            'action'=>'edit',
                            $article->id
                        ]
                    );
                    echo '&nbsp; | &nbsp;';
                    echo $this->Form->postLink(
                        'Delete', ['action'=>'delete', $article->id],
                        ['confirm'=>__('Are you sure you want to delete {0}', $article->title
                        )]
                );
    ?>
</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div>
<?php
    echo $this->Html->link('Create an Article', ['action' => 'create']
);

?>
</div>
