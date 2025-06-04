<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content -->
            <div class="w-full lg:w-8/12">
                <article class="bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Featured Image -->
                    <img src="<?= $news['featured_image'] ?: ASSETS_PATH . '/img/news-placeholder.jpg' ?>" 
                         alt="<?= htmlspecialchars($news['title']) ?>" 
                         class="w-full h-96 object-cover">
                    
                    <!-- Article Header -->
                    <div class="p-6">
                        <div class="flex flex-wrap items-center justify-between mb-4">
                            <div>
                                <a href="/news?category=<?= $news['category_slug'] ?>" 
                                   class="bg-realmadrid-blue text-white px-3 py-1 rounded-full text-sm font-medium">
                                    <?= $news['category_name'] ?>
                                </a>
                            </div>
                            <div class="text-gray-500 text-sm mt-2 sm:mt-0">
                                <i class="far fa-clock mr-1"></i>
                                <?= date('F j, Y', strtotime($news['created_at'])) ?>
                                <span class="mx-2">•</span>
                                <i class="far fa-eye mr-1"></i>
                                <?= number_format($news['views'] + 1) ?> views
                            </div>
                        </div>
                        
                        <h1 class="text-3xl font-bold mb-4"><?= htmlspecialchars($news['title']) ?></h1>
                        
                        <!-- Author Info -->
                        <div class="flex items-center mb-6 border-t border-b border-gray-200 py-4">
                            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-12 h-12"></div>
                            <div class="ml-3">
                                <div class="font-medium"><?= $news['author'] ?></div>
                                <div class="text-sm text-gray-600">Club Correspondent</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Article Content -->
                    <div class="px-6 pb-8">
                        <?= $news['content'] ?>
                        
                        <!-- Tags -->
                        <?php if (!empty($news['tags'])): ?>
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <span class="font-medium mr-2">Tags:</span>
                            <?php foreach ($news['tags'] as $tag): ?>
                                <a href="/news?tag=<?= $tag['slug'] ?>" 
                                   class="inline-block bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm mr-2 mb-2 hover:bg-realmadrid-blue hover:text-white transition">
                                    #<?= $tag['name'] ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                        
                        <!-- Share Buttons -->
                        <div class="mt-8 flex space-x-4">
                            <span class="font-medium">Share:</span>
                            <a href="#" class="text-blue-600 hover:text-blue-800">
                                <i class="fab fa-facebook-f text-xl"></i>
                            </a>
                            <a href="#" class="text-blue-400 hover:text-blue-600">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                            <a href="#" class="text-red-500 hover:text-red-700">
                                <i class="fab fa-pinterest text-xl"></i>
                            </a>
                            <a href="#" class="text-blue-700 hover:text-blue-900">
                                <i class="fab fa-linkedin-in text-xl"></i>
                            </a>
                        </div>
                    </div>
                </article>
                
                <!-- Related News -->
                <?php if (!empty($relatedNews)): ?>
                <div class="mt-10">
                    <h3 class="text-2xl font-bold mb-6">Related News</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <?php foreach ($relatedNews as $related): ?>
                        <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                            <a href="/news/<?= $related['id'] ?>">
                                <img src="<?= $related['featured_image'] ?: ASSETS_PATH . '/img/news-placeholder.jpg' ?>" 
                                     alt="<?= htmlspecialchars($related['title']) ?>" 
                                     class="w-full h-40 object-cover">
                            </a>
                            <div class="p-4">
                                <a href="/news/<?= $related['id'] ?>">
                                    <h4 class="font-bold mb-2 hover:text-realmadrid-blue transition"><?= htmlspecialchars($related['title']) ?></h4>
                                </a>
                                <div class="text-sm text-gray-500">
                                    <?= date('M d, Y', strtotime($related['created_at'])) ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Comments Section -->
                <div class="mt-10 bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-2xl font-bold mb-6">Comments</h3>
                    
                    <!-- Comment Form -->
                    <div class="mb-8">
                        <form>
                            <div class="mb-4">
                                <textarea placeholder="Join the discussion..." class="w-full p-4 border border-gray-300 rounded focus:ring-2 focus:ring-realmadrid-blue focus:outline-none"></textarea>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                                <div class="flex-grow">
                                    <input type="text" placeholder="Your name" class="w-full p-3 border border-gray-300 rounded">
                                </div>
                                <div class="flex-grow">
                                    <input type="email" placeholder="Your email" class="w-full p-3 border border-gray-300 rounded">
                                </div>
                                <button type="submit" class="bg-realmadrid-blue text-white px-6 py-3 rounded font-medium hover:bg-blue-800 transition">
                                    Post Comment
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Comments List -->
                    <div class="space-y-6">
                        <!-- Comment 1 -->
                        <div class="flex">
                            <div class="flex-shrink-0 mr-4">
                                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-12 h-12"></div>
                            </div>
                            <div class="flex-grow">
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex justify-between">
                                        <h4 class="font-bold">Sok Dara</h4>
                                        <span class="text-sm text-gray-500">2 hours ago</span>
                                    </div>
                                    <p class="mt-2 text-gray-700">Hala Madrid! This is fantastic news for the club. Can't wait to see him play at Bernabeu!</p>
                                    <div class="mt-3 flex space-x-4 text-sm">
                                        <a href="#" class="text-realmadrid-blue hover:underline">Reply</a>
                                        <a href="#" class="text-gray-500 hover:text-gray-700">
                                            <i class="far fa-thumbs-up mr-1"></i> 24
                                        </a>
                                        <a href="#" class="text-gray-500 hover:text-gray-700">
                                            <i class="far fa-thumbs-down mr-1"></i> 2
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- Reply -->
                                <div class="flex mt-4 ml-4">
                                    <div class="flex-shrink-0 mr-4">
                                        <div class="bg-gray-200 border-2 border-dashed rounded-xl w-10 h-10"></div>
                                    </div>
                                    <div class="flex-grow">
                                        <div class="bg-gray-50 rounded-lg p-4">
                                            <div class="flex justify-between">
                                                <h4 class="font-bold">Admin</h4>
                                                <span class="text-sm text-gray-500">1 hour ago</span>
                                            </div>
                                            <p class="mt-2 text-gray-700">We're excited too! The official presentation will be next week.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Comment 2 -->
                        <div class="flex">
                            <div class="flex-shrink-0 mr-4">
                                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-12 h-12"></div>
                            </div>
                            <div class="flex-grow">
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex justify-between">
                                        <h4 class="font-bold">Chenla FC Fan</h4>
                                        <span class="text-sm text-gray-500">5 hours ago</span>
                                    </div>
                                    <p class="mt-2 text-gray-700">Great signing! How will this affect the current squad?</p>
                                    <div class="mt-3 flex space-x-4 text-sm">
                                        <a href="#" class="text-realmadrid-blue hover:underline">Reply</a>
                                        <a href="#" class="text-gray-500 hover:text-gray-700">
                                            <i class="far fa-thumbs-up mr-1"></i> 8
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="w-full lg:w-4/12">
                <!-- Trending Tags -->
                <div class="bg-white rounded-lg shadow-md p-5 mb-6 sticky top-4">
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
                
                <!-- Latest News -->
                <div class="bg-white rounded-lg shadow-md p-5 mb-6">
                    <h3 class="text-lg font-bold mb-4">Latest News</h3>
                    <div class="space-y-4">
                        <?php for ($i = 1; $i <= 3; $i++): ?>
                        <a href="#" class="flex group">
                            <div class="w-16 h-16 flex-shrink-0">
                                <img src="<?= ASSETS_PATH ?>/img/news-<?= $i ?>.jpg" alt="Latest news" class="w-full h-full object-cover rounded">
                            </div>
                            <div class="ml-3">
                                <h4 class="font-bold group-hover:text-realmadrid-blue transition">Real Madrid wins Champions League</h4>
                                <div class="text-xs text-gray-500 mt-1">Jun 10</div>
                            </div>
                        </a>
                        <?php endfor; ?>
                    </div>
                </div>
                
                <!-- Newsletter -->
                <div class="bg-realmadrid-blue text-white rounded-lg shadow-md p-5">
                    <h3 class="text-lg font-bold mb-3">Newsletter</h3>
                    <p class="mb-4 text-gray-200">Subscribe to get the latest Real Madrid news directly to your inbox.</p>
                    <form>
                        <div class="mb-3">
                            <input type="email" placeholder="Your email" class="w-full px-4 py-2 rounded text-gray-800">
                        </div>
                        <button type="submit" class="w-full bg-realmadrid-gold text-realmadrid-blue font-bold py-2 rounded hover:bg-yellow-500 transition">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>