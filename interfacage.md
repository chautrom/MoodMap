
# Interfaçage Application mobile -> Serveur PHP
## **/createUser** - POST - Creation d'un utilisateur
## Paramètres :
 string name : nom de l'utilisateur
 
 string hashPassword : haché du mot de passe
 
 string email : adresse mail
 
## Retour : 
 objet JSON : {"erreur":"false", "content":{objet User créé}} ou {"erreur":"true", "message":"message d'erreur"}


## **/validateUser** - POST - Validation du challenge (seconde étape de création d'un utilisateur)
## Paramètres :
 entier idUser : identifiant de l'utilisateur
 
 string challenge : challenge à vérifier
## Retour : 
 objet JSON : {"erreur":"false", "content":{objet User validé}} ou {"erreur":"true", "message":"message d'erreur"}


## **/connectUser** - GET - Connexion d'un utilisateur
## Paramètres au format JSON :
 string email : email de l'utilisateur
 
 string hashPassword : haché du mot de passe
## Retour : 
 objet JSON : {"erreur":"false", "content":{objet User connecté}} ou {"erreur":"true", "message":"message d'erreur"}


## **/getModifiedItinerary** - POST - Recuperation d'un itinéraire émotionnel
## Paramètres au format JSON :
 float xA : abscisse A
 
 float yA : ordonnée A
 
 float xB : abscisse B
 
 float yB : ordonnée B
 
 liste des waypoints : lWaypoints
 
 string h : humeur
 
## Retour : 
 objet JSON : {"erreur":"false", "content":{liste des waypoints modifiée}} ou {"erreur":"true", "message":"message d'erreur"}

## **/createVote** - POST - Ajouter une évaluation sur un critère
## Si une evaluation existe 
## Paramètres au format JSON :
 entier userId : identifiant de l'utilisateur
 
 float  x : abscisse du point
 
 float  y : ordonnée du point
 
 entier idCriteria : identifiant du critère
 
 entier score : score associé au vote
 
## Retour : 
 objet JSON : {"erreur":"false", "content":{objet User connecté}} ou {"erreur":"true", "message":"message d'erreur"}


## **/updateVote**- POST - Modifier l'évaluation d'identifiant ie (note)
## Paramètres au format JSON :
 entier userId : identifiant de l'utilisateur
 
 entier idVote : identifiant du vote à modifier
 
 entier idCriteria : identifiant du critère du vote à modifier
 
 entier score : nouveau score 
 
## Retour : 
 objet JSON : {"erreur":"false", "content":{liste des votes}} ou {"erreur":"true", "message":"message d'erreur"}
 

## **/getAllVotesFrom()** - GET - Récupérer toutes les évaluations d'un utilisateur
## Paramètres au format JSON :
 entier userId : identifiant de l'utilisat*
## Retour : 
 objet JSON : {"erreur":"false", "content":{liste des votes}} ou {"erreur":"true", "message":"message d'erreur"}
 
