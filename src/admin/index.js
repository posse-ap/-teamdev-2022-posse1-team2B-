let forget = document.getElementById('forget');
let loginEmailAddress = document.getElementById('loginEmailAddress');
let closeButton = document.getElementById('closeButton');
forget.addEventListener('click', function(){
  loginEmailAddress.style.display = 'block';
})
closeButton.addEventListener('click', function() {
  loginEmailAddress.style.display = 'none';
})
