
function onClickOpenModalDelete(event) {
    document.querySelector('#delete-booking-confirmation form').action = event.target.dataset.deleteLink;

    let booking = event.target.closest('[data-booking]');
    let booking_title = booking.querySelector('[data-booking-title]').innerHTML;
    let booking_dates = booking.querySelector('[data-booking-dates]').innerHTML;
    document.querySelector('#delete-booking-confirmation [data-modal-content]').innerHTML = `<b>${booking_title}<b><br/>${booking_dates}`;
}

function onChangeUpdateTotalPrice(event) {
    let number_of_passengers = event.target.value;
    let price_per_passenger = event.target.dataset.bookingPricePerPassengerValue;
    let total_price_elem = event.target.closest('[data-booking]').querySelector('[data-booking-total-price]');

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

    total_price_elem.innerHTML = formatter.format(total_price);
}

document.querySelectorAll('[data-delete-link]').forEach(function (element) {
    element.onclick = onClickOpenModalDelete;
});

document.querySelectorAll('[data-booking-number-of-passengers]').forEach(function (element) {
    element.onchange = onChangeUpdateTotalPrice;
})