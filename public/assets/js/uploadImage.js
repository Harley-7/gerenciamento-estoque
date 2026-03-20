const fileInput = document.querySelector(".fileInput");
const inputFile = document.querySelector(".fileInput input");
const dropZone = document.querySelector(".dropZone"); 

function onEnter() {
    fileInput.classList.add("active");
}

function onLeave(){
    fileInput.classList.remove("active");
}

fileInput.addEventListener("dragenter", onEnter);
fileInput.addEventListener("drop", onLeave);
fileInput.addEventListener("dragend", onLeave);
fileInput.addEventListener("dragleave", onLeave);

inputFile.addEventListener("change", event => {
    if(inputFile.files.length > 0){

        if(document.querySelector("#cover")){
            dropZone.removeChild(document.querySelector("#cover"));
        }
        
        const img = document.createElement("img");
        img.id = "cover";
        img.src = URL.createObjectURL(inputFile.files[0]);

        dropZone.appendChild(img);

    }
});