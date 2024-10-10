// Attend que le document soit entièrement chargé
document.addEventListener('DOMContentLoaded', function()
{

    // Sélectionne l'icône burger et le menu
    const burger = document.querySelector('.burger');
    const nav = document.getElementById('nav');

    // Ajoute un écouteur d'évènements sur l'icône burger
    burger.addEventListener('click', function()
    {
        // Ajoute ou retire la classe "open" pour afficher / cacher le menu
        nav.classList.toggle('open');
    });

    // Selectionne l'image de corbeille
    const trash = document.querySelectorAll('.delete-post');

    trash.forEach(function(link)
    {
        link.addEventListener('click', function(event)
        {
        // Affiche la confirmation
        const confirmation = confirm("Êtes-vous sûr de vouloir supprimer ce post ?");

            // Si annulé, empêche l'action 
            if (!confirmation)
            {
                event.preventDefault();
            }
        });
    });
});