<?php foreach($images as $image) : ?>
    <?php $imageArray = explode('/',$image->big_path); $imageName = $imageArray[(sizeof($imageArray)-1)]; ?>
    <li><a data-gallery href="<?php echo Yii::$app->request->getHostInfo().'/vendors/jquery-fileupload/server/php/files/'.$imageName; ?>" download="<?php echo $imageName; ?>" title="<?php echo $imageName ?>" ><img src="<?php echo $image->small_path; ?>" /></a></li>
<?php endforeach; ?>