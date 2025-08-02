function togglePassword(fieldId) {
  const field = document.getElementById(fieldId);
  const button = field.nextElementSibling.nextElementSibling;
  const icon = button.querySelector('i');

  if (field.type === 'password') {
    field.type = 'text';
    icon.classList.remove('fa-eye');
    icon.classList.add('fa-eye-slash');
  } else {
    field.type = 'password';
    icon.classList.remove('fa-eye-slash');
    icon.classList.add('fa-eye');
  }
}

function validatePassword() {
  const oldPassword = document.getElementById('old_password').value;
  const newPassword = document.getElementById('new_password').value;
  const confirmPassword = document.getElementById('confirm_password').value;
  const submitBtn = document.getElementById('submitBtn');

  // Length requirement
  const lengthReq = document.getElementById('length-req');
  if (newPassword.length >= 6) {
    lengthReq.classList.remove('invalid');
    lengthReq.classList.add('valid');
    lengthReq.querySelector('i').classList.remove('fa-times');
    lengthReq.querySelector('i').classList.add('fa-check');
  } else {
    lengthReq.classList.remove('valid');
    lengthReq.classList.add('invalid');
    lengthReq.querySelector('i').classList.remove('fa-check');
    lengthReq.querySelector('i').classList.add('fa-times');
  }

  // Match requirement
  const matchReq = document.getElementById('match-req');
  if (newPassword && confirmPassword && newPassword === confirmPassword) {
    matchReq.classList.remove('invalid');
    matchReq.classList.add('valid');
    matchReq.querySelector('i').classList.remove('fa-times');
    matchReq.querySelector('i').classList.add('fa-check');
  } else {
    matchReq.classList.remove('valid');
    matchReq.classList.add('invalid');
    matchReq.querySelector('i').classList.remove('fa-check');
    matchReq.querySelector('i').classList.add('fa-times');
  }

  // Different requirement
  const differentReq = document.getElementById('different-req');
  if (newPassword && oldPassword && newPassword !== oldPassword) {
    differentReq.classList.remove('invalid');
    differentReq.classList.add('valid');
    differentReq.querySelector('i').classList.remove('fa-times');
    differentReq.querySelector('i').classList.add('fa-check');
  } else {
    differentReq.classList.remove('valid');
    differentReq.classList.add('invalid');
    differentReq.querySelector('i').classList.remove('fa-check');
    differentReq.querySelector('i').classList.add('fa-times');
  }

  // Enable submit button if all requirements are met
  const allValid = lengthReq.classList.contains('valid') &&
    matchReq.classList.contains('valid') &&
    differentReq.classList.contains('valid') &&
    oldPassword.length > 0;

  submitBtn.disabled = !allValid;
}

// Add event listeners
document.getElementById('old_password').addEventListener('input', validatePassword);
document.getElementById('new_password').addEventListener('input', validatePassword);
document.getElementById('confirm_password').addEventListener('input', validatePassword);
