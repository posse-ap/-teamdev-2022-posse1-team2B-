"use strict";

// ヘッダーのお問い合わせをクリックした時の処理
let contact = document.getElementById("contact");
let contactEmailAddress = document.getElementById("contactEmailAddress");
let closeButton = document.getElementById("closeButton");
// console.log(contact);
contact.addEventListener("click", function() {
  contactEmailAddress.classList.add("show_contact");
});
closeButton.addEventListener("click", function() {
  contactEmailAddress.classList.remove("show_contact");
})
