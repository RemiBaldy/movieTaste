import math
import utils
import users_ratings as ur
import cosinus as c

"""	Prédit la note qu'un utilisateur mettrait au film n°id_movie.
	
	Cette note est calculée à partir d'une formule mathématique qui prend en compte l'indice de similarité
	cosinus des autres utilisateurs et la note qu'ils ont attribuée au film n°id_movie.
	
	
	Paramètres nommés :
		id_movie -- Identifiants du film dont il faut prédir la note.
		cosinus -- 	Liste, de dimension N * 2, contenant les N indices de similarité cosinus les plus proches de 1
					de la forme [(id_user,simil_cosinus)]
		users_rating -- Contient la liste des utilisateurs qui ont noté le film n°id_movie

	Paramètres retournés :
		return -- La prédiction de la note ou -1 si aucun utilisateur de users_rating n'a noté le film n°id_movie
"""
def predict_rating(id_movie,cosinus,users_ratings):
	sum1 = 0.0
	sum2 = 0.0

	"""	Onn récupére uniquement les utilisateurs qui ont vu le film n°id_movie"""
	users_ratings = ur.get_users_ratings_for_movie(users_ratings, id_movie)

	for value in cosinus:
		id_user = value[0]
		if id_user in users_ratings:
			cos_X_Y = value[1]

			sum1 = sum1 + cos_X_Y * (users_ratings[id_user][id_movie])

			sum2 = sum2 + math.fabs(cos_X_Y)

	if sum1 != 0 and sum2 != 0:
		return sum1/sum2
	else:
		return -1


"""	Détermine quels sont les films les plus suceptibles d'etre apprécié par l'utilisateur X.

	Paramètres nommés :
		X -- Utilisateur (représenté par les films qu'il a noté sous la forme d'un dictionnaire {id_movie : rating} )
		users_ratings -- Dictionnaire contenant toutes les notes attribuées par les utilisateurs de la forme {id_user:{id_movie:rating}} 
		ids_movies -- Liste de tous les identifiants des films de la base de donnée.
	Paramètres retournés :
		return -- La liste des identifiants des films les plus suceptibles d'etre apprécié par l'utilisateur X, de la forme [id_movie]
"""
def predict(X, users_ratings, ids_movies):
	""" On récupére tous les indices de similarité cosinus de X avec les 100 utilisateurs lui ressemblant le plus"""
	cosinus = c.compute_cos(X, users_ratings, 100)

	"""On récupère la liste des films sur les quels ont va faire une prédiction"""
	ids_movies_to_rate = ur.get_movies_to_rate(X,ids_movies)

	res = {}

	for id_movie in ids_movies_to_rate:
		"""	Pour chacun de ces films, on prédit la note que l'utilisateur X pourrait lui mettre """
		prediction = predict_rating(id_movie, cosinus, users_ratings)

		if prediction > -1:
			"""	Si on a pu faire une prédiction, on l'associe a l'identifiant du film. """
			res[id_movie] = prediction

	"""	On trie les résultats obtenus pour établir un ordre de préférence. 
		On ne garde que les  150 premières cles, à savoir les identifiants des films """
	res = utils.sorted_dict_key_by_value(res)
	return res[:150]

