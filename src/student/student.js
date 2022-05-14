"use strict";

let contact = document.getElementById("contact");
let contactEmailAddress = document.getElementById("contactEmailAddress");
let closeButton = document.getElementById("closeButton");
let request = document.getElementById("request");
let it = document.getElementById("it");


// ヘッダーのお問い合わせをクリックした時の処理
contact.addEventListener("click", function() {
  contactEmailAddress.classList.add("show_contact");
});
// ヘッダーのエージェンシー企業向け掲載依頼をクリックした時の処理
request.addEventListener("click", function(){
  contactEmailAddress.classList.add("show_contact");
})
// ✕ボタンをクリックした時の処理
closeButton.addEventListener("click", function() {
  contactEmailAddress.classList.remove("show_contact");
})

let industryRankTitle = document.getElementById("industryRankTitle");
// TOP画面の業種別ランキングのボタンを押した時の処理
// 金融
// document.getElementById("finance").addEventListener("click", function() {
//   industryRankTitle.insertAdjacentHTML("beforeend", finance.dataset["value"]);
// })
// // IT
// document.getElementById("it").addEventListener("click", function() {
//   industryRankTitle.insertAdjacentHTML("beforeend", it.dataset["value"]);
// })
// // 広告
// document.getElementById("ad").addEventListener("click", function() {
//   industryRankTitle.insertAdjacentHTML("beforeend", ad.dataset["value"]);
// })
// // 商社
// document.getElementById("tradingCompany").addEventListener("click", function() {
//   industryRankTitle.insertAdjacentHTML("beforeend", tradingCompany.dataset["value"]);
// })
// // 不動産
// document.getElementById("realEstate").addEventListener("click", function() {
//   industryRankTitle.insertAdjacentHTML("beforeend", realEstate.dataset["value"]);
// })


// ad.addEventLister("click", function(){
//   industryRankTitle.insertAdjacentHTML("beforebegin", it.dataset["value"]);
// })
// console.log(it.dataset["value"]); //IT
// console.log(ad.dataset["value"]); //広告
// console.log(tradingCompany.dataset["value"]); //商社
// console.log(realEstate.dataset["value"]); //