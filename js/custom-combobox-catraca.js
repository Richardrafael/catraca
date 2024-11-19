const input_catraca = document.getElementById("combo_search_catraca");
const datalist_catraca = document.getElementById("catraca_list");
const options_catraca = datalist_catraca.querySelectorAll(".option");
let selectedCatracas = [];

document.addEventListener("click", function(event) {
    if (event.target != input_catraca && event.target != datalist_catraca) {
        datalist_catraca.style.display = "none";
    }else{
        datalist_catraca.style.display = "block";
    }
});

input_catraca.addEventListener("input", function() {
    const input_catracaValue = input_catraca.value.toLowerCase();

    options_catraca.forEach(option => {
        const optionValueCatraca = option.innerHTML.toLowerCase();
        if (optionValueCatraca.includes(input_catracaValue)) {
            option.style.display = "block";
        } else {
            option.style.display = "none";
        }
    });
});

options_catraca.forEach(option => {
    option.addEventListener("click", function() {
        event.stopPropagation();
        const selectedValueCatraca = option.getAttribute("data-value");
        if (!isSelectedCatraca(selectedValueCatraca)) {
            selectedCatracas.push(selectedValueCatraca);
            option.style.backgroundColor = "LightBlue";
        }else{
            const index = selectedCatracas.findIndex(item => item === selectedValueCatraca);
            if (index !== -1) {
                selectedCatracas.splice(index, 1);
            }
            option.style.backgroundColor = "white";
        }
    });
});

function isSelectedCatraca(value) {
    for (const item of selectedCatracas) {
        if (item == value) {
            return true;
        }
    }
    return false;
}