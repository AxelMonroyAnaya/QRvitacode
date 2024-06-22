function currentTime() {
    let date = new Date();//hacemos un objeto en base a date
    let hh = date.getHours();
    let mm = date.getMinutes(); 
    let ss = date.getSeconds();//igualamos las variables a las funciones para obtere los valores de horas y segundos
    hh = (hh < 10) ? "0" + hh : hh;
    mm = (mm < 10) ? "0" + mm : mm;
    ss = (ss < 10) ? "0" + ss : ss;
    let time = hh + ":" + mm + ":" + ss;
    let watch = document.querySelector("#reloj");//funcion para encontrar el id
    watch.innerHTML = time;
}

setInterval(currentTime, 1000);
