const inputAdmin = document.getElementById("inputAdmin");
const labelAdmin = document.getElementById("labelAdmin");
const inputTeacher = document.getElementById("inputTeacher");
const labelTeacher = document.getElementById("labelTeacher");
const inputStudent = document.getElementById("inputStudent");
const labelStudent = document.getElementById("labelStudent");
const outputContent = document.getElementById("outputContent");




if(outputContent.innerHTML == 'admin')
{
    labelAdmin.classList.add('clickInput');
    labelAdmin.style.color = "#8F7ECE";
    document.querySelector('.teachers_output').classList.add('hidden');
    document.querySelector('.studients_output').classList.add('hidden');

}


inputAdmin.addEventListener("click", () =>
{
    labelAdmin.classList.add('clickInput');
    labelAdmin.style.color = "#8F7ECE";
    labelStudent.classList.remove('clickInput');
    labelStudent.style.color = "#2F2D35";
    labelTeacher.classList.remove('clickInput');
    labelTeacher.style.color = "#2F2D35";
    document.querySelector(".admins_output").classList.remove('hidden');
    document.querySelector('.teachers_output').classList.add('hidden');
    document.querySelector('.studients_output').classList.add('hidden');
    
})

inputTeacher.addEventListener("click", () =>
{
    labelAdmin.classList.remove('clickInput');
    labelAdmin.style.color = "#2F2D35";
    labelStudent.classList.remove('clickInput');
    labelStudent.style.color = "#2F2D35";
    labelTeacher.classList.add('clickInput');
    labelTeacher.style.color = "#8F7ECE";
    document.querySelector(".admins_output").classList.add('hidden');
    document.querySelector('.teachers_output').classList.remove('hidden');
    document.querySelector('.studients_output').classList.add('hidden');
    
})

inputStudent.addEventListener("click", () =>
{
    labelAdmin.classList.remove('clickInput');
    labelAdmin.style.color = "#2F2D35";
    labelStudent.classList.add('clickInput');
    labelStudent.style.color = "#8F7ECE";
    labelTeacher.classList.remove('clickInput');
    labelTeacher.style.color = "#2F2D35";
    document.querySelector(".admins_output").classList.add('hidden');
    document.querySelector('.teachers_output').classList.add('hidden');
    document.querySelector('.studients_output').classList.remove('hidden');
    
});

