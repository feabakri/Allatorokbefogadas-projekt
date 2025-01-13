//Életkor hibakezése
let eletKor = document.querySelector("input[name='animal_age']");
eletKor.addEventListener("input", function (event) {
    // Remove non-numeric characters
    this.value = this.value.replace(/\D+/g, '');

    if (this.value < 1) {
        this.value = 1; // minimum 1
    } else if (this.value > 25) {
        this.value = 25; // maximum 25
    } else {
        this.value = Math.floor(this.value); // csak egész szám
    }
})