const inputAdmin = document.getElementById("inputAdmin");
const labelAdmin = document.getElementById("labelAdmin");

const inputTeacher = document.getElementById("inputTeacher");
const labelTeacher = document.getElementById("labelTeacher");

const inputStudent = document.getElementById("inputStudent");
const labelStudent = document.getElementById("labelStudent");


const radioCard = document.querySelectorAll('.faculty_content');

const userRole = document.getElementById("userRole");



function clickStudent()
{
    labelStudent.classList.add('clickInput');
    labelStudent.style.color = "#8F7ECE";


    labelAdmin.classList.remove('clickInput');
    labelTeacher.classList.remove('clickInput');
    labelTeacher.style.color = "#2F2D35";
    labelAdmin.style.color = "#2F2D35";

    document.querySelector('.list_output_student_faculties').classList.remove('hidden');

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




// Событие для админа
inputAdmin.addEventListener("click", function inputAdmin () {


    labelAdmin.classList.add('clickInput');
    labelAdmin.style.color = "#8F7ECE";



    labelStudent.classList.remove('clickInput');
    labelTeacher.classList.remove('clickInput');
    labelTeacher.style.color = "#2F2D35";
    labelStudent.style.color = "#2F2D35";
})


// Событие для преподавателя
inputTeacher.addEventListener("click",  function inputTeacher () {
    labelTeacher.classList.add('clickInput');
    labelTeacher.style.color = "#8F7ECE";



    labelStudent.classList.remove('clickInput');
    labelAdmin.classList.remove('clickInput');
    labelAdmin.style.color = "#2F2D35";
    labelStudent.style.color = "#2F2D35";

});


// Событие для студента
inputStudent.addEventListener("click", ()=>
{
    clickStudent();
});

if(userRole.innerHTML == 'student')
{
    clickStudent();
}





