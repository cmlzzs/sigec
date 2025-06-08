(function(){
    $('#msbo').on('click', function(){
      $('body').toggleClass('msb-x');
    });
  }());


  function truncateText(elementId, maxLength) {
    let element = document.getElementById(elementId);
    if (element.textContent.length > maxLength) {
        element.textContent = element.textContent.substring(0, maxLength) + '...';
    }
}

function updatePreview() {
  // obtendo os valores dos campos de entrada ou definindo valores padrão
  let nome = document.getElementById('nome').value || 'NOME';
  let matricula = document.getElementById('matricula').value || 'Matrícula';
  let funcao = document.getElementById('funcao').value || 'Cargo';
  let setor = document.getElementById('setor').value || 'Setor';

  // atualizando os textos nos elementos do crachá
  document.getElementById('previewNome').textContent = nome;
  document.getElementById('previewMatricula').textContent = matricula;
  document.getElementById('previewFuncao').textContent = funcao;
  document.getElementById('previewSetor').textContent = setor;

  // truncando textos longos para manter o layout do crachá
  truncateText('previewNome', 20);
  truncateText('previewMatricula', 15);
  // Ajustando somente a fonte para "Função" e "Setor"
  adjustFontSize('previewFuncao', 12, 10);
  adjustFontSize('previewSetor', 12, 10);

  // carregar  e atualizar foto
  let fotoInput = document.getElementById('foto');
  let previewFoto = document.getElementById('previewFoto');
  if (fotoInput && fotoInput.files && fotoInput.files[0]) {
      let reader = new FileReader();
      reader.onload = function(e) {
          previewFoto.src = e.target.result; // atualiza a imagem do crachá
          previewFoto.style.display = 'block'; // exibe a imagem
      };
      reader.readAsDataURL(fotoInput.files[0]);
  } //else {
      //previewFoto.style.display = 'none'; // esconde a imagem se não houver arquivo
 // }
}

function truncateText(elementId, maxLength) {
  let element = document.getElementById(elementId);
  if (element.textContent.length > maxLength) {
      element.textContent = element.textContent.substring(0, maxLength) + '...';
  }
}

function adjustFontSize(elementId, maxFontSize = 10, minFontSize = 10) {
  let element = document.getElementById(elementId);
  // Define inicialmente o tamanho máximo da fonte
  element.style.fontSize = maxFontSize + 'px';
  
  // enquanto o conteúdo exceder a largura do contêiner e o tamanho da fonte for maior que o mínimo...
  while (element.scrollWidth > element.clientWidth && maxFontSize > minFontSize) {
    maxFontSize--;
    element.style.fontSize = maxFontSize + 'px';
  }
}

function dropDown() {
    document.querySelector('#submenu').classList.toggle('hidden');
    document.querySelector('#arrow').classList.toggle('rotate-0');
  }

  function Openbar() {
    document.querySelector('.sidebar').classList.toggle('left-[-300px]');
  }

  //
  /*function baixarCrachas() {
    const element = document.getElementById('area-pdf');
    // cria uma nova instância do html2pdf
    // element será transformado em PDF
    html2pdf().from(element).set({
        margin: 0,
        // nome do arquivo
        filename: 'crachas.pdf',
        html2canvas: { scale: 2 },
        // tamanho da página e orientação, portrait é na vertical
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
    }).save();
}
    */

 function validateEmail() {
        let emailInput = document.getElementById("email");
        let errorMessage = document.getElementById("emailError");

        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailPattern.test(emailInput.value)) {
            errorMessage.innerText = "O e-mail digitado não é válido.";
        } else {
            errorMessage.innerText = "";
        }
    }
     function validatePasswordMatch() {
        let password = document.getElementById("password").value;
        let confirmPassword = document.getElementById("password_confirmation").value;
        let errorMessage = document.getElementById("passwordConfirmError");

        if (confirmPassword.length > 0 && password !== confirmPassword) {
            errorMessage.innerText = "As senhas não conferem.";
        } else {
            errorMessage.innerText = "";
        }
    }
    function validateMatricula(){
      let matriculaInput = document.getElementById("matricula");
      let errorMessage = document.getElementById("matriculaError")
       if (!/^\d+$/.test(matriculaInput.value)) {
            errorMessage.innerText = "A matrícula deve conter apenas números";
        } else {
            errorMessage.innerText = "";
        }
    }


  document.getElementById("exportPdf").addEventListener("click", function() {
    window.location.href = "/export-pdf";
  });





