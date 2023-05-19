 
const mainContainerSubject =  document.querySelector(".main_container_subject");
const mainContainerFaculty = document.querySelector(".main_container_faculty");
const mainContainerGroup = document.querySelector(".main_container_group");
const mainContainerStudent = document.querySelector(".main_container_student");
const titleHeaderSpan = document.querySelector('.title_teacher_span');
let span = document.getElementById('span');

if(span.innerHTML == 'faculties')
{
    mainContainerSubject.classList.add('hidden');
    mainContainerFaculty.classList.remove('hidden');
    mainContainerGroup.classList.add('hidden');
    mainContainerStudent.classList.add('hidden');
    titleHeaderSpan.innerHTML = 'Выберите факультет';
}

else if (span.innerHTML == 'groups')
{
    mainContainerSubject.classList.add('hidden');
    mainContainerFaculty.classList.add('hidden');
    mainContainerGroup.classList.remove('hidden');
    mainContainerStudent.classList.add('hidden');
    titleHeaderSpan.innerHTML = 'Выберите группу';

}


else if (span.innerHTML == 'student')
{
    mainContainerSubject.classList.add('hidden');
    mainContainerFaculty.classList.add('hidden');
    mainContainerGroup.classList.add('hidden');
    mainContainerStudent.classList.remove('hidden');
    titleHeaderSpan.innerHTML = 'Выберите студента';

}
else if (span.innerHTML = 'subjects')
{
    
    titleHeaderSpan.innerHTML == 'Выберите предмет';

}

