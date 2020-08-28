// Máscara do campo Telefone
var behavior = function (val) {
	return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
options = {
	onKeyPress: function (val, e, field, options) {
		field.mask(behavior.apply({}, arguments), options);
	}
};

//	Inicia a função ao carregar a pagina		
$(document).ready(function(){	 
	$('#TelefoneCliente').mask(behavior, options);		
});

	
//	Capturar endereço através do CEP

//	Limpar Formulário
function Clean_Form() {
	document.getElementById('EnderecoCliente').value=("");
	document.getElementById('BairroEnderecoCliente').value=("");
	document.getElementById('CidadeEnderecoCliente').value=("");
}

//	Callback
function callback(conteudo) {
	if (!("erro" in conteudo)) {
    	document.getElementById('EnderecoCliente').value=(conteudo.logradouro);
		document.getElementById('BairroEnderecoCliente').value=(conteudo.bairro);
        document.getElementById('CidadeEnderecoCliente').value=(conteudo.localidade);
    }else {
    	Clean_Form();
        alert("CEP não encontrado.");
    }
}
//	Pesquisa o endereço referente ao CEP informado
function pesquisacep(valor) {
	
	var cep = valor.replace(/\D/g, '');
	
	if (cep != "") {
		
		//	Expressão regular para validar o CEP.
		var validacep = /^[0-9]{8}$/;
		
		if(validacep.test(cep)) {

			document.getElementById('EnderecoCliente').value="...";
			document.getElementById('BairroEnderecoCliente').value="...";
			document.getElementById('CidadeEnderecoCliente').value="...";
			
			var script = document.createElement('script');

			script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=callback';
			document.body.appendChild(script);

		}else {
			
			Clean_Form();
				alert("Formato do CEP é inválido.");
        }
		
	} else {
		
		Clean_Form();
    }
};
