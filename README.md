# MoodMap
*Follow your emotions*


## Interfaçage Application mobile - Serveur PHP
### GET - Creation d'un utilisateur
createUser(user, hashPassword, email)

### GET - Connexion d'un utilisateur
connectUser(user, hashPassword)

### GET - Recuperation de la carte OSM basique
getBasicOSMap()

### GET - Recuperation de la carte emotionnelle
getMoodOSMap()

### GET - Recuperation d'un itinéraire basique entre les points A et B
getOSMItinierary(A, B)

### GET - Recuperation d'un itinéraire émotionnel entre les points A et B selon l'humeur h
getOSMItinierary(A, B, h)

### POST - Ajouter une évaluation (note) du critère c sur le point de coordonnées x et y
addReview(c, x, y, note)
