function setDeleteActions(movieId){

    $('#delete'+movieId).click(function(){
        $.ajax({
            type: "post",
            url: "../php/deleteRating.php",
            dataType: 'json',
            data: {id: movieId},
        });
    });
}