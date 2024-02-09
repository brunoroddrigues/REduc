const form = document.querySelector("#filtro");
const inputs = document.getElementsByClassName("in-text");
const checkboxes = document.getElementsByClassName("in-check");

function checado() {
    for (let i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            if (inputs[i].disabled) {
                inputs[i].disabled = false;
            }
            if (inputs[i].classList.contains("d-none")) {
                inputs[i].classList.remove("d-none");
            }
        } else {
            if (!inputs[i].disabled) {
                inputs[i].disabled = true;
            }
            if (!inputs[i].classList.contains("d-none")) {
                inputs[i].classList.add("d-none");
            }
        }
    }
}