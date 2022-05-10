"use strict";
let contact = document.getElementById("contact");
let contactEmailAddress = document.getElementById("contactEmailAddress");
let closeButton = document.getElementById("closeButton");
let studentInformationCloseButton = document.getElementById("studentInformationCloseButton");
// console.log(contact);
// ヘッダーのお問い合わせをクリックした時の処理
contact.addEventListener("click", function() {
  contactEmailAddress.classList.add("show_contents");
});
closeButton.addEventListener("click", function() {
  contactEmailAddress.classList.remove("show_contents");
})
studentInformationCloseButton.addEventListener("click", function() {
  studentInformation.classList.remove("show_contents")
})
// アカウント登録画面

