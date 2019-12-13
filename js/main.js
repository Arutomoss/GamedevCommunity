function addImage (){
    var img = document.createElement('img');
    img.src = '../img/logo_light.svg';

    var jam = document.getElementById('img-source');
    jam.appendChild(img);
}