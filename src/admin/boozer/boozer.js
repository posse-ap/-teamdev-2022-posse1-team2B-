let studentInformation = document.getElementById('studentInformation');
let student_list = document.getElementsByClassName('student_list');

for(let i = 0; i < student_list.length; i++) {
  student_list[i].addEventListener('click', function() {
    studentInformation.style.display = "block";
})}  
for(let i = 0; i < student_list.length; i++) {
let closeButton = document.getElementById("closeButton");
closeButton.addEventListener("click", function() {
  studentInformation.style.display = "none";
})
}


