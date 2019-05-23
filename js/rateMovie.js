/**
 * Created by moi on 17/05/2019.
 */
function applyRateProperties(options, movieId){
    $(".rate"+movieId).rate(options);
    $(".rate"+movieId).rate("setAdditionalData", {movieId: movieId});
    console.log(".rate"+movieId);
}

function setRateProperties(movieId) {
    var options = {
        max_value: 5,
        step_size: 0.5,
        initial_value: 0,
        selected_symbol_type: 'utf8_star', // Must be a key from symbols
        cursor: 'default',
        readonly: false,
        change_once: false, // Determines if the rating can only be set once
        ajax_method: 'POST',
        url: '../php/addRating.php',
        additional_data: {} // Additional data to send to the server
    }
    applyRateProperties(options, movieId);
}
function setRatePropertiesWithValue(movieId, value) {
    var options = {
        max_value: 5,
        step_size: 0.5,
        initial_value: value,
        selected_symbol_type: 'utf8_star', // Must be a key from symbols
        cursor: 'default',
        readonly: false,
        change_once: false, // Determines if the rating can only be set once
        ajax_method: 'POST',
        url: '../php/addRating.php',
        additional_data: {} // Additional data to send to the server
    }
    applyRateProperties(options, movieId);
}
