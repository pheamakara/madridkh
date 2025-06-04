<?php
$content = 'app/views/home/content.php';
?>

<?php ob_start(); ?>
<section class="banner-slide relative py-24 text-white">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-4">HALA MADRID!</h1>
        <p class="text-xl md:text-2xl max-w-2xl mx-auto mb-8">
            Join Cambodia's largest community of Real Madrid supporters
        </p>
        <div class="flex justify-center space-x-4">
            <a href="/news" class="bg-realmadrid-gold text-realmadrid-blue px-6 py-3 rounded-full font-bold hover:bg-yellow-500 transition">
                Latest News
            </a>
            <a href="/match" class="border-2 border-white px-6 py-3 rounded-full font-bold hover:bg-white hover:text-realmadrid-blue transition">
                Match Center
            </a>
        </div>
    </div>
</section>

<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold">Latest News</h2>
            <a href="/news" class="text-realmadrid-blue font-medium hover:underline">View All News →</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($latestNews as $news): ?>
            <div class="news-card bg-white rounded-lg shadow-md overflow-hidden transition">
                <img src="<?= $news['image'] ?? 'https://images.unsplash.com/photo-1575361204480-aadea25e6e68?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1742&q=80' ?>" 
                     alt="<?= htmlspecialchars($news['title']) ?>" 
                     class="w-full h-48 object-cover">
                <div class="p-4">
                    <span class="text-xs text-realmadrid-gold font-semibold"><?= date('M d, Y', strtotime($news['created_at'])) ?></span>
                    <h3 class="text-xl font-bold my-2"><?= htmlspecialchars($news['title']) ?></h3>
                    <p class="text-gray-600 mb-4"><?= htmlspecialchars($news['excerpt']) ?></p>
                    <a href="#" class="text-realmadrid-blue font-medium hover:underline">Read more →</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="py-12 bg-gray-100">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Upcoming Fixtures -->
            <div class="bg-white rounded-lg shadow-md">
                <div class="bg-realmadrid-blue text-white py-3 px-4 rounded-t-lg">
                    <h2 class="text-xl font-bold">Upcoming Fixtures</h2>
                </div>
                
                <div class="p-4">
                    <?php foreach ($upcomingFixtures as $fixture): ?>
                    <div class="fixture-card mb-4 last:mb-0 bg-white p-4 rounded-md shadow-sm">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-500"><?= date('D, M d', strtotime($fixture['date'])) ?></span>
                            <span class="text-sm bg-gray-200 px-2 py-1 rounded"><?= $fixture['competition'] ?></span>
                        </div>
                        
                        <div class="flex justify-between items-center py-3">
                            <div class="flex items-center">
                                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16" />
                                <span class="ml-3 font-medium"><?= $fixture['home_team'] ?></span>
                            </div>
                            
                            <div class="text-center">
                                <span class="text-xs text-gray-500"><?= date('H:i', strtotime($fixture['date'])) ?></span>
                                <div class="text-lg font-bold mt-1">VS</div>
                            </div>
                            
                            <div class="flex items-center">
                                <span class="mr-3 font-medium"><?= $fixture['away_team'] ?></span>
                                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16" />
                            </div>
                        </div>
                        
                        <div class="text-center text-sm text-gray-500 mt-2">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <?= $fixture['venue'] ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    
                    <div class="mt-6 text-center">
                        <a href="/match" class="inline-block bg-realmadrid-blue text-white px-6 py-2 rounded-full font-medium hover:bg-blue-800 transition">
                            View Full Schedule
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- League Table -->
            <div class="bg-white rounded-lg shadow-md">
                <div class="bg-realmadrid-blue text-white py-3 px-4 rounded-t-lg">
                    <h2 class="text-xl font-bold">La Liga Standings</h2>
                </div>
                
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="py-2 px-3 text-left">Pos</th>
                                    <th class="py-2 px-3 text-left">Team</th>
                                    <th class="py-2 px-3 text-center">P</th>
                                    <th class="py-2 px-3 text-center">W</th>
                                    <th class="py-2 px-3 text-center">D</th>
                                    <th class="py-2 px-3 text-center">L</th>
                                    <th class="py-2 px-3 text-center">Pts</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($leagueTable as $team): ?>
                                <tr class="border-b <?= $team['team'] === 'Real Madrid' ? 'bg-realmadrid-blue bg-opacity-10 font-bold' : '' ?>">
                                    <td class="py-3 px-3"><?= $team['position'] ?></td>
                                    <td class="py-3 px-3 flex items-center">
                                        <div class="bg-gray-200 border-2 border-dashed rounded-xl w-8 h-8 mr-2" />
                                        <?= $team['team'] ?>
                                    </td>
                                    <td class="py-3 px-3 text-center"><?= $team['played'] ?></td>
                                    <td class="py-3 px-3 text-center"><?= $team['won'] ?></td>
                                    <td class="py-3 px-3 text-center"><?= $team['drawn'] ?></td>
                                    <td class="py-3 px-3 text-center"><?= $team['lost'] ?></td>
                                    <td class="py-3 px-3 text-center font-bold"><?= $team['points'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4 text-center">
                        <a href="/match" class="inline-block text-realmadrid-blue font-medium hover:underline">
                            View Full Table →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl md:text-3xl font-bold text-center mb-8">Real Madrid Cambodia Events</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="border rounded-lg p-6 text-center">
                <div class="text-realmadrid-blue text-4xl mb-4">
                    <i class="fas fa-trophy"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Match Viewing</h3>
                <p class="text-gray-600 mb-4">
                    Join us at our official viewing locations for every Real Madrid match
                </p>
                <a href="#" class="text-realmadrid-blue font-medium hover:underline">Find locations →</a>
            </div>
            
            <div class="border rounded-lg p-6 text-center">
                <div class="text-realmadrid-blue text-4xl mb-4">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Fan Meetings</h3>
                <p class="text-gray-600 mb-4">
                    Monthly gatherings for fans to discuss, share, and celebrate together
                </p>
                <a href="#" class="text-realmadrid-blue font-medium hover:underline">Join us →</a>
            </div>
            
            <div class="border rounded-lg p-6 text-center">
                <div class="text-realmadrid-blue text-4xl mb-4">
                    <i class="fas fa-futbol"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Fan Tournaments</h3>
                <p class="text-gray-600 mb-4">
                    Participate in our annual football tournaments for Real Madrid fans
                </p>
                <a href="#" class="text-realmadrid-blue font-medium hover:underline">Register now →</a>
            </div>
        </div>
    </div>
</section>
<?php $content = ob_get_clean(); ?>