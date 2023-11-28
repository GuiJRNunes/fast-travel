function onChangeNumberOfPassengers(event) {
    let number_of_passengers = event.target.value;
    
    let formatter = new Intl.NumberFormat("en-US", {
        style: "currency",
        currency: "CAD",
    });
    
    let total_price;
    if (number_of_passengers >= 1 && number_of_passengers <= 999) {
        total_price = price_per_passenger * event.target.value;
    } else {
        total_price = 0;
    }

    document.querySelector("#total_price").innerHTML = formatter.format(total_price);
}

document.querySelector("#number_of_passengers").onchange = onChangeNumberOfPassengers;
