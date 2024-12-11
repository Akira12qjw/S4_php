<?php include 'app/views/shares/header.php'; ?>
<h1>Danh sách sản phẩm</h1>
<a href="/S4_PHP/Product/add" class="btn btn-success mb-2">Thêm sản phẩm mới</a>
<ul class="list-group">
    <?php foreach ($products as $product): ?>
        <li class="list-group-item">
            <h2> <a href="/S4_PHP/Product/show/<?php echo $product->id; ?>">
                    <?php echo htmlspecialchars($product->title, ENT_QUOTES, 'UTF-8'); ?>
                </a>
            </h2>

            <p><?php echo htmlspecialchars($product->description, ENT_QUOTES); ?></p>

            <p>Giá: <?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8');

                    ?></p>

            <a href="/S4_PHP/Product/edit/<?php echo $product->id; ?>" class="btn

btn-warning">Sửa</a>

            <a href="/S4_PHP/Product/delete/<?php echo $product->id; ?>"
                class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
        </li>
    <?php endforeach; ?>
</ul>
<?php include 'app/views/shares/footer.php'; ?>