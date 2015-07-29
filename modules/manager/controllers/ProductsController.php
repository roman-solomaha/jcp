<?php

namespace app\modules\manager\controllers;

use app\models\Product;
use app\models\ProductDetail;
use app\models\ProductImage;
use Yii;
use yii\base\ErrorException;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use app\modules\manager\components\ManagerController;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\UploadedFile;
use yii2vm\media\upload\ImageUpload;

class ProductsController extends ManagerController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
            'pagination' => [
                'pageSize' => 0
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider

        ]);
    }

    public function actionForm($id = null){
        $products = new Product();
        $details = $products->details;
        $images = $products->images;

        if($id) {
            /* @var $products \app\models\Product */

            $products = Product::findOne($id);
        }

        if($products->load(Yii::$app->request->post())){

            $sizeImage = Yii::$app->params['sizeImage'];

            ImageUpload::createFromEntity($products, 'image')
                ->resize($sizeImage['width'], $sizeImage['height'])
                ->toEntity($products, 'image_filename');

            $productImages = UploadedFile::getInstances($images, 'filename');

            var_dump($productImages);

            $products->unlinkAll('detail', true);
            $products->unlinkAll('image', true);

            foreach(Yii::$app->request->post()['ProductDetail'] as $detail){
                $detailsModel = new ProductDetail();
                $detailsModel->attributes = $detail;
                $products->link('detail', $detailsModel);
            }

            foreach(Yii::$app->request->post()['ProductImage'] as $image){
                $imageModel = new ProductDetail();
                $imageModel->attributes = $image;
                $products->link('image', $imageModel);
            }

            if($products->save()){
                return $this->redirect(['index']);
            }
        }

        return $this->render('form',
            ['products' => $products, 'details' => $details, 'images' => $images]);

    }
}
