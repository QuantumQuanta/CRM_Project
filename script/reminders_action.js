// **********open and close reminder form*************
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

// **********share with select dropdown from reminder form*************
$('select').selectpicker();
// $('#sherewith').attr('disabled',true);
// $("#selectedItems").prop("disabled", false);
// $(".selectpicker[data-id='selectedItems']").removeClass("disabled");
document.getElementById('sherewith').addEventListener('change', function () {
  var selectedOptions = this.selectedOptions;
  var selectedItemsDiv = document.getElementById('selectedItems');
  selectedItemsDiv.innerHTML = 'Selected items: ';

  // //console.log("selectedOptions",selectedOptions);
  for (var i = 0; i < selectedOptions.length; i++) {
    selectedItemsDiv.innerHTML += selectedOptions[i].text + ', ';
  }
});

// **********show hide text for today's reminder card*************
// document.querySelectorAll(".alert").forEach(function (alertElement) {
//   alertElement.addEventListener('click', function () {
//     let reminCardTexts = this.querySelectorAll(".reminCardText");

//     reminCardTexts.forEach(function (reminCardText) {
//       // Toggle styles based on the current state
//       if (reminCardText.style.overflow === "visible") {
//         reminCardText.style.overflow = "hidden";
//         reminCardText.style.whiteSpace = "nowrap";
//         reminCardText.style.textOverflow = "ellipsis";
//       } else {
//         reminCardText.style.overflow = "visible";
//         reminCardText.style.whiteSpace = "normal";
//         reminCardText.style.textOverflow = "unset";
//       }
//     });
//   });
// });

// **********calender javascript*************

const daysTag = document.querySelector(".days"),
  currentDate = document.querySelector(".current-date"),
  prevNextIcon = document.querySelectorAll(".icons span");

// getting new date, current year and month
let date = new Date(),
  currYear = date.getFullYear(),
  currMonth = date.getMonth();

// storing full name of all months in array
const months = ["January", "February", "March", "April", "May", "June", "July",
  "August", "September", "October", "November", "December"];

const renderCalendar = () => {
  let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
    lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
    lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
    lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
  let liTag = "";

  for (let i = firstDayofMonth; i > 0; i--) { // creating li of previous month last days
    liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
  }

  for (let i = 1; i <= lastDateofMonth; i++) {
    // creating li of all days of current month
    // adding active class to li if the current day, month, and year matched
    const currentDate = new Date(currYear, currMonth, i);

    // Format the date with two digits for day and month
    const day = currentDate.getDate().toString().padStart(2, '0');
    const month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
    const year = currentDate.getFullYear();

    // Create the formatted date string
    const formattedDate = `${year}-${month}-${day}`;
    // //console.log(formattedDate);

    let isToday = i === date.getDate() && currMonth === new Date().getMonth()
      && currYear === new Date().getFullYear() ? "active" : "";
    liTag += `<li class="${isToday}" data-value="${formattedDate}">${i}</li>`;
  }

  for (let i = lastDayofMonth; i < 6; i++) { // creating li of next month first days
    liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`
  }
  currentDate.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
  daysTag.innerHTML = liTag;
}
renderCalendar();

prevNextIcon.forEach(icon => { // getting prev and next icons
  icon.addEventListener("click", () => { // adding click event on both icons
    // if clicked icon is previous icon then decrement current month by 1 else increment it by 1
    currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

    if (currMonth < 0 || currMonth > 11) { // if current month is less than 0 or greater than 11
      // creating a new date of current year & month and pass it as date value
      date = new Date(currYear, currMonth, new Date().getDate());
      currYear = date.getFullYear(); // updating current year with new date year
      currMonth = date.getMonth(); // updating current month with new date month
    } else {
      date = new Date(); // pass the current date as date value
    }
    renderCalendar(); // calling renderCalendar function
  });
});


