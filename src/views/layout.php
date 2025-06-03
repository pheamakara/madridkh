<!-- src/views/layout.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'MadridKH' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">
    <?php include __DIR__ . '/partials/header.php'; ?>
    
    <main class="container mx-auto p-4">
        <?= $content ?>
    </main>

    <?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
