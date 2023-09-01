const usernameInput = document.querySelector("input[name='username']");
const emailInput = document.querySelector("input[name='email']");
const passwordInput = document.querySelector("input[name='password']");
const confirmInput = document.querySelector("input[name='confirmPassword']");

const error = document.getElementById("error");

class RegisterView {
  messages = {
    username: "Username must be at least 2 characters long.",
    email: "Please enter a valid email.",
    password: "Password must be at least 6 characters long.",
    confirm: "Entered password don't match",
  };

  constructor() {
    usernameInput.addEventListener("keyup", this._validateUsername.bind(this));
    emailInput.addEventListener("keyup", this._validateEmail.bind(this));
    passwordInput.addEventListener("keyup", this._validatePassword.bind(this));
    confirmInput.addEventListener(
      "keyup",
      this._validateConfirmedPassword.bind(this)
    );
  }

  _validateUsername() {
    setTimeout(() => {
      const isValid = this._min(usernameInput.value, 2);
      isValid
        ? this._deleteMessage(error)
        : this._setMessage(error, this.messages.username);
    }, 1000);
  }

  _validateEmail() {
    setTimeout(() => {
      const isValid = this._isEmail(emailInput.value);
      isValid
        ? this._deleteMessage(error)
        : this._setMessage(error, this.messages.email);
    });
  }

  _validatePassword() {
    setTimeout(() => {
      const isValid = this._min(passwordInput.value, 6);
      isValid
        ? this._deleteMessage(error)
        : this._setMessage(error, this.messages.password);
    }, 1000);
  }

  _validateConfirmedPassword() {
    setTimeout(() => {
      const isValid = this._arePasswordSame(
        passwordInput.value,
        confirmInput.value
      );
      isValid
        ? this._deleteMessage(error)
        : this._setMessage(error, this.messages.confirm);
    }, 1000);
  }

  _deleteMessage(element) {
    element.innerHTML = "";
  }

  _setMessage(element, message) {
    element.innerHTML = message;
  }

  _min(string, minLength) {
    return string.length >= minLength;
  }

  _isEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
  }

  _arePasswordSame(password, confirmedPassword) {
    return password === confirmedPassword;
  }
}

const registerForm = new RegisterView();
