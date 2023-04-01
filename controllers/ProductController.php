<?php

namespace app\controllers;

use app\models\ProductCreate;
use app\models\ProductUpdate;
use app\src\product\application\AllProductUseCase;
use app\src\product\application\CreateProductUseCase;
use app\src\product\application\DeleteProductUseCase;
use app\src\product\application\GetProductUseCase;
use app\src\product\application\UpdateProductUseCase;
use app\src\product\infrastructure\repositories\RecordPatternProduct;
use yii\web\Controller;
use app\traits\ApiResponse;
use Yii;
use yii\filters\auth\HttpBearerAuth;

class ProductController extends Controller
{
    use ApiResponse;

    private RecordPatternProduct $repository;

    public function behaviors()
    {

        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];
        
        return $behaviors;
    }

    /**
     * Product repository injection.
     * @param RecordPatternProduct
    */

    public function __construct($id, $module, RecordPatternProduct $repository, $config = [])
    {
        $this->repository = $repository;

        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $allProductUseCase = new AllProductUseCase($this->repository);

        return $this->successResponse($allProductUseCase->allProduct());
    }

    public function actionCreate()
    {
        $dataProduct = Yii::$app->request->post();
        $formValidation = new ProductCreate();

        // validate data form request
        $formValidation->attributes = $dataProduct;

        if( $formValidation->validate() ){
            $productName           = $dataProduct['name'];
            $productDescription    = $dataProduct['description'];
            $productStock          = $dataProduct['stock'];
            $productPrice          = $dataProduct['price'];
    
            $createProductUseCase = new CreateProductUseCase($this->repository);
            $product = $createProductUseCase->registerProduct($productName, $productDescription, $productStock, $productPrice);
            
            return $this->successResponse($product);
        }

        return $this->errorResponse($formValidation->errors, 403);
    }

    public function actionView($id)
    {
        $getProductUseCase = new GetProductUseCase($this->repository);
        $product = $getProductUseCase->getProduct($id);

        return $this->successResponse([
            'id' => intval($id),
            'name' => $product->name()->value(),
            'description' => $product->description()->value(),
            'stock' => $product->stock()->value(),
            'price' => $product->price()->value()
        ]);
    }


    public function actionUpdate($id)
    {
        $dataProduct = Yii::$app->request->post();

        if( count($dataProduct) == 0 ){
            return $this->errorResponse('at least one parameter must be sent', 403);
        }

        $formValidation = new ProductUpdate();

        // validate data form request
        $formValidation->attributes = $dataProduct;

        if( $formValidation->validate() ){
            $updateProductUseCase = new UpdateProductUseCase($this->repository);
            $product = $updateProductUseCase->updateProduct($id, $dataProduct);

            return $this->successResponse($product);
        }

        return $this->errorResponse($formValidation->errors, 403);
        
    }

    public function actionDelete($id)
    {
        $deleteProductUseCase = new DeleteProductUseCase($this->repository);
        $product = $deleteProductUseCase->deleteProduct($id);

        return $this->successResponse([
            'id' => intval($id),
            'name' => $product->name()->value(),
            'description' => $product->description()->value(),
            'stock' => $product->stock()->value(),
            'price' => $product->price()->value()
        ]);
    }
}