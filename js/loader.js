const intervalId = setInterval(function () { // проверяет загруженна ли страница
    if (document.readyState == "complete") {
        document.querySelector('.loader').classList.add('hidden');
        document.querySelector('.textLoader').classList.add('hidden');
        document.querySelector('.main').classList.remove('hidden');
        document.body.style.backgroundColor = "#F6F5FB";
        clearInterval(intervalId);
}
}, 1000);