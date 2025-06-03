<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">
    <header class="bg-white bg-opacity-5 p-4 shadow sticky top-0 z-50">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">MadridKH</h1>
            <nav class="flex items-center gap-6 text-sm">
                <ul class="flex gap-6">
                    <li><a href="/" class="hover:underline"><?= __('Home') ?></a></li>
                    <li><a href="/news" class="hover:underline"><?= __('News') ?></a></li>
                    <li><a href="/fixtures" class="hover:underline"><?= __('Fixtures') ?></a></li>
                    <li><a href="/team" class="hover:underline"><?= __('Team') ?></a></li>
                    <li><a href="/about" class="hover:underline"><?= __('About') ?></a></li>
                    <li><a href="/contact" class="hover:underline"><?= __('Contact') ?></a></li>
                </ul>
                <form method="get" action="" class="ml-4">
                    <select name="lang" onchange="this.form.submit()" class="bg-gray-800 text-white rounded px-2 py-1">
                        <option value="en" <?= ($_GET['lang'] ?? 'km') === 'en' ? 'selected' : '' ?>>EN</option>
                        <option value="km" <?= ($_GET['lang'] ?? 'km') === 'km' ? 'selected' : '' ?>>ខ្មែរ</option>
                    </select>
                </form>
            </nav>
        </div>
    </header>
