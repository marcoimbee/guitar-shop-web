var current = 0;

function rotate(dir) {
    var images = ["img1.png", "img2.png", "img3.png", "img4.png"];
    var tot_images = images.length;
    //alert(dir)
    var curr_img = document.getElementById("displayed_img");

    if(dir == "right"){
        //alert(curr_img.src);
        current = (current + 1) % tot_images;
        curr_img.src = "images/gallery/new_arrivals/" + images[current];
        //console.log(current);
        //console.log(curr_img.src);
    }else{
        if(current == 0){
            current = current + tot_images - 1;
        }else{
            current = (current + tot_images - 1) % tot_images;
        }
        curr_img.src = "images/gallery/new_arrivals/" + images[current];
        //console.log(current);
        //console.log(curr_img.src);
    }
}