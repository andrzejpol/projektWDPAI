const emailInput = document.querySelector("input[name='email']");
const emailError = document.getElementById("error");

class LoginView {
  messages = {
    email: "Please enter a valid email.",
  };

  constructor() {
    emailInput.addEventListener("keyup", this._validateEmail.bind(this));
  }

  _validateEmail() {
    setTimeout(() => {
      const isValid = this._isEmail(emailInput.value);
      isValid
        ? this._deleteMessage(error)
        : this._setMessage(error, this.messages.email);
    }, 1000);
  }

  _deleteMessage(element) {
    element.innerHTML = "";
  }

  _setMessage(element, message) {
    element.innerHTML = message;
  }

  _isEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
  }
}

const loginForm = new LoginView();
