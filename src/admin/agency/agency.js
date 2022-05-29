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
})
closeButton.addEventListener("click", function() {
  contactEmailAddress.classList.remove("show_contents");
})
