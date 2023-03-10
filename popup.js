
document.getElementById('button').addEventListener('click',function() {
    document.querySelector('.bg-model').style.display = 'block';
});
document.querySelector('.close').addEventListener('click',function() {
    document.querySelector('.bg-model').style.display = 'none';
});

document.getElementById('addbutton').addEventListener('click',function() {
    document.getElementById('bg-model2').style.display = 'block';
    
});
document.querySelector('.close2').addEventListener('click',function() {
    document.getElementById('bg-model2').style.display = 'none';
});


