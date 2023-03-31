const inputAdmin = document.getElementById("inputAdmin");
const labelAdmin = document.getElementById("labelAdmin");
const inputTeacher = document.getElementById("inputTeacher");
const labelTeacher = document.getElementById("labelTeacher");
const inputStudent = document.getElementById("inputStudent");
const labelStudent = document.getElementById("labelStudent");
const radioCard = document.querySelectorAll('.faculty_content');
const titleList = document.getElementById("titleList");
const buttonBackGroups = document.getElementById("button_back_groups");
const buttonBackStudentFinal = document.getElementById("button_back_student_final");
//проврка дефолтного выделения в шапке
const userRole = document.getElementById("userRole");

// при нажатии кнопки назад у студентв в финальном листе (работает почему то только тут)




// вывод финальных страниц
const finalPage = document.getElementById('finalPage');
if(finalPage.innerHTML == 'student')
{
    titleList.classList.add('hidden');
    document.querySelector('.list_output_admin').classList.add('hidden');
    document.querySelector('.list_output_student_final').classList.remove('hidden');


    
}



if(userRole.innerHTML == 'admin')
{
    labelAdmin.classList.add('clickInput');
    labelAdmin.style.color = "#8F7ECE";
    document.querySelector('.list_output_admin').classList.remove('hidden');
    document.querySelector('.list_output_teacher').classList.add('hidden');
    document.querySelector('.list_output_student').classList.add('hidden');
    titleList.innerHTML = `<span>Выберите привелегии</span>`;

}

else if (userRole.innerHTML == 'teacher')
{
    labelTeacher.classList.add('clickInput');
    labelTeacher.style.color = "#8F7ECE";
    document.querySelector('.list_output_admin').classList.add('hidden');
    document.querySelector('.list_output_teacher').classList.remove('hidden');
    document.querySelector('.list_output_student').classList.add('hidden');
    titleList.innerHTML = `<span>Выберите предмет</span>`;


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
    titleList.innerHTML = `<span>Выберите предмет</span>`;


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



















