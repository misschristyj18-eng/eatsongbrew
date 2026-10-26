document.addEventListener('DOMContentLoaded', () => {
  const authForms = document.querySelectorAll('form');
  authForms.forEach((form) => {
    form.addEventListener('submit', (event) => {
      const email = form.querySelector('input[type="email"]');
      const password = form.querySelector('input[type="password"]');

      if (email && password && (!email.value || !password.value)) {
        event.preventDefault();
        alert('Please complete both email and password fields.');
      }
    });
  });
});
