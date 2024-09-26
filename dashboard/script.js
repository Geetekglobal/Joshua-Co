document.getElementById('sessionType').addEventListener('change', function() {
    var otherSessionTypeContainer = document.getElementById('otherSessionTypeContainer');
    if (this.value === 'others') {
        otherSessionTypeContainer.style.display = 'block';
    } else {
        otherSessionTypeContainer.style.display = 'none';
    }
});


function handleActionChange(event, bookingId) {
    const action = event.target.value;
    const form = document.getElementById(`actionForm${bookingId}`);
    const actionInput = document.getElementById(`action${bookingId}`);

    if (action === "cancel") {
        if (confirm("Are you sure you want to cancel this session? This will delete the booking permanently.")) {
            actionInput.value = "cancel";
            form.submit();
        }
    } else if (action === "reschedule") {
        actionInput.value = "reschedule";
        document.getElementById('rescheduleBookingId').value = bookingId;
        const rescheduleModal = new bootstrap.Modal(document.getElementById('rescheduleModal'));
        rescheduleModal.show();
    } else if (action === "done") {
        actionInput.value = "done";
        form.submit();
    }
}