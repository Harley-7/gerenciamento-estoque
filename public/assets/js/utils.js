import Toast from "./toast.js";

export function createElement(tag, options = {}){
    const element = document.createElement(tag);

    if(options.id) element.id = options.id;
    if(options.className) element.className = options.className;
    if(options.textContent) element.textContent = options.textContent;
    if(options.innerHTML) element.innerHTML = options.innerHTML;
    if(options.src) element.src = options.src;
    if(options.alt) element.alt = options.alt;

    return element
}

export function showToast(type, message){
    Toast.fire({
        icon: type,
        title: message
    });

}

export function parseBRL(num){

    let brl = parseFloat(num);

    return brl.toLocaleString("pt-BR", {style: "currency", currency: "BRL"})

}

export function showSwalWithReload(message, iconType){
    Swal.fire({
        title: message,
        icon: iconType,
        heightAuto: false
    }).then((result) => {
        if (result.isConfirmed) {
            location.reload();
        }
    });
}

export function showLoader() {

    const overlay = document.createElement("div");
    overlay.id = "pageLoader";
    overlay.className = "overlay";

    overlay.innerHTML = `
      <div class="spinner-border" style="width: 5rem; height: 5rem; color: #183256" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    `;

    document.body.appendChild(overlay);

}

export function hideLoader() {
    const overlay = document.getElementById("pageLoader");
    if (overlay) {
        overlay.remove();
    }
}

