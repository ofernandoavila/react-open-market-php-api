# Getting Started with React Open Market API-PHP

To get started, clone this repository:

`git clone https://github.com/ofernandoavila/react-open-market-php-api`

Pull request are welcome!

## How to configure 

To set up the configs, you just need to set the host, user, pass and the database name of your application.

```php
define('DB_HOST', '');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_NAME', '');

define('URLROOT', 'http://URL_ROOT_OF_API.com');
```

## Add new routes

Add new routes is very simple, just need to use the variable `$router`, followed by the HTTP method and add a function as a parameter. This function is a callback and will return the data back to your application. e.g.:

```php
//Used for get method
$router->get('/', function () {
    echo json_encode(array(
        'data' => 'This is a response from the api'
    ));
});
```
The parameters passed by your application is easily found in the globals variables like `$_GET`, `$_POST` and `$_FILES`.

## Uploading files

To configure the uploader class is very simple, in  the `libraries/` folder, there is a file called `Uploader.php`, in the construct you can set up the directory where the files is going to be uploaded. e.g.:

```php
class Uploader {
    public function __construct() {
        //On the root folder, will be a folder called 'images' created by you
        $this->uploadPath = 'images/';
    }
```
The name of the file will be hash avoiding security problems. To upload the file, use the function `uploadFile()` passing a `$_FILE` as a parameter. e.g.:

```php
$router->post('/upload-file', function() {
    //Instantiate the uploader class
    $uploader = new Uploader();

    $uploader->uploadFile($_FILE['NAME_OF_FILE_ENTERED_IN_YOUR_APP']);
}
```

## Creating new models

New classes can be create in the `model` folder and be call anytime. Is recommended to add a database instance to a local variable inside the `__construct` function. e.g.:

```php
class NewClassName {
    public function __construct() {
        $this->db = new Database();
    }
}
```