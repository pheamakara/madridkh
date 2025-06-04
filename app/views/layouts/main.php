<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Madrid Cambodia - Official Fan Club</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'realmadrid': {
                            'blue': '#004D98',
                            'gold': '#FEBE10',
                            'white': '#FFFFFF',
                            'black': '#000000',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .banner-slide {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                              url('https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80');
            background-size: cover;
            background-position: center;
        }
        .news-card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }
        .fixture-card {
            border-left: 4px solid #FEBE10;
        }
        .language-switcher {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 100;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-realmadrid-blue text-white">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <img src="https://upload.wikimedia.org/wikipedia/en/5/56/Real_Madrid_CF.svg" alt="Real Madrid Logo" class="h-16">
                <div class="ml-4">
                    <h1 class="text-2xl font-bold">REAL MADRID CAMBODIA</h1>
                    <p class="text-realmadrid-gold text-sm">Official Fan Club</p>
                </div>
            </div>
            
            <nav class="hidden md:block">
                <ul class="flex space-x-6">
                    <li><a href="/" class="font-bold hover:text-realmadrid-gold transition">Home</a></li>
                    <li><a href="/news" class="hover:text-realmadrid-gold transition">News</a></li>
                    <li><a href="/match" class="hover:text-realmadrid-gold transition">Match Center</a></li>
                    <li><a href="/team" class="hover:text-realmadrid-gold transition">Team</a></li>
                    <li><a href="/about" class="hover:text-realmadrid-gold transition">About</a></li>
                    <li><a href="/contact" class="hover:text-realmadrid-gold transition">Contact</a></li>
                </ul>
            </nav>
            
            <button class="md:hidden text-white">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </header>
    
    <!-- Language Switcher -->
    <div class="language-switcher">
        <button class="bg-realmadrid-blue text-white px-3 py-1 rounded-full text-sm font-medium flex items-center">
            <i class="fas fa-globe mr-2"></i>
            <span>EN</span>
            <i class="fas fa-chevron-down ml-2"></i>
        </button>
    </div>
    
    <!-- Main Content -->
    <main>
        <?php include $content; ?>
    </main>
    
    <!-- Footer -->
    <footer class="bg-realmadrid-blue text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Real Madrid Cambodia</h3>
                    <p class="text-gray-300">The official fan club of Real Madrid in Cambodia. Supporting Los Blancos since 2010.</p>
                </div>
                
                <div>
                    <h4 class="font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-gray-300 hover:text-white">Home</a></li>
                        <li><a href="/news" class="text-gray-300 hover:text-white">News</a></li>
                        <li><a href="/match" class="text-gray-300 hover:text-white">Match Center</a></li>
                        <li><a href="/team" class="text-gray-300 hover:text-white">Team</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold mb-4">Information</h4>
                    <ul class="space-y-2">
                        <li><a href="/about" class="text-gray-300 hover:text-white">About Us</a></li>
                        <li><a href="/contact" class="text-gray-300 hover:text-white">Contact</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Terms of Use</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-bold mb-4">Connect With Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white"><i class="fab fa-facebook-f text-xl"></i></a>
                        <a href="#" class="text-gray-300 hover:text-white"><i class="fab fa-twitter text-xl"></i></a>
                        <a href="#" class="text-gray-300 hover:text-white"><i class="fab fa-instagram text-xl"></i></a>
                        <a href="#" class="text-gray-300 hover:text-white"><i class="fab fa-youtube text-xl"></i></a>
                        <a href="#" class="text-gray-300 hover:text-white"><i class="fab fa-telegram text-xl"></i></a>
                    </div>
                    <div class="mt-4">
                        <p class="text-gray-300">Subscribe to our newsletter</p>
                        <div class="mt-2 flex">
                            <input type="email" placeholder="Your email" class="px-3 py-2 rounded-l w-full">
                            <button class="bg-realmadrid-gold text-realmadrid-blue px-4 py-2 rounded-r font-bold">Join</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
                <p>&copy; <?php echo date('Y'); ?> Real Madrid Cambodia. All rights reserved.</p>
                <p class="mt-2">This is an unofficial fan site and is not affiliated with Real Madrid CF.</p>
            </div>
        </div>
    </footer>
    
    <script>
        // Simple banner carousel
        let currentSlide = 0;
        const slides = document.querySelectorAll('.banner-slide');
        
        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('hidden', i !== index);
            });
        }
        
        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }
        
        // Auto-advance slides every 5 seconds
        setInterval(nextSlide, 5000);
        
        // Mobile menu toggle
        document.querySelector('button.md\\:hidden').addEventListener('click', function() {
            document.querySelector('nav').classList.toggle('hidden');
            document.querySelector('nav').classList.toggle('block');
            document.querySelector('nav').classList.toggle('absolute');
            document.querySelector('nav').classList.toggle('bg-realmadrid-blue');
            document.querySelector('nav').classList.toggle('w-full');
            document.querySelector('nav').classList.toggle('left-0');
            document.querySelector('nav').classList.toggle('top-16');
            document.querySelector('nav').classList.toggle('p-4');
        });
    </script>
</body>
</html>