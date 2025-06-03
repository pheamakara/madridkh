<?php
session_start();

// Simple language switcher via GET param
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'en';

// Load translations
$langData = [];
if ($lang === 'km') {
    $langData = include __DIR__ . '/../lang/km.php';
} else {
    $langData = include __DIR__ . '/../lang/en.php';
}

function t($key) {
    global $langData;
    return $langData[$key] ?? $key;
}

?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang); ?>" class="scroll-smooth bg-gray-900 text-gray-100">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo t('site_title'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Add dark mode toggle or extra styling here */
    </style>
</head>
<body class="min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-gray-800 p-4 flex justify-between items-center shadow-lg">
        <div class="text-xl font-bold"><?php echo t('site_title'); ?></div>
        <nav>
            <a href="?lang=en" class="mr-4 hover:underline <?php echo $lang==='en' ? 'font-semibold' : ''; ?>">English</a>
            <a href="?lang=km" class="hover:underline <?php echo $lang==='km' ? 'font-semibold' : ''; ?>">ខ្មែរ</a>
        </nav>
    </header>

    <div class="flex flex-1 overflow-hidden">

        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 p-4 hidden md:block">
            <ul class="space-y-4">
                <li><a href="#" class="block px-3 py-2 rounded hover:bg-gray-700"><?php echo t('nav_home'); ?></a></li>
                <li><a href="#" class="block px-3 py-2 rounded hover:bg-gray-700"><?php echo t('nav_about'); ?></a></li>
                <li><a href="#" class="block px-3 py-2 rounded hover:bg-gray-700"><?php echo t('nav_contact'); ?></a></li>
            </ul>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-6 overflow-auto">
            <h1 class="text-3xl font-extrabold mb-6"><?php echo t('welcome_message'); ?></h1>

            <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-gray-700 rounded-lg p-4 shadow-md">
                    <h2 class="text-xl font-semibold mb-2"><?php echo t('feature_one_title'); ?></h2>
                    <p><?php echo t('feature_one_desc'); ?></p>
                </div>
                <div class="bg-gray-700 rounded-lg p-4 shadow-md">
                    <h2 class="text-xl font-semibold mb-2"><?php echo t('feature_two_title'); ?></h2>
                    <p><?php echo t('feature_two_desc'); ?></p>
                </div>
                <div class="bg-gray-700 rounded-lg p-4 shadow-md">
                    <h2 class="text-xl font-semibold mb-2"><?php echo t('feature_three_title'); ?></h2>
                    <p><?php echo t('feature_three_desc'); ?></p>
                </div>
            </section>
        </main>

    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-center p-4 text-sm text-gray-400">
        &copy; <?php echo date('Y'); ?> MadridKH. <?php echo t('footer_rights'); ?>
    </footer>

</body>
</html>