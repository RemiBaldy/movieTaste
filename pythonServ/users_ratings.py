import utils

"""	Renvoie la liste des identifiants des films qui ont été notés
	par les deux utilisateur X et Y

	Paramètres nommés :
		X -- Utilisateur (représenté par les films qu'il a noté sous la forme d'un dictionnaire {id_movie : rating} )
		Y -- Utilisateur (représenté par les films qu'il a noté sous la forme d'un dictionnaire {id_movie : rating} )
	Paramètres retournés :
		inters -- 	Liste contenant les identifiants des films qui ont été notés par X et par Y"""


def get_same_rated_movies(X, Y):
    """
    La méthode list(dict) retoune sous forme de listes les clés du dictionnaires dict. Ici, il s'agit donc d'identifiants de films.
    """
    X_ids_movies = list(X)
    Y_ids_movies = list(Y)

    inters = utils.intersection(X_ids_movies, Y_ids_movies)

    return inters


"""	Détermine sur quels films la prédiction de note est à faire, c'est à dire ceux que n'a pas vu l'utilisateur.

	Paramètres nommés :
		X -- Utilisateur (représenté par les films qu'il a noté sous la forme d'un dictionnaire {id_movie : rating} )
		ids_movies -- Liste de tous les identifiants des films de la base de donnée.

	Paramètres retournés :
		return -- La liste des identifiants des films à noter [id_movie]
"""


def get_movies_to_rate(X, ids_movies):
    """	Le dictionnaire représentant l'utilisateur X étant de la forme {id_movie : rating},
        la méthode X.keys() renvoie la liste des des id_movie notés par l'utilisateur.
    """
    return X.keys() ^ ids_movies



"""	Détermine quel utilisateurs ont noté le film n°id_movie.

	Paramètres nommés :
		users_ratings -- Dictionnaire contenant toutes les notes attribuées par les utilisateurs de la forme {id_user:{id_movie:rating}} 
		id_movie -- Identifiant du film que les utilisateurs doivent avoir noté.

	Paramètres retournés :
		res --  Un dictionnaire de la forme {id_user : {id_movie : rating} contenant les utilisateurs qui ont vu le film n°id_movie.
		        (Attention , le dictionnaire représentant chaque utilisateur ne contient pas uniquement la note 
		        pour le film id_movie mais bien tout les autres. )
"""

def get_users_ratings_for_movie(users_ratings, id_movie):
	res = {}

	for key, value in users_ratings.items():
		if id_movie in value:
			res[key] = value

	return res
