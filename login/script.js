document.addEventListener("DOMContentLoaded", function () {
  // Singleton pra tratamento de erro (mensagem)
  class ErrorHandling {
    constructor() {
      this.errors = [];
    }

    addError(message) {
      this.errors.push(message);
    }

    displayErrors() {
      alert(this.errors.join("\n"));
      this.clearErrors();
    }

    clearErrors() {
      this.errors = [];
    }
  }

  const errorHandling = new ErrorHandling();
  

// Validaçao do lgin (erro login campos vazios)
function validateLoginFields() {
  const email = document.getElementById("nomelog").value.trim();
  const senha = document.getElementById("senhalog").value.trim();

  const fieldsToValidate = [
    { name: "E-mail de Usuário", value: email },
    { name: "Senha de Usuário", value: senha }
  ];

  errorHandling.clearErrors();

  for (const field of fieldsToValidate) {
    if (!field.value) {
      errorHandling.addError(`O campo ${field.name} precisa ser preenchido.`);
    }
  }

  if (errorHandling.errors.length > 0) {
    errorHandling.displayErrors();
    return false;
  }

  return true;
}


const loginButton = document.getElementById("buttonLogin");
loginButton.addEventListener("click", function (event) {
  if (!validateLoginFields()) {
    event.preventDefault();
  } else {
      window.location.href = "perfil_usuario.php";
  }
});


  // Função para formatar CPF
  function formatarCPF(cpf) {
    cpf = cpf.replace(/\D/g, '');
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
    cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    return cpf;
  }

  // Validaçao do cadastro (erro cadastro campos vazios)
  function validateCadastroFields() {
    const nome = document.getElementById("nome").value.trim();
    const email = document.getElementById("email").value.trim();
    const senha = document.getElementById("senha").value.trim();
    const data = document.getElementById("data").value.trim();
    const cpf = document.getElementById("cpf").value.trim();

    const fieldsToValidate = [
      { name: "Nome de Cadastro", value: nome },
      { name: "E-mail de Cadastro", value: email },
      { name: "Senha de Cadastro", value: senha },
      { name: "Data de Nascimento", value: data },
      { name: "CPF", value: cpf }
    ];

    errorHandling.clearErrors();

    for (const field of fieldsToValidate) {
      if (!field.value) {
        errorHandling.addError(`O campo ${field.name} precisa ser preenchido.`);
      }
    }

    if (errorHandling.errors.length > 0) {
      errorHandling.displayErrors();
      return false;
    }

    return true;
  }

  // se n tiver em branco, continua
  const cadastrarButton = document.getElementById("buttonCadastro");
  cadastrarButton.addEventListener("click", function (event) {
    if (!validateCadastroFields()) {
      event.preventDefault();
    } else {
      window.location.href = "perfil_usuario.php";
    }
  });

  // Flip dos Botoes, animação de girar os cards
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

  /* Animação dos olhos do cadastro */
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

  // Formatação do campo CPF
  const cpfInput = document.getElementById("cpf");
  cpfInput.addEventListener("input", function () {
    this.value = formatarCPF(this.value);

    // Permiti apenas 14 caracteres no máximo
    if (this.value.length > 14) {
      this.value = this.value.slice(0, 14);
    }
  });

  cpfInput.addEventListener("keypress", function (event) {
    const charCode = event.which ? event.which : event.keyCode;

    // Deixa apenas números e alguns caracteres especiais ( . e -) para deixar certo
    if (
      (charCode >= 48 && charCode <= 57) || // Números
      charCode === 8 || // Espaço
      charCode === 0 || // Charcode é tipo uma extensão que tem números correspondentes 
      charCode === 45 || // Hífen
      charCode === 46 // Ponto
    ) {
      return true;
    } else {
      event.preventDefault();
    }
  });
});


