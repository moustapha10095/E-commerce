
Design

agencement des classes :
Contrôleur :

- Account : Gère les inscriptions et la sécurité du site web
- Admin : Gère la partie admin du site (ajout d’articles, ajout de catégorie d’articles ...)
- Cart : Gère le panier des clients(ajout de nouveaux articles suppression d’articles ...)
- CGU : Gère les conditions d’utilisations du site web
- Stripe : Gère les ordres d’achats
- ContactController : Gère les contacts mail du site
- DataLoaderController: Gère l’affichage des articles du site
- Home Controller : Permet d’afficher la page d’accueil du site

Templates :

- account : page donnant les ordres d’achats des comptes
- address :page affichant les coordonnées d’un fournisseur
- bundles\TwigBundle\Exeption : page de messages d’erreurs
- cart: page  d’affichage d’un panier
- cgu : page  de conditions générales d’utilisation
- checkout : page  pour confirmer de paiement
- contacts:page pour contacter l’admin
- home: page d’accueil 
- partials : élément partiel commun à plusieurs pages
- registration:page d’inscription
- rest_password : page pour réinitialiser les identifiants clients
- scurity:page pour l’inscription
- stripe:page pour le paiement

Entity

- Adresse: coordonnées clients
- Carrier : données fournisseurs
- Cart : donnée panier
- CartDetails : donnée panier détaillée
- Categories : donnée catégorie
- Contact : donnée contact
- EmailModel : donnée mail
- HomeSlider : donnée page d’accueil
- Order :donnée ordre d’achat
- OrderDetails :donnée ordre d’achat détaillé	
- Product :Donnée produit
- RestPasswordRequest : Requete mise à jour identifiant
- ReviewsProduct :Donnée commentaire
- SearchProduct :Donnée recherche produit
- User :Donnée utilisateur


                  Diagramme d’utilisation

![image](https://user-images.githubusercontent.com/55878870/124014182-7d6c8680-d9e3-11eb-9a39-523b35bb021b.png)
