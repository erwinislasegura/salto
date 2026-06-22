
const SITE_WHATSAPP = "56900000000";
const menuBtn=document.querySelector('[data-menu]');
const nav=document.querySelector('.navlinks');
if(menuBtn&&nav){menuBtn.addEventListener('click',()=>nav.classList.toggle('open'));}
document.querySelectorAll('.navlinks a').forEach(a=>a.addEventListener('click',()=>nav&&nav.classList.remove('open')));
function wa(msg){window.open(`https://wa.me/${SITE_WHATSAPP}?text=${encodeURIComponent(msg)}`,'_blank')}
document.querySelectorAll('[data-wa]').forEach(btn=>btn.addEventListener('click',()=>wa(btn.dataset.wa)));
const tabs=document.querySelectorAll('[data-filter]');
const cards=document.querySelectorAll('[data-category]');
function filterCards(f){cards.forEach(c=>{const cats=(c.dataset.category||'').split(' '); c.style.display=(f==='all'||cats.includes(f))?'block':'none';});tabs.forEach(t=>t.classList.toggle('active',t.dataset.filter===f));}
tabs.forEach(t=>t.addEventListener('click',()=>filterCards(t.dataset.filter)));
const quick=document.getElementById('quickFilter');
if(quick){quick.addEventListener('change',()=>{filterCards(quick.value);document.getElementById('destacados')?.scrollIntoView({behavior:'smooth'});});}
const form=document.getElementById('registerForm');
if(form){form.addEventListener('submit',e=>{e.preventDefault();const data=new FormData(form);let txt='Hola, quiero registrar un negocio en Saltos del Laja Turístico:%0A%0A';for(const [k,v] of data.entries()){txt+=`${k}: ${v}%0A`;}window.open(`https://wa.me/${SITE_WHATSAPP}?text=${txt}`,'_blank');});}


// Tracking simple de clics comerciales sin backend: permite medir intención en Analytics si se agrega luego.
document.querySelectorAll('.whatsapp-float,[data-wa]').forEach(el=>{
  el.addEventListener('click',()=>{
    try{window.dataLayer=window.dataLayer||[];window.dataLayer.push({event:'whatsapp_click',source:el.classList.contains('whatsapp-float')?'floating':'button'});}catch(e){}
  });
});


// Slider de portada: temporada + experiencia turística
const heroSlides = document.querySelectorAll('.hero-slide');
const heroDots = document.querySelectorAll('.hero-dot');
let heroIndex = 0;
function setHeroSlide(index){
  if(!heroSlides.length) return;
  heroIndex = (index + heroSlides.length) % heroSlides.length;
  heroSlides.forEach((slide,i)=>slide.classList.toggle('active', i === heroIndex));
  heroDots.forEach((dot,i)=>dot.classList.toggle('active', i === heroIndex));
}
heroDots.forEach(dot=>dot.addEventListener('click',()=>setHeroSlide(Number(dot.dataset.slide||0))));
if(heroSlides.length > 1){
  setInterval(()=>setHeroSlide(heroIndex + 1), 6500);
}
