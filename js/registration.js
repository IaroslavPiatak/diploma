const inputAdmin = document.getElementById("inputAdmin");
const labelAdmin = document.getElementById("labelAdmin");
const inputTeacher = document.getElementById("inputTeacher");
const labelTeacher = document.getElementById("labelTeacher");
const inputStudent = document.getElementById("inputStudent");
const labelStudent = document.getElementById("labelStudent");
const radioCard = document.querySelectorAll('.faculty_content');
const titleList = document.getElementById("titleList");
const buttonBackGroups = document.getElementById("button_back_groups");
const buttonBackTeacher = document.getElementById("buttonBackTeacher");
const checkboxCard = document.querySelectorAll('.faculty_content_teacher');
const modal = document.getElementById("alert");

//Модальное окно
if(modal.innerHTML == 'true')
{
    document.querySelector(".modal").classList.add("open");

document.querySelector(".cross-btn").addEventListener("click", () =>
{
    document.querySelector(".modal").classList.remove("open");

});

window.addEventListener('keydown', (e) =>
{
    if(e.key === "Escape")
    {
        document.querySelector(".modal").classList.remove("open");
    }
});





}

//проврка дефолтного выделения в шапке
const userRole = document.getElementById("userRole");

// при нажатии кнопки назад у преподавателя
buttonBackTeacher.addEventListener("click", () => {
    
    labelTeacher.classList.add('clickInput');
    labelTeacher.style.color = "#8F7ECE";
    labelAdmin.classList.remove('clickInput');
    labelStudent.classList.remove('clickInput');
    labelStudent.style.color = "#2F2D35";
    labelAdmin.style.color = "#2F2D35";
    document.querySelector('.list_output_admin').classList.add('hidden');
    document.querySelector('.list_output_teacher').classList.remove('hidden');
    document.querySelector('.list_output_student').classList.add('hidden');
    document.querySelector('.list_output_student_group').classList.add('hidden');


    titleList.innerHTML = `<span>Выберите предметы</span>`;
});






// вывод финальных страниц
const finalPage = document.getElementById('finalPage');
if(finalPage.innerHTML == 'student')
{
    titleList.classList.add('hidden');
    document.querySelector('.list_output_admin').classList.add('hidden');
    document.querySelector('.list_output_student_final').classList.remove('hidden');  
}

else if (finalPage.innerHTML == 'teacher')
{
    titleList.innerHTML = `<span>Выбранные предметы</span>`;
    document.querySelector('.list_output_admin').classList.add('hidden');
    document.querySelector('.list_output_teacher_final').classList.remove('hidden'); 

}



if(userRole.innerHTML == 'admin')
{
    labelAdmin.classList.add('clickInput');
    labelAdmin.style.color = "#8F7ECE";
    document.querySelector('.list_output_admin').classList.remove('hidden');
    document.querySelector('.list_output_teacher').classList.add('hidden');
    document.querySelector('.list_output_student').classList.add('hidden');
    titleList.innerHTML = `<span>Введите личные данные</span>`;
}

else if (userRole.innerHTML == 'teacher')
{
    labelTeacher.classList.add('clickInput');
    labelTeacher.style.color = "#8F7ECE";
    document.querySelector('.list_output_admin').classList.add('hidden');
    document.querySelector('.list_output_teacher').classList.remove('hidden');
    document.querySelector('.list_output_student').classList.add('hidden');
    titleList.innerHTML = `<span>Выберите предметы</span>`;


}

else if (userRole.innerHTML == 'student')
{
    labelStudent.classList.add('clickInput');
    labelStudent.style.color = "#8F7ECE";
    labelAdmin.classList.remove('clickInput');
    labelTeacher.classList.remove('clickInput');
    labelTeacher.style.color = "#2F2D35";
    labelAdmin.style.color = "#2F2D35";
    document.querySelector('.list_output_admin').classList.add('hidden');
    document.querySelector('.list_output_teacher').classList.add('hidden');
    document.querySelector('.list_output_student').classList.remove('hidden');
    titleList.innerHTML = `<span>Выберите факультет</span>`;

}

else if (userRole.innerHTML == 'studentGroup')
{
    labelStudent.classList.add('clickInput');
    labelStudent.style.color = "#8F7ECE";
    labelAdmin.classList.remove('clickInput');
    labelTeacher.classList.remove('clickInput');
    labelTeacher.style.color = "#2F2D35";
    labelAdmin.style.color = "#2F2D35";
    titleList.innerHTML = `<span>Выберите группу</span>`;
    document.querySelector('.list_output_admin').classList.add('hidden');
    document.querySelector('.list_output_teacher').classList.add('hidden');
    document.querySelector('.list_output_student').classList.remove('hidden');

}

