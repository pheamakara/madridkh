<!-- src/views/home.php -->
<?php ob_start(); ?>
<h1 class="text-3xl font-bold mb-4">Welcome to MadridKH</h1>
<p class="text-lg">This is a modern PHP CMS built from scratch with Tailwind CSS.</p>
<?php $content = ob_get_clean(); ?>

<?php include __DIR__ . '/layout.php'; ?>
