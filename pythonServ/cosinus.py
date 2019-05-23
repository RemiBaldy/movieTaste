import users_ratings as ur
import math
import utils

"""	Calcul et renvoie l'indice de similarité cosinus entre deux utilisateurs X et Y

	Paramètres nommés :
		X -- Utilisateur (représenté par les films qu'il a noté sous la forme d'un dictionnaire {id_movie : rating} )
		Y -- Utilisateur (représenté par les films qu'il a noté sous la forme d'un dictionnaire {id_movie : rating} )

	Paramètres retournés :
		return -- 	Résultat d'une formule mathématiques qui prend en compte les films notés par deux utilisateurs.
				    Plus ce résultat est proche de 1, plus deux utlisateur se ressemble (en se basant sur les notes qu'ils ont données.
				    Retourne 0 si un utilisateur est vide.
	"""


def cos(X, Y):
    keys = ur.get_same_rated_movies(X, Y)

    sum1 = 0.0
    sum2 = 0.0
    sum3 = 0.0

    for key in keys:
        sum1 = sum1 + X[key] * Y[key]

    for val in X.values():
        sum2 = sum2 + math.pow(val, 2)

    for val in Y.values():
        sum3 = sum3 + math.pow(val, 2)
    if sum2 != 0 and sum3 != 0:
        return sum1 / math.sqrt(sum2 * sum3)
    return 0


"""	Calcule l'indice de similarité cosinus entre l'utilisateur X et tout les autres utilisateurs 

	Paramètres nommés :
		X -- Utilisateur (représenté par les films qu'il a noté sous la forme d'un dictionnaire {id_movie : rating} )
		users_ratings -- Dictionnaire contenant toutes les notes attribuées par les utilisateurs de la forme {id_user:{id_movie:rating}}
		N -- Nombre d'utlisateurs les plus ressemblant à X à renvoyer.

	Paramètres retournés :
		res -- Dictionnaires contenant les résultats de la forme {user_id : cosinus(X,users_ratings[user-id])}
"""


def compute_cos(X, users_ratings, N):
    res = {}

    for key, Y in users_ratings.items():
        res[key] = cos(X, Y)

    res = utils.sorted_dict(res)
    return res[:N]
