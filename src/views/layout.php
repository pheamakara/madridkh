<?php
require_once __DIR__ . '/partials/header.php';
?>

<main class="p-6 max-w-6xl mx-auto">
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-4">ព័ត៌មានថ្មីៗ</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <?php foreach ($latestNews as $news): ?>
                <a href="<?= $news['link'] ?>" class="bg-white bg-opacity-10 backdrop-blur-lg p-4 rounded-xl shadow hover:scale-105 transition-transform duration-300">
                    <img src="<?= $news['image'] ?>" class="rounded-md mb-3 h-40 w-full object-cover">
                    <h3 class="text-lg font-semibold text-white mb-1"><?= $news['title'] ?></h3>
                    <p class="text-sm text-gray-300"><?= $news['snippet'] ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-4">ការប្រកួតខាងមុខ</h2>
        <?php foreach ($fixtures as $match): ?>
        <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 p-4 rounded-xl text-white">
            <p class="text-lg font-medium">ប្រកួតជាមួយ <?= $match['opponent'] ?></p>
            <p><?= $match['date'] ?> ម៉ោង <?= $match['time'] ?> @ <?= $match['venue'] ?></p>
        </div>
        <?php endforeach; ?>
    </section>
</main>

<?php
require_once __DIR__ . '/partials/footer.php';
?>
