<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home - Prep</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .prep-tag {
            background-color: #7a9b8a;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            display: inline-block;
            margin: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .prep-tag:hover {
            background-color: #5d7a6b;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        .prep-tag.active {
            background-color: #2D5F3F;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            transform: scale(1.05);
        }
        
        .search-input {
            background: white;
            border: 1px solid var(--color-prep-border-light);
            border-radius: 25px;
            padding: 12px 20px 12px 45px;
            width: 100%;
            color: #2D3748;
        }
        
        .filter-btn {
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid white;
            border-radius: 25px;
            padding: 12px 24px;
            cursor: pointer;
            color: #2D3748;
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
        
        .filter-btn:hover {
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="min-h-screen">
    <!-- Floating decorations -->
    <div class="floating-decoration-1"></div>
    <div class="floating-decoration-2"></div>
    <div class="floating-decoration-3"></div>
    <div class="floating-decoration-4"></div>
    <div class="floating-decoration-5"></div>
    <div class="floating-decoration-6"></div>
    
    <!-- Header -->
    <header class="text-white py-8 relative z-10" style="background: linear-gradient(135deg, #4CAF50 0%, #66BB6A 100%);">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-4xl font-bold">Prep</h1>
                
                <a href="/profile/edit" class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </a>
            </div>
            
            <!-- Search Bar -->
            <div class="flex gap-4 items-center justify-center">
                <div class="relative flex-1 max-w-2xl">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" id="searchInput" class="search-input" placeholder="Search Ingredients (e.g., chicken, soy sauce)">
                </div>
                
                <button class="filter-btn flex items-center gap-2" onclick="openFilterModal()">
                    <span>Filter</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
            </div>
            
            <!-- Ingredient Tags -->
            <div class="flex flex-wrap justify-center mt-6" id="ingredientTags">
                <span class="prep-tag" data-ingredient="chicken" onclick="toggleIngredient(this)">Chicken</span>
                <span class="prep-tag" data-ingredient="potato" onclick="toggleIngredient(this)">Potato</span>
                <span class="prep-tag" data-ingredient="pork-belly" onclick="toggleIngredient(this)">Pork Belly</span>
                <span class="prep-tag" data-ingredient="bay-leaves" onclick="toggleIngredient(this)">Bay leaves</span>
                <span class="prep-tag" data-ingredient="vinegar" onclick="toggleIngredient(this)">Vinegar</span>
                <span class="prep-tag" data-ingredient="soy-sauce" onclick="toggleIngredient(this)">Soy sauce</span>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8 relative z-10">
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-prep-text-dark mb-6 pb-2 border-b-2 border-gray-300">Available Recipes</h2>
            
            <!-- Recipe Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="recipeGrid">
                @forelse($recentRecipes as $recipe)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden cursor-pointer recipe-card" 
                         data-ingredients="{{ $recipe->ingredients ?? '' }}"
                         onclick="openRecipeModal('{{ $recipe->id }}')">
                        <!-- Recipe Image -->
                        <div class="h-48 bg-gray-200 relative">
                            @if($recipe->image_url ?? false)
                                <img src="{{ $recipe->image_url }}" alt="{{ $recipe->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                            @endif
                            
                            <!-- Favorite Button -->
                            <button class="absolute top-3 right-3 w-9 h-9 bg-white rounded-full shadow-md flex items-center justify-center" onclick="event.stopPropagation(); toggleFavorite({{ $recipe->id }}, this)">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Recipe Info -->
                        <div class="p-4">
                            <h3 class="font-semibold text-lg text-prep-text-dark mb-1">
                                {{ $recipe->name ?? 'Recipe Name' }}
                            </h3>
                            <p class="text-sm text-prep-text-light mb-3 line-clamp-2">
                                {{ $recipe->description ?? 'A delicious recipe to try' }}
                            </p>
                            
                            <div class="flex items-center justify-between text-xs text-prep-text-muted">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $recipe->prep_time ?? '30' }} min</span>
                                </div>
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs">Easy</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 bg-white rounded-lg">
                        <p class="text-prep-text-muted mb-4">No recipes found</p>
                        <a href="/dashboard" class="btn-prep-green text-white px-6 py-2 rounded-full inline-block">
                            Browse All Recipes
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
        
        <div class="text-center mt-12 mb-8">
            <p class="text-prep-text-muted italic">Search an ingredient</p>
        </div>
    </main>

    <!-- Recipe Modal -->
    <div id="recipeModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 overflow-y-auto">
        <div class="min-h-screen px-4 py-8 flex items-center justify-center">
            <div class="bg-white rounded-2xl max-w-4xl w-full shadow-2xl relative">
                <button onclick="closeRecipeModal()" class="absolute top-4 right-4 w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                
                <div id="modalContent" class="p-8">
                    <div class="text-center py-12">
                        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-prep-green mx-auto"></div>
                        <p class="mt-4 text-prep-text-light">Loading...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Modal -->
    <div id="filterModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 overflow-y-auto">
        <div class="min-h-screen px-4 py-8 flex items-center justify-center">
            <div class="bg-white rounded-2xl max-w-2xl w-full shadow-2xl relative p-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-semibold text-prep-text-dark">Filter Recipes</h3>
                    <button onclick="closeFilterModal()" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                
                <form id="filterForm" class="space-y-6">
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="favorites" value="true" class="w-4 h-4 text-prep-green rounded">
                            <span class="ml-2 text-prep-text-dark">Show only my favorites</span>
                        </label>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-prep-text-dark mb-2">Calories Range</label>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="number" name="calories_min" placeholder="Min" class="px-4 py-2 border border-prep-border-light rounded-lg">
                            <input type="number" name="calories_max" placeholder="Max" class="px-4 py-2 border border-prep-border-light rounded-lg">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-prep-text-dark mb-2">Dietary Needs</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" name="dietary_needs[]" value="vegetarian" class="w-4 h-4 text-prep-green rounded">
                                <span class="ml-2 text-prep-text-dark">Vegetarian</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="dietary_needs[]" value="vegan" class="w-4 h-4 text-prep-green rounded">
                                <span class="ml-2 text-prep-text-dark">Vegan</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="dietary_needs[]" value="gluten-free" class="w-4 h-4 text-prep-green rounded">
                                <span class="ml-2 text-prep-text-dark">Gluten-Free</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="dietary_needs[]" value="keto" class="w-4 h-4 text-prep-green rounded">
                                <span class="ml-2 text-prep-text-dark">Keto</span>
                            </label>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-prep-text-dark mb-2">Difficulty Level</label>
                        <div class="flex gap-3">
                            <label class="flex-1">
                                <input type="checkbox" name="difficulty[]" value="1" class="hidden peer">
                                <div class="px-4 py-2 text-center border-2 border-prep-border-light rounded-lg peer-checked:border-prep-green peer-checked:bg-prep-green/10 cursor-pointer">Easy</div>
                            </label>
                            <label class="flex-1">
                                <input type="checkbox" name="difficulty[]" value="2" class="hidden peer">
                                <div class="px-4 py-2 text-center border-2 border-prep-border-light rounded-lg peer-checked:border-prep-green peer-checked:bg-prep-green/10 cursor-pointer">Medium</div>
                            </label>
                            <label class="flex-1">
                                <input type="checkbox" name="difficulty[]" value="3" class="hidden peer">
                                <div class="px-4 py-2 text-center border-2 border-prep-border-light rounded-lg peer-checked:border-prep-green peer-checked:bg-prep-green/10 cursor-pointer">Hard</div>
                            </label>
                        </div>
                    </div>
                    
                    <div class="flex gap-3 pt-4">
                        <button type="button" onclick="clearFilters()" class="flex-1 px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Clear All</button>
                        <button type="button" onclick="applyFilters()" class="flex-1 px-6 py-3 btn-prep-green text-white rounded-lg hover:opacity-90 transition">Apply Filters</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Store selected ingredients
        let selectedIngredients = [];
        
        // Toggle ingredient selection
        function toggleIngredient(element) {
            const ingredient = element.dataset.ingredient;
            
            if (element.classList.contains('active')) {
                element.classList.remove('active');
                selectedIngredients = selectedIngredients.filter(i => i !== ingredient);
            } else {
                element.classList.add('active');
                selectedIngredients.push(ingredient);
            }
            
            filterRecipes();
        }
        
        // Filter recipes based on selected ingredients
        function filterRecipes() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase().trim();
            const recipeCards = document.querySelectorAll('.recipe-card');
            
            // Split search term by comma and trim each ingredient
            const searchIngredients = searchTerm 
                ? searchTerm.split(',').map(item => item.trim()).filter(item => item.length > 0)
                : [];
            
            recipeCards.forEach(card => {
                const cardIngredients = card.dataset.ingredients.toLowerCase();
                
                // Check if card matches ALL search terms
                const matchesSearch = searchIngredients.length === 0 || 
                    searchIngredients.every(searchItem => cardIngredients.includes(searchItem));
                
                // Check if card matches selected ingredients (if any selected)
                const matchesIngredients = selectedIngredients.length === 0 || 
                    selectedIngredients.some(ing => cardIngredients.includes(ing.replace('-', ' ')));
                
                // Show card if it matches both search and ingredient filters
                if (matchesSearch && matchesIngredients) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
        
        // Search input handler
        document.getElementById('searchInput')?.addEventListener('input', filterRecipes);
        
        function openRecipeModal(recipeId) {
            document.getElementById('recipeModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            fetch(`/recipes/${recipeId}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            })
            .then(response => response.json())
            .then(data => {
                const modalContent = document.getElementById('modalContent');
                const recipe = data.recipe;
                
                const ingredientsHTML = recipe.ingredients?.length ? recipe.ingredients.map(ing => 
                    `<li class="flex items-start gap-2"><span class="text-prep-green">•</span><span>${ing.quantity} ${ing.unit} ${ing.name}</span></li>`
                ).join('') : '<li class="text-gray-500 italic">No ingredients listed</li>';
                
                const instructionsHTML = recipe.instructions?.length ? recipe.instructions.map((inst, idx) => 
                    `<li class="flex gap-3"><span class="flex-shrink-0 w-6 h-6 bg-prep-green text-white rounded-full flex items-center justify-center text-sm">${idx + 1}</span><span>${inst.step}</span></li>`
                ).join('') : '<li class="text-gray-500 italic">No instructions</li>';
                
                modalContent.innerHTML = `
                    <div class="space-y-6">
                        <div>
                            <h2 class="text-3xl font-bold text-prep-text-dark mb-2">${recipe.name}</h2>
                            <p class="text-prep-text-light">${recipe.description || 'No description'}</p>
                        </div>
                        <div class="flex gap-6 text-sm text-prep-text-muted">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>${recipe.prep_time || '30'} min</span>
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 gap-8">
                            <div>
                                <h3 class="text-xl font-semibold text-prep-text-dark mb-3">Ingredients</h3>
                                <ul class="space-y-2">${ingredientsHTML}</ul>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-prep-text-dark mb-3">Instructions</h3>
                                <ol class="space-y-3">${instructionsHTML}</ol>
                            </div>
                        </div>
                    </div>
                `;
            })
            .catch(() => closeRecipeModal());
        }
        
        function closeRecipeModal() {
            document.getElementById('recipeModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        function openFilterModal() {
            document.getElementById('filterModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        function closeFilterModal() {
            document.getElementById('filterModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        function clearFilters() {
            document.getElementById('filterForm').reset();
            applyFilters();
        }
        
        function applyFilters() {
            const form = document.getElementById('filterForm');
            const formData = new FormData(form);
            const params = new URLSearchParams(formData);
            window.location.href = `/home?${params.toString()}`;
        }
        
        function toggleFavorite(recipeId, button) {
            fetch(`/api/recipes/${recipeId}/favorite`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const svg = button.querySelector('svg');
                    if (data.isFavorite) {
                        svg.classList.add('fill-current', 'text-red-500');
                    } else {
                        svg.classList.remove('fill-current', 'text-red-500');
                    }
                }
            });
        }
        
        document.getElementById('recipeModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeRecipeModal();
        });
        
        document.getElementById('filterModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeFilterModal();
        });
        
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeRecipeModal();
                closeFilterModal();
            }
        });
    </script>
</body>
</html>