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

    // Selectionne le lien href de suppression de post
    const trashP = document.querySelectorAll('.delete-post');

    trashP.forEach(function(postLink)
    {
        postLink.addEventListener('click', function(event)
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

    // Selectionne le lien href de suppression de topic 
    const trashT = document.querySelectorAll('.delete-topic')
    
    trashT.forEach(function(topicLink)
    {
        topicLink.addEventListener('click', function(event)
            {
                // Affiche message de confirmation 
                const confirmation = confirm('Êtes-vous sûr de vouloir supprimer ce topic ?');

                // Si annulé, empêche l'action 
                if (!confirmation)
                {
                    event.preventDefault();
                }
            });
    });

    // Selection le lien href de suppression de compte 
    const acc = document.querySelector('.delete-acc')

    acc.addEventListener('click', function(accLink)
    {
        const confirmation = confirm('Êtes-vous sûr de vouloir supprimer votre compte');

        if (!confirmation)
        {
            accLink.preventDefault();
        }
    });
});