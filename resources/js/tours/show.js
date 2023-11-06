function onChangeNumberOfPassengers(event) {
    total_price = price_per_passenger * event.target.value;

    formatter = new Intl.NumberFormat("en-US", {
        style: "currency",
        currency: "CAD",
    });

    document.querySelector("#total_price").innerHTML = formatter.format(total_price);
}

document.querySelector("#number_of_passengers").onchange = onChangeNumberOfPassengers;
