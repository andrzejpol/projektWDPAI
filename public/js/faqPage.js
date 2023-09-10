const allFaqsDiv = document.querySelector(".faq");

function getAllFaqs() {
  fetch("/getallfaqs", {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (faqs) {
      if (!faqs.length) {
        console.log("You don't have any faq.");
      }
      renderFaqs(faqs).then(() => {
        const questions = document.querySelectorAll(".question h2");
        const answers = document.querySelectorAll(".answer");
        let isOpen = false;
        questions.forEach((question, index) => {
          question.addEventListener("click", () => {
            if (isOpen) {
              answers[index].style.display = "none";
              isOpen = false;
            } else {
              answers[index].style.display = "block";
              isOpen = true;
            }
          });
        });
      });
    })
    .catch((err) => {
      console.log(err);
    });
}

function renderFaqs(faqs) {
  return new Promise((res, rej) => {
    faqs.forEach((faq) => {
      renderFaq(faq);
    });
    res();
  });
}

function renderFaq(faq) {
  const html = `
  <div class="question">
    <h2>${faq.question}</h2>
    <div class="answer">
        <p>${faq.answer}</p>
    </div>
</div>`;

  allFaqsDiv.insertAdjacentHTML("beforeend", html);
}

getAllFaqs();
