<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
</head>
<body>

<h1>Webshop</h1>

<ul>
    <?php foreach ($products ?? [] as $product) : ?>
        <li><?= $product->getName() ?> (<?= $product->getPrice() ?>)</li>
    <?php endforeach; ?>
</ul>

</body>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript" src="/assets/js/app.js"></script>
</html>