const sampleRecipes = [
  {id:1,title:"Spicy Tomato Pasta",image:"https://images.unsplash.com/photo-1523986371872-9d3ba2e2f642?q=80&w=1200&auto=format&fit=crop",time:"25 min",difficulty:"Easy",tags:["pasta","vegetarian"]},
  {id:2,title:"Honey Garlic Salmon",image:"https://images.unsplash.com/photo-1512058564366-c9e3f4d3b0a7?q=80&w=1200&auto=format&fit=crop",time:"30 min",difficulty:"Medium",tags:["fish","gluten-free"]},
  {id:3,title:"Avocado Toast Deluxe",image:"https://images.unsplash.com/photo-1551183053-bf91a1d81141?q=80&w=1200&auto=format&fit=crop",time:"10 min",difficulty:"Easy",tags:["breakfast","vegan"]}
];

function escapeHtml(s=''){return String(s).replaceAll('&','&amp;').replaceAll('<','&lt;').replaceAll('>','&gt;').replaceAll('"','&quot;').replaceAll("'",'&#039;');}

function createCard(recipe){
  const card=document.createElement('article');card.className='card';
  card.innerHTML=`
    <img src="${recipe.image}" alt="${escapeHtml(recipe.title)}">
    <div class="card-body">
      <h2 class="card-title">${escapeHtml(recipe.title)}</h2>
      <div class="card-meta small">${escapeHtml(recipe.time)} • ${escapeHtml(recipe.difficulty)}</div>
      <div class="tags">${recipe.tags.map(t=>`<span class="tag">${escapeHtml(t)}</span>`).join('')}</div>
    </div>
    <div class="card-footer">
      <button class="btn" data-id="${recipe.id}">View</button>
      <button class="btn secondary small" data-id="${recipe.id}">Save</button>
    </div>`;
  return card;
}

function renderRecipes(recipes){
  const grid=document.getElementById('recipe-grid');grid.innerHTML='';
  if(!recipes||recipes.length===0){grid.innerHTML='<p class="small">No recipes found.</p>';return;}
  const frag=document.createDocumentFragment();recipes.forEach(r=>frag.appendChild(createCard(r)));grid.appendChild(frag);
}

document.addEventListener('DOMContentLoaded',()=>{
  const data = (typeof window.recipes !== 'undefined') ? window.recipes : sampleRecipes;
  renderRecipes(data);
  document.getElementById('recipe-grid').addEventListener('click', e=>{
    const btn = e.target.closest('button'); if(!btn) return;
    const id = btn.dataset.id;
    if(btn.textContent.trim()==='View'){ window.location.href = `recipe.php?id=${encodeURIComponent(id)}`; }
    else { btn.textContent='Saved'; btn.disabled=true; }
  });
});