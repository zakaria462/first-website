function showSignUp() {
    const hiThereMessage = document.getElementById("move_div_left");
    const moveFormRight = document.getElementById("move_form_right");
    const moveFormLeft = document.getElementById("move_form_left");
    const welcomeBackMessage = document.getElementById("move_div_right");
    const signIn_form = document.getElementById("test1");
    const createAccount_form = document.getElementById("test2");
    const hiThere = document.getElementById("test3");
    const welcomeBack = document.getElementById("test4");
  
    signIn_form.classList.add("display_none");
    signIn_form.classList.remove("display_block");
    createAccount_form.classList.add("display_block");
    createAccount_form.classList.remove("display_none");
    hiThere.classList.add("display_none");
    hiThere.classList.remove("display_block");
    welcomeBack.classList.add("display_block");
    welcomeBack.classList.remove("display_none");
  
    hiThereMessage.classList.add("move_left");
    hiThereMessage.classList.remove("moveRightOriginal");
    welcomeBackMessage.classList.add("move_left");
    welcomeBackMessage.classList.remove("moveRightOriginal");
  
    moveFormRight.classList.add("move_right");
    moveFormRight.classList.remove("moveLeftOriginal");
  
    moveFormLeft.classList.add("move_right");
    moveFormLeft.classList.remove("moveLeftOriginal");
  }
  
  function showSignIn() {
    const hiThereMessage = document.getElementById("move_div_left");
    const moveFormRight = document.getElementById("move_form_right");
    const moveFormLeft = document.getElementById("move_form_left");
    const welcomeBackMessage = document.getElementById("move_div_right");
    const signIn_form = document.getElementById("test1");
    const createAccount_form = document.getElementById("test2");
    const hiThere = document.getElementById("test3");
    const welcomeBack = document.getElementById("test4");
  
    hiThereMessage.classList.remove("move_left");
    hiThereMessage.classList.add("moveRightOriginal");
    welcomeBackMessage.classList.remove("move_left");
    welcomeBackMessage.classList.add("moveRightOriginal");
  
    signIn_form.classList.add("display_block");
    signIn_form.classList.remove("display_none");
    createAccount_form.classList.add("display_none");
    createAccount_form.classList.remove("display_block");
    hiThere.classList.add("display_block");
    hiThere.classList.remove("display_none");
    welcomeBack.classList.add("display_none");
    welcomeBack.classList.remove("display_block");
  
    moveFormRight.classList.remove("move_right");
    moveFormRight.classList.add("moveLeftOriginal");
  
    moveFormLeft.classList.add("moveLeftOriginal");
    moveFormLeft.classList.remove("move_right");
  }
  const emailInput = document.getElementById('check_login_email');
  const passwordInput = document.getElementById('check_login_password');
  
  emailInput.addEventListener('focus', () => {
    emailInput.classList.add('input_focus');
  });
  
  emailInput.addEventListener('blur', () => {
    emailInput.classList.remove('input_focus');
  });
  
  passwordInput.addEventListener('focus', () => {
    passwordInput.classList.add('input_focus');
  });
  
  passwordInput.addEventListener('blur', () => {
    passwordInput.classList.remove('input_focus');
  });