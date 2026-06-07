# Mediatekformation

## Présentation
Ce site développé avec Symfony met à disposition des vidéos de formations et exploite une BDD mySQL. Il est accessible à l'adresse suivante : https://mediatekformation.kesug.com/ (ajoutez "/admin" à la fin de l'url pour accéder à la partie back-office). La documentation technique est accessible depuis ce lien : https://mediatekformation.kesug.com/mediatekformation_doc/ . Ce readme présente les fonctionnalités ajoutées (back-office), consultez le dépot d'origine avec la présentation du front-office : https://github.com/CNED-SLAM/mediatekformation<br> Le back-office reprend la charte graphique du front-office ainsi que les fonctionnalités de tri.
<br>
## Missions effectuées
• Nettoyage et optimisation du code existant<br>
• Création de la partie back-office<br>
• Tests et documentation<br>
• Déploiement en ligne du site<br>
### Page 1 : Authentification
Cette page permet de s'authentifier afin d'accéder à la partie back-office. Après connexion, sur chaque page s'affichera un lien permettant de se déconnecter. <br> <img width="1690" height="518" alt="Capture d’écran 2026-05-30 153746" src="https://github.com/user-attachments/assets/7e3373e0-a4b4-457d-9803-49a4f024874a" />
### Page 2 : Administation des formations
Cette page est la première accessible après connexion. ELle contient un tableau présentant les formations ainsi que des fonctionnalités de tris, comme sur le front. <img width="1648" height="860" alt="pageformation" src="https://github.com/user-attachments/assets/3a322fc4-719b-4887-bc03-430dc93b4c39" />En haut à droite le bouton "Nouvelle formation" permet d'accéder au formulaire qui permet d'ajouter une formation dans la BDD. Il est possible de sélectionner plusieurs catégories avec la touche CTRL. <img width="1691" height="862" alt="NouvelleFormation" src="https://github.com/user-attachments/assets/013228ff-2612-4342-aafa-56210456e1dc" />

Chaque ligne d'une formation contient deux boutons : "supprimer" et "modifier". Le clic sur le bouton "supprimer" (après confirmation) déclenche la suppression d'une formation dans la BDD, elle est également supprimée de sa playlist.

Le bouton "modifier" permet d'accéder au formulaire de modification d'une formation. <img width="1679" height="862" alt="modif" src="https://github.com/user-attachments/assets/3eaffac9-0c57-4f9d-9ac0-a7975c4bbbc1" />


### Page 3 : Administration des playlists
Cette page affiche également un tableau avec fonctions de tris, présentant les playlists de formations. Comme pour la page des formations, il est possible de supprimer, modifier ou ajouter une playlist via les boutons. <img width="1677" height="825" alt="administration" src="https://github.com/user-attachments/assets/7a84d8e5-9869-4cb8-b5e5-05d113ddc4cb" />

### Page 4 : Administration des catégories
Cette page se divise en deux parties. A gauche apparaît un tableau avec les catégories et un bouton permettant de supprimer la catégorie de la BDD. A droite, un formulaire permet d'ajouter une catégorie dans la BDD en entrant son nom (la catégorie ne doit pas déjà exister).<img width="1683" height="861" alt="categorie" src="https://github.com/user-attachments/assets/e39eef18-0b69-40ba-bee1-04c012416e3e" />


## Test de l'application en local
- Vérifier que Composer, Wampserver (ou équivalent) sont installés sur l'ordinateur.
- Télécharger le code et le dézipper dans www de Wampserver (ou dossier équivalent) puis renommer le dossier en "mediatekformation".<br>
- Ouvrir une fenêtre de commandes en mode admin, se positionner dans le dossier du projet et taper "composer install" pour reconstituer le dossier vendor.<br>
- Dans phpMyAdmin, se connecter à MySQL en root.
- Récupérer le fichier mediatekformation.sql en racine du projet et l'utiliser pour remplir la BDD.<br>
- De préférence, ouvrir l'application dans un IDE professionnel. L'adresse pour la lancer est : http://localhost/mediatekformation/public/index.php<br>
