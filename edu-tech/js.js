const header = document.querySelector("header");

window.addEventListener ("scroll", function() {
	header.classList.toggle ("sticky", window.scrollY > 0);
});

let menu =  document.querySelector('#menu-icon');
let navbar =  document.querySelector('.navbar');

menu.onclick = () => {
	menu.classList.toggle('bx-x');
	navbar.classList.toggle('open');
};

window.onscroll = () => {
	menu.classList.remove('bx-x');
	navbar.classList.remove('open');
};
//
document.getElementById('login').addEventListener('click',function() {
    document.querySelector('.bg-model').style.display = 'flex';
    
});
document.querySelector('.close').addEventListener('click',function() {
    document.querySelector('.bg-model').style.display = 'none';
});
//
document.getElementById('adminlogin').addEventListener('click',function() {
    document.querySelector('.abg-model').style.display = 'flex';
});
document.querySelector('.aclose').addEventListener('click',function() {
    document.querySelector('.abg-model').style.display = 'none';
});
document.getElementById('signup').addEventListener('click',function() {
    document.querySelector('.bg-model2').style.display = 'flex';
});
document.querySelector('.close2').addEventListener('click',function() {
    document.querySelector('.bg-model2').style.display = 'none';
});