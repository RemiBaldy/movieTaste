import json
import mysql.connector as sql

"""Variable globales contenant les noms des tables et variables SQL. Si on change de base on ne change que ces variables"""
id_movie_sql = "movieId"
id_users_sql = "userId"
rating_sql = "rating"
users_ratings_table_sql = "ratingsSmall"



"""	Crée un dictionnaire de la forme {id_user:{id_movie:rating}} à partir du fichier json.

	Paramètres retournés :
		users_ratings_dict -- Dictionnaire contenant toutes les notes attribuées par les utilisateurs de la forme {id_user:{id_movie:rating}} 
"""
def load_users_ratings():
    with open('./Data/users_ratings.json') as users_ratings_json:
        users_ratings_dict = json.load(users_ratings_json)

    users_ratings_dict = {int(k): {int(key): float(value) for key, value in v.items()} for k, v in users_ratings_dict.items()}

    return users_ratings_dict

"""	Crée une liste  contenant les identifiants de tous les films de la base de donnée à partir du fichier json.

	Paramètres retournés :
		ids_movies -- Liste de tous les identifiants des films de la base de donnée de la forme [id_movies]. 
"""
def load_movies_ids():
    with open('./Data/movies_ids.json', 'r') as movies_ids_json:
        movies_ids = json.load(movies_ids_json)
    return movies_ids


"""	Récupère à partir de la base sql les note qu'un utilisateur à donné. 
    
    Paramètres nommés :
		id_user -- identifiant de l'utilisateur dont on veut récupérer les notes 
    
	Paramètres retournés :
		ids_movies -- Liste de tous les identifiants des films de la base de donnée de la forme [id_movies]. 
"""
def get_user_ratings(id_user):
    """ On établit une connection avec la base de donnée sql"""
    connection = sql.connect(host="51.38.69.145", port="63306",
                       user="damathieu", password="DBueihtamad",
                       database="movieWebsite")

    """ On récupère un objet (cursor) pour pouvoir faire des requete et récupérer les réponse. """
    cursor = connection.cursor()

    """On fait la requete pour les notes de l'utilisateur."""
    request = "SELECT "+ id_movie_sql+","+rating_sql+" FROM "+users_ratings_table_sql+" WHERE "+id_users_sql+" = " + str(id_user)
    cursor.execute(request)

    """On récupère la réponse qui est sous forme de liste"""
    user_ratings = cursor.fetchall()

    """On convertit la liste en dictionnaire renvoyé par la requete sql au bon format.
            Est équivalent à 
            res = {}
            for id_movie,rating in user_rating:
                res[id_movie] = rating
            user_rating = res
        """
    user_ratings = {int(id_movie): float(rating) for id_movie, rating in user_ratings}

    connection.close()
    return user_ratings

