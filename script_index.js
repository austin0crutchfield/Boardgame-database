window.onload = function() {

    // toggle addgame
    document.getElementById("addgame-button").onclick = function() {
        document.getElementById("newgame-form").style.display =
            (document.getElementById("newgame-form").style.display == "block") ? "none" : "block";
    }

    // open game container
    openGameIframe = function() {
        document.getElementById("game-iframe").style.display = "block";
        document.getElementById("close-iframe").style.display = "block";
        document.getElementById("black-wall").style.display = "block";
    }
    var links = document.getElementsByClassName("iframe-link");
    for (var i = 0; i < links.length; i++) {
        links[i].onclick = openGameIframe;
    }
    document.getElementById("search-form").onsubmit = openGameIframe;
    document.getElementById("newgame-form").onsubmit = openGameIframe;

    // close game container
    closeGameIframe = function() {
        document.getElementById("game-iframe").style.display = "none";
        document.getElementById("game-iframe").src = "";
        document.getElementById("close-iframe").style.display = "none";
        document.getElementById("black-wall").style.display = "none";
    }
    document.getElementById("close-iframe").onclick = closeGameIframe;
    document.getElementById("black-wall").onclick = closeGameIframe;

    // set rating label
    document.getElementById("rating-slider").oninput = function() {
        document.getElementById("rating-label").innerHTML = "Rating: " + this.value + "+";
    }

    document.getElementById("avgdifficulty-slider").oninput = function() {
        document.getElementById("avgdifficulty-label").innerHTML = "Difficulty: " + this.value + "+";
    }

    // reset filters
    document.getElementById("clear-button").onclick = function() {
        document.getElementById("rating-slider").value = 0;
        document.getElementById("rating-label").innerHTML = "Rating: 0+";
        document.getElementById("avgdifficulty-slider").value = 0;
        document.getElementById("avgdifficulty-label").innerHTML = "Difficulty: 0+";
        document.getElementById("minplayers-input").value = "";
        document.getElementById("maxplayers-input").value = "";
        document.getElementById("minplaytime-input").value = "";
        document.getElementById("maxplaytime-input").value = "";
        document.getElementById("minage-input").value = "";
        document.getElementById("honors-checkbox").checked = false;
    }
}