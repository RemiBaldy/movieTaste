import user_item_recommandation as uir
from Data_Handling import loader_from_json as loader
import users_ratings as ur
import math
import cosinus

def MAN(users_ratings, users_ratings_prediction):
    length = len(users_ratings)
    if(length != len(users_ratings_prediction)):
        print("error")
        return -1
    sum = 0.0

    for id_user, rating in users_ratings:
        sum = sum + math.fabs(rating - users_ratings_prediction[id_user])

    return sum/length

def make_prediction_for_movie(users_ratings,N,id_movie,entire_users_ratings):
    res = {}
    for id_user in users_ratings:
        cosinus = cosinus.compute_cos(entire_users_ratings[id_user], users_ratings, N)
        res[id_user] = uir.predict_rating(id_movie,cosinus,entire_users_ratings)
    return res
def get_10(users_rating):
    length = len(users_rating)
    index = 0

    res = {}
    for id_user, rating in users_rating:
        if(0.1 < index/length):
            break
        res[id_user] = rating
        users_rating.pop(id_user)
    return users_rating,res

def predicition_for_movie(users_ratings,id_movie):
    users_ratings = ur.get_users_ratings_for_movie(users_ratings,id_movie)

    train,test = get_10(users_ratings)



    return users_ratings

users_ratings = loader.load_users_ratings()
print(predicition_for_movie(users_ratings,4427))