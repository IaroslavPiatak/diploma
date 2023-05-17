const date = document.getElementById('dateInput');
const filetext = document.getElementById('filetext');
const fileicon = document.querySelector('.file_icon');
const fileinput = document.querySelector('.input_photo');
let datetext = document.getElementById('datetext');

const abstract = document.getElementById('abstract');
const practice = document.getElementById('practice');


abstract.addEventListener('click', ()=>
{
    document.querySelector('.date_select').classList.add('hidden');
    document.querySelector('.bottom').style.justifyContent = "flex-end";
    

})

practice.addEventListener('click', ()=>
{
    document.querySelector('.date_select').classList.remove('hidden');
    document.querySelector('.bottom').style.justifyContent = "space-between";

})


function reverse(val) // переворачивает дату
{
    let split = val.split("");
    return split[8] + split[9] + '.' + split[5] + split[6] + '.' + split[0] + split[1] + split[2] + split[3];
}



const intervalId = setInterval(function () { // проверяет введена ли дата
    if (date.value.trim() != '')
    datetext.innerHTML = 'Выполнить до : ' + reverse(date.value);
    else
    datetext.innerHTML = 'Выбрать дату выполнения';

       
}, 1000)


fileinput.addEventListener("input", (event) => {
    filetext.innerHTML = `<span>Файл загружен</span>`;
    fileicon.style.backgroundImage = "url(../../img/teacher/homework/file_ready.png)";
});
