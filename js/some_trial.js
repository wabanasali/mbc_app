$(document).ready(function () {
    //Wire up the JQuery UI date pickers
    $("#fromDate").datepicker({
        onSelect: function (dateSelected, obj) {
            $(document).trigger("date-clicked", {
                date: dateSelected,
                source: this
            });
        }
    });
    $("#toDate").datepicker({
        onSelect: function (dateSelected, obj) {
            $(document).trigger("date-clicked", {
                date: dateSelected,
                source: this
            });
        }
    });

    //Get a custom binding event ready
    $(document).bind("date-clicked", function (e, data) {
        var confirmed = confirm("You picked the date: " + data.date + " from the input: " + $(data.source).attr("id"));
        console.log("User confirmed: " + confirmed);
    });
});

// here below is the js for the modal
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
// var btn = document.getElementById("myBtn");
var btn = document.getElementById("cash_in_button");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}