<h1>Node List</h1>

<?php if (!empty($nodes)) : ?>
    <div id="header_lower">
        <?php foreach($nodes as $node) : ?>
            <div id="header_content_boxline"><?php echo $node->title; ?></div>
            <div id="header_content_boxcontent"><?php echo $node->body; ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>