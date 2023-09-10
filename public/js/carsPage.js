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
      renderCars(cars);
    })
    .catch((err) => {
      console.log(err);
    });
}

// function showNotFound() {
//   notFoundContainer.classList.add("not-found--show");
// }

function renderCars(cars) {
  cars.forEach((car) => {
    renderCar(car);
  });
}

function renderCar(car) {
  const html = `
  <div class="car-wrapper">
    <div class="img-wrapper">
        <img alt="car" src="public/img/${car.image}" />
    </div>
    <div class="details-wrapper">
        <div class="car-details">
            <p class="car-model">${car.brand} ${car.model}</p>
            <p class="car-price">Od ${car.price}zł/dzień</p>
            <div class="stars">stars</div>
        </div>
        <button class="book">Book</button>
    </div>
</div>`;

  allCarsDiv.insertAdjacentHTML("beforeend", html);
}

getAllCars();
