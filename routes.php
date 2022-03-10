<?php

$router = $core->route;

$router->get('/', function () {
    echo json_encode(array(
        'h2' => 'Welcome to avilamidia API package!',
        'h4' => 'To start using, create a route at index.php!'
    ));
});

$router->get('/products', function () {
    $product = new Product();
    echo json_encode($product->getProducts());
});

$router->get('/product', function () {
    $product = new Product();
    echo json_encode($product->getProductByName($_GET['name']));
});

$router->get('/categories', function () {
    $category = new Category();
    echo json_encode($category->getAllCategories());
});

$router->get('/product-id', function () {
    $product = new Product();
    echo json_encode($product->getProductById($_GET['id']));
});

$router->get('/total-amount-products', function () {
    $product = new Product();
    echo json_encode(array('productAmount' => $product->getNumProducts()));
});

$router->post('/products/create-new', function() {
    $uploader = new Uploader();
    $product = new Product();

    $tmpProduto = json_decode($_POST['product']);

    if(!isset($tmpProduto->inStock)) {
        $tmpProduto->inStock = 0;
    }

    if(!$tmpProduto->thumbnail = IMAGE_DIR . $uploader->uploadFile($_FILES['file'])) {
        echo json_encode(array(
            'msg' => 'Error uploading image'
        ));
        die;
    }

    echo json_encode(array(
        'msg' => $product->createProduct($tmpProduto)
    ));
});

$router->post('/products/edit-product', function() {
    $product = new Product();
    $tmpProduto = json_decode($_POST['product']);

    if(isset($_FILES['file'])) {
        $uploader = new Uploader();
        if(!$tmpProduto->thumbnail = IMAGE_DIR . $uploader->changeFile($tmpProduto->thumbnail, $_FILES['file'])) {
            echo json_encode(array(
                'msg' => 'Error uploading image'
            ));
            die;
        }
    }

    echo json_encode(array(
        'msg' => $product->editProduct($tmpProduto)
    ));
});