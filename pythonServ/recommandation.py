import user_item_recommandation as uir
from Data_Handling import loader_from_json as loader
import sys

"""On charge les notes"""
users_ratings = loader.load_users_ratings()

"""On charge la liste complète des films"""
ids_movies = loader.load_movies_ids()

"""On récupére l'id qui a été passé en arguement"""
id_user = sys.argv[1]

"""	On récupère l'utilisateur qui est repésenté par un dictionaire, contenant l'ensemble des notes
    qu'il a attribuées, de la forme {id_movie : rating}"""
X = loader.get_user_ratings(id_user)

"""On retire les notes de l'utilisateur de l'ensemble pour ne pas biaiser les résultats"""
users_ratings.pop(id_user, -1)

""" On récupére les identifiants des films les plus suceptible d'etre apprécié par l'utilisateur"""
predictions = uir.predict(X, users_ratings, ids_movies)

"""On les affiche sur la sortie standard """
print(predictions)
