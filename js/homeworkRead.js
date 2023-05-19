
const typeOfHomework = document.querySelector('.forJS');
if(typeOfHomework.innerHTML == 'Конспект')
{
    document.querySelector('.bottom').style.justifyContent = 'end';
    document.querySelector('.statusOfGroup').classList.add('hidden');
}

else
{
    document.querySelector('.main_container').style.height = ' ';

   
    document.querySelector('.statusOfGroup').classList.remove('hidden');
}


