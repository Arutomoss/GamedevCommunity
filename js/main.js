function addImage (image){
    var img = document.createElement('img');
    img.src = '../img/' + image.toString();

    var jam = document.getElementById('img-source');
    jam.appendChild(img);
}