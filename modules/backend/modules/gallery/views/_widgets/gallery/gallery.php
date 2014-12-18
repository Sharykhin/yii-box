<?php
$this->registerCssFile('css/modules/gallery/common.css');
?>
<ul class="images-list">
<?php foreach($images as $image) : ?>
    <li>
        <img src="<?php echo $image->small_path ?>" />
    </li>
<?php endforeach; ?>
</ul>