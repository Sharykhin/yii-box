<?php
namespace app\modules\backend\modules\gallery\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use app\modules\backend\modules\gallery\models\GalleryImages;
use app\modules\backend\modules\gallery\models\GalleryCategories;

/**
 * Class GalleryWidget
 * @package app\modules\backend\modules\gallery\widgets
 * @example <?php echo GalleryWidget::widget(['category'=>'Zvezdy-Gollivuda']); ?>
 */
class GalleryWidget extends Widget{

    public $category;

    public function init(){
        parent::init();
    }

    public function run(){
        if(is_null($this->category)) {return null;}
        $category = GalleryCategories::findOne(['type'=>$this->category]);
        $images = $category->getImages()->all();
        return $this->renderFile(__DIR__.'/../views/_widgets/gallery/gallery.php',['images'=>$images]);

    }
}