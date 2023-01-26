
# YouCan Coding Challenge Application

This application allows users to create, read, and delete products and categories through both a command-line interface (CLI) and a web interface.

## Run Locally

Clone the project

```bash
  git clone https://github.com/maelhadi/coding-challenge-app.git
```

Go to the project directory

```bash
  cd coding-challenge-app
```

Install dependencies

```bash
  ./build
```
NB: If you encounter this error after the build : 
SQLSTATE[HY000] [2006] MySQL server has gone away
just re-execute the command

Start the server

```bash
  ./start
```

## Web Interface

To access the web interface, navigate to http://localhost:8000/ in your web browser.


## CLI Usage

Creates a new product with the specified name, description, price, and category.
```bash
php artisan product:create --name=<product name>  --description=<product description>  --price=<product price>  --image=<product image path>
```

Delete a product.
```bash
php artisan product:delete --id=<product id>
```

Creates a new category with the specified name and parent category.
```bash
php artisan category:create --name=<category name>  [--parentId=<parent id>]
```

Delete a category.
```bash
php artisan category:delete --id=<category id>
```


## Running Tests

To run tests, run the following command

```bash
  php artisan test
```

 
## Author

- [@ma.elhadi](https://github.com/maelhadi)



