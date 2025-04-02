function reviewstar(star) {
    for (let index = 1; index <= 5; index++) {
        document.getElementById("rating_" + index).className = index <= star ? "starTicked" : "starUnTicked"
    }

    document.getElementById("star").value=star;
}
