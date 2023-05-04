const mainContainerSubject =  document.querySelector(".main_container_subject");
const mainContainerFaculty = document.querySelector(".main_container_faculty");
const mainContainerGroup = document.querySelector(".main_container_group");
const titleHeaderSpan = document.querySelector('.title_teacher_span');
let span = document.getElementById('span');

if(span.innerHTML == 'faculties')
{
    mainContainerSubject.classList.add('hidden');
    mainContainerFaculty.classList.remove('hidden');
    titleHeaderSpan.innerHTML = 'Выберите факультет';
}

else if (span.innerHTML == 'groups')
{
    mainContainerSubject.classList.add('hidden');
    mainContainerFaculty.classList.add('hidden');
    mainContainerGroup.classList.remove('hidden');
    titleHeaderSpan.innerHTML = 'Выберите группу';

}
else if (span.innerHTML = 'subjects')
{
    
    titleHeaderSpan.innerHTML == 'Выберите предмет';

}

