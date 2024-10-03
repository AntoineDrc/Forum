## Définir faille XSS, comment s'ne prémunir en dehors des filter input
    - Echapper les caractères en utilisant des foncions comme htmlspecialchars qui transformes les caractères spéciaux, pour qu'ils soient afficher comme du texte.
    - Eviter les scripts inline (JS inséré dans des balises HTML via des attributs), utiliser plutot des gestionnaires d'évènement JS.
    - Mettre en place une Content Security Police (CSP) :
        • Dans l'en-tête d'une requête HTTP
        • Avec la fonction header() en php
        • Dans la balide <meta> dans le fichier html



## Pourquoi on utilise password hash, pourquoi Bcrypt est utilisé par defaut
    - Password hash est utilisé pour hasher les mdp afin qu'ils ne soient pas stockés dans leur valeur d'origine. Le hashage transforme un mdp en chaîne de caractère illisible, et ne peut pas $etre convertie en texte clair.

    - Bcrypt est un algorithme spécialement conçu pour le hachage sécurisé de mdp et il est utilisé par défaut car :
        • Résiste au attaques BrutForce, algorithme lourd en termes de calcul, ce qui signifie qu'il rend plus difficile à un attaquant de tester un grand nombre de mdp.
        • Inclut automatiquement le "sel" (données ajoutées aléatoirement au mdp) ce qui rend le mdp unique.
        • Ajustable, on peut complexifié le calcul du hashage, pour plus de sécurité à mesure de l'évolution de la puissance des ordinateurs.