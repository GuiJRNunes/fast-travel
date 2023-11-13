
function onClickOpenModalDelete(event) {
    document.querySelector('#delete-booking-confirmation form').action = event.target.dataset.deleteLink;

    booking = event.target.closest('[data-booking]');
    booking_title = booking.querySelector('[data-booking-title]').innerHTML;
    booking_dates = booking.querySelector('[data-booking-dates]').innerHTML;
    document.querySelector('#delete-booking-confirmation [data-modal-content]').innerHTML = `<b>${booking_title}<b><br/>${booking_dates}`;
}

function onChangeUpdateTotalPrice(event) {
    number_of_passengers = event.target.value;
    price_per_passenger = event.target.dataset.bookingPricePerPassengerValue;
    total_price_elem = event.target.closest('[data-booking]').querySelector('[data-booking-total-price]');

    if (number_of_passengers >= 1 && number_of_passengers <= 999) {
        total_price = price_per_passenger * event.target.value;

        formatter = new Intl.NumberFormat("en-US", {
            style: "currency",
            currency: "CAD",
        });

        total_price_elem.innerHTML = formatter.format(total_price);
    } else {
        total_price_elem.innerHTML = "";
    }
}

document.querySelectorAll('[data-delete-link]').forEach(function (element) {
    element.onclick = onClickOpenModalDelete;
});

document.querySelectorAll('[data-booking-number-of-passengers]').forEach(function (element) {
    element.onchange = onChangeUpdateTotalPrice;
})