const elements = {
  showRegistrationForm: document.querySelector('[data-register="show"]'),
  hideRegistrationForm: document.querySelector('[data-register="hide"]'),
  registrationForm: document.querySelector('[data-form="register"]'),
  loginForm: document.querySelector('[data-form="login"]'),
};

const showRegistrationForm = () => {
  elements.registrationForm.style.display = 'block';
  elements.loginForm.style.display = 'none';
};

const hideRegistrationForm = () => {
  elements.registrationForm.style.display = 'none';
  elements.loginForm.style.display = 'block';
};

elements.showRegistrationForm.addEventListener('click', showRegistrationForm);
elements.hideRegistrationForm.addEventListener('click', hideRegistrationForm);
