function onChangeNumberOfPassengers(event) {
    number_of_passengers = event.target.value;
    if (number_of_passengers >= 1 && number_of_passengers <= 999) {
        total_price = price_per_passenger * event.target.value;

        formatter = new Intl.NumberFormat("en-US", {
            style: "currency",
            currency: "CAD",
        });

        document.querySelector("#total_price").innerHTML = formatter.format(total_price);
    } else {
        document.querySelector("#total_price").innerHTML = "";
    }

}

document.querySelector("#number_of_passengers").onchange = onChangeNumberOfPassengers;
