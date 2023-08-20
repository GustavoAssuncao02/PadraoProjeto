// flip dos Botoes, animação de girar os cards
const flipButton = document.getElementById('flipButton');
const flipBackButton = document.getElementById('flipBackButton');
const card = document.getElementById('card');

flipButton.addEventListener('click', function(event) {
  event.preventDefault();
  card.classList.toggle('flipped');
});

flipBackButton.addEventListener('click', function(event) {
  event.preventDefault();
  card.classList.toggle('flipped');
});

/*animação dos olhos do cadastro*/
const loginForm = document.querySelector('#login-form');
const characterEyes = loginForm.querySelector('.character .eyes');
const usernameInput = loginForm.querySelector('.username input');
const passwordInput = loginForm.querySelector('.password input');
const emailInput = loginForm.querySelector('.email input');

function updateEyeballPosition() {
  const totalLength = usernameInput.value.length + emailInput.value.length;
  const offset = totalLength * (100 / (usernameInput.maxLength + emailInput.maxLength));
  const value = Math.max(Math.min(offset, 90), 10);

  characterEyes.style.setProperty('--eye-ball-offset', `${value}%`);
}

usernameInput.addEventListener('input', updateEyeballPosition);
usernameInput.addEventListener('focus', updateEyeballPosition);
usernameInput.addEventListener('blur', updateEyeballPosition);

emailInput.addEventListener('input', updateEyeballPosition);
emailInput.addEventListener('focus', updateEyeballPosition);
emailInput.addEventListener('blur', updateEyeballPosition);

passwordInput.addEventListener('focus', function() {
  characterEyes.classList.add('closed');
});

passwordInput.addEventListener('blur', function() {
  characterEyes.classList.remove('closed');
});


//deixar o campo do cpf quando for digitar, ficar certo, ja ajustado com ponto e traço
//xxx.xxx.xxx-xx

document.addEventListener("DOMContentLoaded", function () {
  // aqui onde deixa no formato certo
  function formatarCPF(cpf) {
    cpf = cpf.replace(/\D/g, '');
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
    cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    return cpf;
  }

  
  const cpfInput = document.getElementById("cpf");
  cpfInput.addEventListener("input", function () {
    this.value = formatarCPF(this.value);

    // permiti apenas 11 números
    if (this.value.length > 14) {
      this.value = this.value.slice(0, 14);
    }
  });

  cpfInput.addEventListener("keypress", function (event) {
    const charCode = event.which ? event.which : event.keyCode;

    // deixa apenas numeros e alguns caracteres especiais ( . e -) para deixar certo
    if (
      (charCode >= 48 && charCode <= 57) || // numeros
      charCode === 8 || // espaço
      charCode === 0 || // charcode é tipo uma extenção que tem numeros correpondentes 
      charCode === 45 || // hífen
      charCode === 46 // ponto
    ) {
      return true;
    } else {
      event.preventDefault();
    }
  });

  
  // HREF=index.html Logar e Cadastro
  document.getElementById('buttonCadastro').addEventListener('click', function() {
    window.location.href = '../index.html';
  });

  document.getElementById('buttonLogin').addEventListener('click', function() {
    window.location.href = '../index.html';
  });

});
