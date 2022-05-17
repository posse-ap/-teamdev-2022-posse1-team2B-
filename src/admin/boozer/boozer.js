let studentInformation = document.getElementById("studentInformation");
let studentList = document.getElementsByClassName("studentList");
for(let i = 0; i < studentList.length; i++) {
  studentList[i].addEventListener('click', function() {
    studentInformation.style.display = "block";
    studentList[i].style.display = "none";
})}  
