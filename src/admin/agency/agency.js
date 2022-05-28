"use strict";

let contact = document.getElementById("contact");
let contactEmailAddress = document.getElementById("contactEmailAddress");
let closeButton = document.getElementById("closeButton");
let studentInformationCloseButton = document.getElementById("studentInformationCloseButton");
let studentInformation = document.getElementsByClassName("student_information");


// console.log(studentDetail[0]);
// ヘッダーのお問い合わせをクリックした時の処理
contact.addEventListener("click", function() {
  contactEmailAddress.classList.add("show_contents");
});
closeButton.addEventListener("click", function() {
  contactEmailAddress.classList.remove("show_contents");
})

// アカウント登録画面
// studentInformationCloseButton.addEventListener("click", function() {
//   studentDetail.style.display = "none";
// })

//AGENCY/STUDENTS.PHP//
for (let i=0; i<6; i++) {
  let studentInfo = document.getElementById(`student_info${i}`);
  let studentDetailTable = document.getElementById(`student_detail_table${i}`);
  studentInfo.addEventListener("click", function () {
    studentDetailTable.classList.add("show_contents");
})
}
