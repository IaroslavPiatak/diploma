const btnSubmit = document.querySelectorAll('.btn-submit');
const profileCard = document.querySelectorAll('.profile_card');
for(let i = 0; i < btnSubmit.length; i++)
{
    btnSubmit[i].onmouseover = function () {
        profileCard[i].style.transform = "translateY(-0.20em)";
        profileCard[i].style.transition = "ease 0.3s";
        profileCard[i].style.boxShadow = "0 0 1em 0em #8F7ECE";
    };
    
    
    btnSubmit[i].onmouseleave = function () {
        profileCard[i].style.transform = "translateY(+0.20em)";
        profileCard[i].style.transition = "ease 0.1s";
        profileCard[i].style.boxShadow = "0px 4px 4px rgba(0, 0, 0, 0.25)";
     };

}

// registration.php

const btnForm = document.querySelectorAll('.registerBtn');
const facultyContentButton = document.querySelectorAll('.reginsterBtnContent');
for(let i = 0; i < btnForm.length; i++)
{
    
    
    btnForm[i].onmouseover = function () {
        facultyContentButton[i].style.transform = "translateY(-0.20em)";
        facultyContentButton[i].style.transition = "ease 0.3s";
        facultyContentButton[i].style.boxShadow = "0 0 1em 0em #8F7ECE";
    };
    
    
    btnForm[i].onmouseleave = function () {
        facultyContentButton[i].style.transform = "translateY(+0.20em)";
        facultyContentButton[i].style.transition = "ease 0.1s";
        facultyContentButton[i].style.boxShadow = "0px 4px 4px rgba(0, 0, 0, 0.25)";
     };

}

const nextBtn = document.querySelectorAll('.nextBtn');
const nextBtnContent = document.querySelectorAll('.nextBtnContent');
for(let i = 0; i < nextBtn.length; i++)
{
    
    
    nextBtn[i].onmouseover = function () {
        nextBtnContent[i].style.transform = "translateY(-0.20em)";
        nextBtnContent[i].style.transition = "ease 0.3s";
        nextBtnContent[i].style.boxShadow = "0 0 1em 0em #8F7ECE";
    };
    
    
    nextBtn[i].onmouseleave = function () {
        nextBtnContent[i].style.transform = "translateY(+0.20em)";
        nextBtnContent[i].style.transition = "ease 0.1s";
        nextBtnContent[i].style.boxShadow = "0px 4px 4px rgba(0, 0, 0, 0.25)";
     };

}

const checkboxTeacher = document.querySelectorAll('.checkboxTeacher');
const faculty_content_teacher = document.querySelectorAll('.faculty_content_teacher');
for(let i = 0; i < checkboxTeacher.length; i++)
{
    
    
    checkboxTeacher[i].onmouseover = function () {
        faculty_content_teacher[i].style.transform = "translateY(-0.20em)";
        faculty_content_teacher[i].style.transition = "ease 0.3s";
        faculty_content_teacher[i].style.boxShadow = "0 0 1em 0em #8F7ECE";
    };
    
    
    checkboxTeacher[i].onmouseleave = function () {
        faculty_content_teacher[i].style.transform = "translateY(+0.20em)";
        faculty_content_teacher[i].style.transition = "ease 0.1s";
        faculty_content_teacher[i].style.boxShadow = "0px 4px 4px rgba(0, 0, 0, 0.25)";
     };

}

const btnBack = document.querySelectorAll('.btnBack');
const btnBackContent = document.querySelectorAll('.btnBackContent');
for(let i = 0; i < btnBack.length; i++)
{
    
    
    btnBack[i].onmouseover = function () {
        btnBackContent[i].style.transform = "translateY(-0.20em)";
        btnBackContent[i].style.transition = "ease 0.3s";
        btnBackContent[i].style.boxShadow = "0 0 1em 0em #EC5863";
    };
    
    
    btnBack[i].onmouseleave = function () {
        btnBackContent[i].style.transform = "translateY(+0.20em)";
        btnBackContent[i].style.transition = "ease 0.1s";
        btnBackContent[i].style.boxShadow = "0px 4px 4px rgba(0, 0, 0, 0.25)";
     };
     

}
const facultyBtn = document.querySelectorAll('.facultyBtn');
const facultyBtnContent = document.querySelectorAll('.facultyBtnContent');

for(let i = 0; i < facultyBtn.length; i++)
{
    
    
    facultyBtn[i].onmouseover = function () {
        facultyBtnContent[i].style.transform = "translateY(-0.20em)";
        facultyBtnContent[i].style.transition = "ease 0.3s";
        facultyBtnContent[i].style.boxShadow = "0 0 1em 0em #8F7ECE";
    };
    
    
    facultyBtn[i].onmouseleave = function () {
        facultyBtnContent[i].style.transform = "translateY(+0.20em)";
        facultyBtnContent[i].style.transition = "ease 0.1s";
        facultyBtnContent[i].style.boxShadow = "0px 4px 4px rgba(0, 0, 0, 0.25)";
     };
     

}


const GroupBtn = document.querySelectorAll('.GroupBtn');
const GroupBtnContent = document.querySelectorAll('.GroupBtnContent');

for(let i = 0; i < GroupBtn.length; i++)
{
    
    
    GroupBtn[i].onmouseover = function () {
        GroupBtnContent[i].style.transform = "translateY(-0.20em)";
        GroupBtnContent[i].style.transition = "ease 0.3s";
        GroupBtnContent[i].style.boxShadow = "0 0 1em 0em #8F7ECE";
    };
    
    
    GroupBtn[i].onmouseleave = function () {
        GroupBtnContent[i].style.transform = "translateY(+0.20em)";
        GroupBtnContent[i].style.transition = "ease 0.1s";
        GroupBtnContent[i].style.boxShadow = "0px 4px 4px rgba(0, 0, 0, 0.25)";
     };
     

}













