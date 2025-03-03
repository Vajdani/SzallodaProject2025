function reviewstar(star){
    let rating = "<span class='starTicked'>"
    for (let i = 1; i < star+1; i++) {
        rating = rating+"<span onclick='reviewstar("+i+")'>★</span>"
    }
    rating = rating+"</span><span class='starUnTicked'>"
    for (let i = star; i<5; i++){
        rating = rating+"<span onclick='reviewstar("+(i+1)+")'>★</span>"
    }
    rating = rating + "</span>"
    document.getElementById("rating").innerHTML=rating;
    document.getElementById("star").value=star;
}