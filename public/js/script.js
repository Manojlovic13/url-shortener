let slike = ["url('../img/0.jpg')","url('../img/1.jpg')","url('../img/2.jpg')","url('../img/3.jpg')","url('../img/4.jpg')"
            ,"url('../img/5.jpg')","url('../img/6.jpg')","url('../img/7.jpg')","url('../img/8.jpg')","url('../img/9.jpg')"]

function menjaj(niz){
    i = 0;
    setInterval(() => {
        i++;
        if (i == niz.length) {
            i = 0;
        }
        document.body.style.backgroundImage = niz[i];
    }, 7000);
}