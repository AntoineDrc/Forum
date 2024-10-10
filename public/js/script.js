// Sélectionne l'icône burger et le menu
const burger = document.querySelector('.burger');
const nav = document.getElementById('nav');

// Ajoute un écouteur d'évènements sur l'icône burger
burger.addEventListener('click', function()
{
    // Ajoute ou retire la classe "open" pour afficher / cacher le menu
    nav.classList.toggle('open');
});