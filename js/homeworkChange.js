const mainContainerSubject =  document.querySelector(".main_container_subject");
const mainContainerFaculty = document.querySelector(".main_container_faculty");
const mainContainerGroup = document.querySelector(".main_container_group");
const titleHeaderSpan = document.querySelector('.title_teacher_span');
const submitSubject = document.querySelectorAll(".submit_subject");
const sumbitFaculty = document.querySelectorAll(".submit_faculty");
for (let i = 0; i < submitSubject.length; i++) {
    submitSubject[i].addEventListener("click", () => {

        mainContainerSubject.classList.add('hidden');
        mainContainerFaculty.classList.remove('hidden');
        titleHeaderSpan.innerHTML = 'Выбирите факультет';

    })

}

for (let i = 0; i < sumbitFaculty.length; i++) {
    sumbitFaculty[i].addEventListener("click", () => {

        
        titleHeaderSpan.innerHTML = 'Выбирите группу';
        mainContainerGroup.classList.remove('hidden');
        mainContainerFaculty.classList.add('hidden');

    })

}
