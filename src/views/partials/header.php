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
            <nav>
                <ul class="flex gap-6 text-sm">
                    <li><a href="/" class="hover:underline">ទំព័រដើម</a></li>
                    <li><a href="/news" class="hover:underline">ព័ត៌មាន</a></li>
                    <li><a href="/fixtures" class="hover:underline">ប្រកួត</a></li>
                    <li><a href="/team" class="hover:underline">ក្រុម</a></li>
                    <li><a href="/about" class="hover:underline">អំពីយើង</a></li>
                    <li><a href="/contact" class="hover:underline">ទំនាក់ទំនង</a></li>
                </ul>
            </nav>
        </div>
    </header>