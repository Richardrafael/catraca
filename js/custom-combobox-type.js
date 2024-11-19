const input_type = document.getElementById("combo_search_type");
const datalist_type = document.getElementById("type_list");
const options_type = datalist_type.querySelectorAll(".option");
let selectedTypes = [];

document.addEventListener("click", function(event) {
    if (event.target != input_type && event.target != datalist_type) {
        datalist_type.style.display = "none";
    }else{
        datalist_type.style.display = "block";
    }
});

input_type.addEventListener("input", function() {
    const input_typeValue = input_type.value.toLowerCase();

    options_type.forEach(option => {
        const optionValueType = option.innerHTML.toLowerCase();
        if (optionValueType.includes(input_typeValue)) {
            option.style.display = "block";
        } else {
            option.style.display = "none";
        }
    });
});

options_type.forEach(option => {
    option.addEventListener("click", function() {
        event.stopPropagation();
        const selectedValueType = option.getAttribute("data-value");
        if (!isSelectedType(selectedValueType)) {
            selectedTypes.push(selectedValueType);
            option.style.backgroundColor = "LightBlue";
        }else{
            const index = selectedTypes.findIndex(item => item === selectedValueType);
            if (index !== -1) {
                selectedTypes.splice(index, 1);
            }
            option.style.backgroundColor = "white";
        }
    });
});

function isSelectedType(value) {
    for (const item of selectedTypes) {
        if (item == value) {
            return true;
        }
    }
    return false;
}