import mysql.connector as sql
import json

"""Variable globales contenant les noms des tables et variables SQL. Si on change de base on ne change que ces variables"""
id_movie_sql = "movieId"
id_users_sql = "userId"
rating_sql = "rating"
users_ratings_table_sql = "ratingsSmall"
ids_movies_table_sql = "moviesSmall"

def load_users_ratings(cursor):
    """On fait la requete pour les notes de l'utilisateur."""
    request = "SELECT "+id_users_sql+","+id_movie_sql+","+rating_sql+" FROM "+users_ratings_table_sql
    cursor.execute(request)

    """On récupère la réponse qui est sous forme de liste"""
    users_ratings_list = cursor.fetchall()

    users_ratings_dict = {}

    for user_rating in users_ratings_list:
        id_user = user_rating[0]
        id_movie = user_rating[1]
        rating = user_rating[2]

        """ On vérifie si l'utilisateur est dans le dictionnaire, sinon on le créé"""
        if id_user in users_ratings_dict:
            users_ratings_dict[id_user][id_movie] = rating
        else:
            users_ratings_dict[id_user] = {id_movie: rating}

    return users_ratings_dict

def load_movies_id(cursor):
    """On fait la requete pour les identifiants des films."""
    request = "SELECT " + id_movie_sql + " FROM " + ids_movies_table_sql
    cursor.execute(request)
    movies = cursor.fetchall()
    
    """On convertit la liste renvoyée par la requete sql au bon format.
        Est équivalent à 
        res = []
        for sublist in movies:
            for item in sublist:
                res.append(item)
        movies = res
    """
    movies = [item for sublist in movies for item in sublist]
    return movies

def convert_to_json():
    """ On établit une connection avec la base de donnée sql"""

    connection = sql.connect(host="51.38.69.145", port="63306",
                                   user="damathieu", password="DBueihtamad",
                                   database="movieWebsite")

    """On récupère la réponse qui est sous forme de liste"""
    cursor = connection.cursor()

    """On convertit les données et on les enregistre au format json"""

    users_ratings_dict = load_users_ratings(cursor)
    with open('../Data/users_ratings.json', 'w') as file:
        json.dump(users_ratings_dict, file)

    movies = load_movies_id(cursor)
    with open('../Data/movies_ids.json', 'w') as file:
        json.dump(movies, file)

    connection.close()

convert_to_json()