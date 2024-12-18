<?php
require_once('app/config/database.php');
require_once('app/model/ProductModel.php');
require_once('app/model/CategoryModel.php');

class ProductController
{
    private $productModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    public function apiDocs()
    {
        // Set the content type to HTML
        header('Content-Type: text/html');
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <title>Product Management API Documentation</title>
            <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/4.18.3/swagger-ui.css" />
            <style>
                html {
                    box-sizing: border-box;
                    overflow: -moz-scrollbars-vertical;
                    overflow-y: scroll;
                }

                *,
                *:before,
                *:after {
                    box-sizing: inherit;
                }

                body {
                    margin: 0;
                    background: #fafafa;
                }
            </style>
        </head>

        <body>
            <div id="swagger-ui"></div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/4.18.3/swagger-ui-bundle.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/4.18.3/swagger-ui-standalone-preset.js"></script>
            <script>
                window.onload = function() {
                    const ui = SwaggerUIBundle({
                        url: "/S4_PHP/api-docs.yaml",
                        dom_id: '#swagger-ui',
                        deepLinking: true,
                        presets: [
                            SwaggerUIBundle.presets.apis,
                            SwaggerUIStandalonePreset
                        ],
                        plugins: [
                            SwaggerUIBundle.plugins.DownloadUrl
                        ],
                        layout: "StandaloneLayout"
                    });
                    window.ui = ui;
                };
            </script>
        </body>

        </html>
<?php
    }

    private function checkAdminRole()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header('Location: /S4_PHP/Product/index');
            exit;
        }
    }

    public function index()
    {
        $products = $this->productModel->getProducts();
        include 'app/views/products/list.php';
    }

    public function show($id)
    {
        $product = $this->productModel->getProductById($id);
        if ($product) {
            include 'app/views/products/show.php';
        } else {
            echo "Không thấy sản phẩm.";
        }
    }

    public function add()
    {
        $this->checkAdminRole(); // Thêm kiểm tra quyền
        $categories = (new CategoryModel($this->db))->getCategories();
        include_once 'app/views/products/add.php';
    }

    public function save()
    {
        $this->checkAdminRole(); // Thêm kiểm tra quyền
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $category_id = $_POST['category_id'] ?? null;

            $result = $this->productModel->addProduct(
                $name,
                $description,
                $price,
                $category_id
            );

            if (is_array($result)) {
                $errors = $result;
                $categories = (new CategoryModel($this->db))->getCategories();
                include 'app/views/products/add.php';
            } else {
                header('Location: /S4_PHP/Product');
            }
        }
    }

    public function edit($id)
    {
        $this->checkAdminRole(); // Thêm kiểm tra quyền
        $product = $this->productModel->getProductById($id);
        $categories = (new CategoryModel($this->db))->getCategories();
        if ($product) {
            include 'app/views/products/edit.php';
        } else {
            echo "Không thấy sản phẩm.";
        }
    }

    public function update()
    {
        $this->checkAdminRole(); // Thêm kiểm tra quyền
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];

            $edit = $this->productModel->updateProduct(
                $id,
                $name,
                $description,
                $price,
                $category_id
            );

            if ($edit) {
                header('Location: /S4_PHP/Product');
            } else {
                echo "Đã xảy ra lỗi khi lưu sản phẩm.";
            }
        }
    }

    public function delete($id)
    {
        $this->checkAdminRole(); // Thêm kiểm tra quyền
        if ($this->productModel->deleteProduct($id)) {
            header('Location: /S4_PHP/Product');
        } else {
            echo "Đã xảy ra lỗi khi xóa sản phẩm.";
        }
    }
}
