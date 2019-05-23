"""
    Ce fichier contient diverses méthodes manipulant des listes et des dictionnaires
"""

"""	Renvoie l'intersection de deux listes sous forme de liste.

	Paramètres nommés :
		lst1 -- Premiere liste
		lst2 -- Deuxieme liste
	Paramètres retournés :
		lst_inters -- Intersection de lst1 et lst2.
"""

def intersection(lst1, lst2):
    lst_inters = [value for value in lst1 if value in lst2]
    return lst_inters


"""	Retourne une liste triée de la forme [(key,value)]

	Paramètres nommés :
		dict -- Dictionnaire de la forme {key : value} où value doit être une valeure numérique.

	Paramètres retournés :
		list_sorted -- 	Liste contenant les éléments du dictionnaire et triée en fonction des valeurs "value".
						La raison pour laquelle on renvoie une liste et non un dictionnaire est qu'il n'existe pas de fonction efficace de trie sur les valeurs d'un dictionnaire.
						On pourrait reconvertir la liste en dictionnaire mais on perdrait alors en efficacité. 
"""


def sorted_dict(dict):
    list_sorted = sorted(dict.items(), key=lambda t: t[1])
    list_sorted.reverse()
    return list_sorted


"""	Retourne une liste triée de la forme [key]

	Paramètres nommés :
		dict -- Dictionnaire de la forme {key : value} où value doit être une valeure numérique.

	Paramètres retournés :
		list_sorted -- 	Liste contenant les clés du dictionnaire triée en fonction des valeurs "value".
"""


def sorted_dict_key_by_value(dict):
    list_sorted = sorted_dict(dict)
    return [str(id_movie[0]) for id_movie in list_sorted]