else
{
    alert('ОШИБКА');
}

// Проверка на вывод групп
const  groupOutput = document.getElementById("groupOutput");

if(groupOutput.innerHTML == 'true')
{
    document.querySelector('.list_output_student').classList.add('hidden');
    document.querySelector('.list_output_student_group').classList.remove('hidden');
    
}

// Событие для админа
inputAdmin.addEventListener("click", () => {
    labelAdmin.classList.add('clickInput');
    labelAdmin.style.color = "#8F7ECE";
    labelStudent.classList.remove('clickInput');
    labelTeacher.classList.remove('clickInput');
    labelTeacher.style.color = "#2F2D35";
    labelStudent.style.color = "#2F2D35";
    document.querySelector('.list_output_admin').classList.remove('hidden');
    document.querySelector('.list_output_teacher').classList.add('hidden');
    document.querySelector('.list_output_student').classList.add('hidden');
    document.querySelector('.list_output_student_group').classList.add('hidden');
    titleList.innerHTML = `<span>Выберите привелегии</span>`;

});
// Событие для препода
inputTeacher.addEventListener("click", () => {
    labelTeacher.classList.add('clickInput');
    labelTeacher.style.color = "#8F7ECE";
    labelStudent.classList.remove('clickInput');
    labelAdmin.classList.remove('clickInput');
    labelAdmin.style.color = "#2F2D35";
    labelStudent.style.color = "#2F2D35";
    document.querySelector('.list_output_admin').classList.add('hidden');
    document.querySelector('.list_output_teacher').classList.remove('hidden');
    document.querySelector('.list_output_student').classList.add('hidden');
    document.querySelector('.list_output_student_group').classList.add('hidden');
    titleList.innerHTML = `<span>Выберите предметы</span>`;


});
// Событие для студента
inputStudent.addEventListener("click", () => {
    labelStudent.classList.add('clickInput');
    labelStudent.style.color = "#8F7ECE";
    labelAdmin.classList.remove('clickInput');
    labelTeacher.classList.remove('clickInput');
    labelTeacher.style.color = "#2F2D35";
    labelAdmin.style.color = "#2F2D35";
    document.querySelector('.list_output_admin').classList.add('hidden');
    document.querySelector('.list_output_teacher').classList.add('hidden');
    document.querySelector('.list_output_student').classList.remove('hidden');
    document.querySelector('.list_output_student_group').classList.add('hidden');
    titleList.innerHTML = `<span>Выберите факультет</span>`;
   
    

});

// выбор предметов для учителя
for (let i = 0; i < checkboxCard.length; i++) {
    let click = 0;
    checkboxCard[i].addEventListener('click', () => {
        if(click == 0)
        {
            checkboxCard[i].style.border = "3px solid #8F7ECE";
            checkboxCard[i].style.boxShadow = " 4px 4px 4px #8F7ECE";
            click = 1;
        }
        else
        {
            checkboxCard[i].style.border = null;
            checkboxCard[i].style.boxShadow = "0px 4px 4px rgba(0, 0, 0, 0.25)";
            click = 0;
        }
    })
    

}


// выбор факультетов
for (let i = 0; i < radioCard.length; i++) {

    radioCard[i].addEventListener('click', () => {
        radioCard[i].style.border = "3px solid #8F7ECE";
        radioCard[i].style.boxShadow = " 4px 4px 4px #8F7ECE";

        let thisCard = i;
        for (let j = 0; j < radioCard.length; j++) {
            if (j == i) {
                continue;
            }
            else {
                radioCard[j].style.border = null;
                radioCard[j].style.boxShadow = "0px 4px 4px rgba(0, 0, 0, 0.25)"
            }
        }
    })

}




// при нажатии кнопки назад у студента
buttonBackGroups.addEventListener("click", () => {
    
    labelStudent.classList.add('clickInput');
    labelStudent.style.color = "#8F7ECE";
    labelAdmin.classList.remove('clickInput');
    labelTeacher.classList.remove('clickInput');
    labelTeacher.style.color = "#2F2D35";
    labelAdmin.style.color = "#2F2D35";
    document.querySelector('.list_output_admin').classList.add('hidden');
    document.querySelector('.list_output_teacher').classList.add('hidden');
    document.querySelector('.list_output_student').classList.remove('hidden');
    document.querySelector('.list_output_student_group').classList.add('hidden');

    titleList.innerHTML = `<span>Выберите факультет</span>`;
});




















