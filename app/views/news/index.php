<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-start mb-8">
            <div>
                <h1 class="text-3xl font-bold text-realmadrid-blue">Real Madrid News</h1>
                <p class="text-gray-600 mt-2">Latest updates, match reports, and club news</p>
            </div>
            
            <div class="mt-4 md:mt-0">
                <div class="relative">
                    <input type="text" placeholder="Search news..." 
                           class="border border-gray-300 rounded-full px-4 py-2 w-64 focus:outline-none focus:ring-2 focus:ring-realmadrid-blue">
                    <button class="absolute right-3 top-2.5 text-gray-400">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Category Tabs -->
        <div class="mb-8">
            <div class="flex flex-wrap gap-2">
                <a href="/news" 
                   class="<?= !$currentCategory && !$currentTag ? 'bg-realmadrid-blue text-white' : 'bg-white text-gray-700' ?> px-4 py-2 rounded-full font-medium hover:bg-realmadrid-blue hover:text-white transition">
                    All News
                </a>
                
                <?php foreach ($categories as $category): ?>
                <a href="/news?category=<?= $category['slug'] ?>" 
                   class="<?= $currentCategory === $category['slug'] ? 'bg-realmadrid-blue text-white' : 'bg-white text-gray-700' ?> px-4 py-2 rounded-full font-medium hover:bg-realmadrid-blue hover:text-white transition">
                    <?= $category['name'] ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content -->
            <div class="w-full lg:w-8/12">
                <?php if (empty($news)): ?>
                    <div class="bg-white rounded-lg shadow p-8 text-center">
                        <i class="fas fa-newspaper text-5xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-bold text-gray-700">No news found</h3>
                        <p class="text-gray-600 mt-2">There are no articles in this category.</p>
                        <a href="/news" class="inline-block mt-4 bg-realmadrid-blue text-white px-6 py-2 rounded-full font-medium">
                            Browse All News
                        </a>
                    </div>
                <?php else: ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <?php foreach ($news as $article): ?>
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transition hover:shadow-lg">
                            <a href="/news/<?= $article['id'] ?>">
                                <img src="<?= $article['featured_image'] ?: ASSETS_PATH . '/img/news-placeholder.jpg' ?>" 
                                     alt="<?= htmlspecialchars($article['title']) ?>" 
                                     class="w-full h-48 object-cover">
                            </a>
                            <div class="p-5">
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <span class="mr-3"><?= date('M d, Y', strtotime($article['created_at'])) ?></span>
                                    <span class="bg-realmadrid-blue text-white px-2 py-1 rounded text-xs">
                                        <?= $article['category_name'] ?>
                                    </span>
                                </div>
                                <a href="/news/<?= $article['id'] ?>">
                                    <h3 class="text-xl font-bold mb-3 hover:text-realmadrid-blue transition">
                                        <?= htmlspecialchars($article['title']) ?>
                                    </h3>
                                </a>
                                <p class="text-gray-600 mb-4"><?= htmlspecialchars($article['excerpt']) ?></p>
                                <div class="flex items-center">
                                    <div class="bg-gray-200 border-2 border-dashed rounded-xl w-8 h-8"></div>
                                    <span class="ml-2 text-sm text-gray-700"><?= $article['author'] ?></span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <!-- Pagination / Load More -->
                    <div class="mt-10">
                        <?php if ($pagination['total_pages'] > 1): ?>
                            <?php if ($pagination['current_page'] < $pagination['total_pages']): ?>
                                <div class="text-center">
                                    <a href="<?= $pagination['base_url'] . 'page=' . ($pagination['current_page'] + 1) ?>" 
                                       class="bg-white border border-realmadrid-blue text-realmadrid-blue px-6 py-3 rounded-full font-medium hover:bg-realmadrid-blue hover:text-white transition">
                                        Load More
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="flex justify-center mt-6">
                                <div class="flex space-x-1">
                                    <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                                        <a href="<?= $pagination['base_url'] . 'page=' . $i ?>" 
                                           class="w-10 h-10 flex items-center justify-center rounded-full 
                                                  <?= $i == $pagination['current_page'] ? 'bg-realmadrid-blue text-white' : 'bg-gray-100 text-gray-700' ?>">
                                            <?= $i ?>
                                        </a>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Sidebar -->
            <div class="w-full lg:w-4/12">
                <!-- Trending Tags -->
                <div class="bg-white rounded-lg shadow-md p-5 mb-6">
                    <h3 class="text-lg font-bold mb-4 flex items-center">
                        <i class="fas fa-fire text-realmadrid-gold mr-2"></i>
                        Trending Tags
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        <?php foreach ($trendingTags as $tag): ?>
                            <a href="/news?tag=<?= $tag['slug'] ?>" 
                               class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm hover:bg-realmadrid-blue hover:text-white transition">
                                #<?= $tag['name'] ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- Matchday Widget -->
                <div class="bg-realmadrid-blue text-white rounded-lg shadow-md p-5 mb-6">
                    <h3 class="text-lg font-bold mb-4">Next Match</h3>
                    <div class="flex justify-between items-center mb-3">
                        <div class="text-center">
                            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16 mx-auto"></div>
                            <span class="block mt-2 font-medium">Real Madrid</span>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold">VS</div>
                            <span class="text-sm">June 15, 20:00</span>
                        </div>
                        <div class="text-center">
                            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16 mx-auto"></div>
                            <span class="block mt-2 font-medium">Barcelona</span>
                        </div>
                    </div>
                    <div class="text-center text-sm mt-3">
                        <i class="fas fa-map-marker-alt mr-1"></i>
                        Santiago Bernabeu
                    </div>
                    <a href="/match" class="block mt-4 bg-realmadrid-gold text-realmadrid-blue text-center py-2 rounded font-bold hover:bg-yellow-500 transition">
                        Match Center
                    </a>
                </div>
                
                <!-- Popular News -->
                <div class="bg-white rounded-lg shadow-md p-5">
                    <h3 class="text-lg font-bold mb-4">Most Read</h3>
                    <div class="space-y-4">
                        <?php for ($i = 1; $i <= 3; $i++): ?>
                        <a href="#" class="flex group">
                            <div class="w-16 h-16 flex-shrink-0">
                                <img src="<?= ASSETS_PATH ?>/img/news-<?= $i ?>.jpg" alt="Popular news" class="w-full h-full object-cover rounded">
                            </div>
                            <div class="ml-3">
                                <h4 class="font-bold group-hover:text-realmadrid-blue transition">Real Madrid signs new superstar</h4>
                                <div class="flex items-center text-xs text-gray-500 mt-1">
                                    <span>Jun 12</span>
                                    <span class="mx-2">•</span>
                                    <span>1.2K views</span>
                                </div>
                            </div>
                        </a>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>