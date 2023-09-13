const allCarsDiv = document.querySelector(".allCars");

function getAllCars() {
  fetch("/getallcars", {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (cars) {
      if (!cars.length) {
        console.log("Brak aut");
      }
      renderCars(cars).then(() => rentHandler());
    })
    .catch((err) => {
      console.log(err);
    });
}

// function showNotFound() {
//   notFoundContainer.classList.add("not-found--show");
// }

function renderCars(cars) {
  return new Promise((res, rej) => {
    cars.forEach((car) => {
      renderCar(car);
    });
    res();
  });
}

function rentHandler() {
  const bookButtons = document.querySelectorAll(".book");
  const carIdValues = document.querySelectorAll(".car-id");
  const rentPopups = document.querySelectorAll(".rent-popup");
  const closeButtons = document.querySelectorAll(".close-button");
  const rentButtons = document.querySelectorAll(".rent-button");
  const pickUpDates = document.querySelectorAll(".pick-up-popup");
  const dropOffDates = document.querySelectorAll(".drop-off-popup");

  rentButtons.forEach((rentButton, index) => {
    rentButton.addEventListener("click", () => {
      const data = {
        car_id: carIdValues[index].textContent,
        start_date: new Date(pickUpDates[index].value),
        end_date: new Date(dropOffDates[index].value),
        total_cost: 400,
        status: "Active",
      };

      fetch("/rentcar", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      });
      rentPopups[index].style.display = "none";
      location.reload();
    });
  });

  closeButtons.forEach((closeButton, index) =>
    closeButton.addEventListener(
      "click",
      () => (rentPopups[index].style.display = "none")
    )
  );

  bookButtons.forEach((bookButton, index) =>
    bookButton.addEventListener(
      "click",
      () => (rentPopups[index].style.display = "flex")
    )
  );
}

function renderCar(car) {
  console.log(car.image);
  const html = `
  <div class="car-wrapper">
    <p class="car-id">${car.id}</p>
    <div class="img-wrapper">
        <img alt="car" src="public/img/${car.image}" />
    </div>
    <div class="details-wrapper">
        <div class="car-details">
            <p class="car-model">${car.brand} ${car.model}</p>
            <p class="car-price"><span class="car-price-span">${car.price}</span>zł/dzień</p>
        </div>
        <button class="book">Rent</button>
    </div>
  </div>
  <div class="rent-popup">
    <div class="rent-popup-wrapper">
      <button class="close-button">X</button>
      <div class="img-wrapper">
        <img alt="car" src="public/img/${car.image}" />
      </div>
      <label for="pick-up-popup">Pick-up date</label>
      <input id="pick-up-popup" class="pick-up-popup" name="pick-up" type="date" />
      <label for="drop-off-popup">Drop-off date</label>
      <input id="drop-off-popup" class="drop-off-popup" name="drop-off" type="date" />
      <button class="rent-button">Rent a car</button>
    </div>
  </div>
`;

  allCarsDiv.insertAdjacentHTML("beforeend", html);
}

getAllCars();
