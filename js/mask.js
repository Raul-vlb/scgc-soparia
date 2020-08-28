// Máscara telefone
		
		var behavior = function (val) {
    			return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
		},	
		options = {
    		onKeyPress: function (val, e, field, options) {
        		field.mask(behavior.apply({}, arguments), options);
    		}
		};
		
		
		$(document).ready(function(){	 
			$('#TelefoneCliente').mask(behavior, options);		
		});

	
//Buscar e adicionar o endereço através do CEP

		function Clean_Form() {
            document.getElementById('EnderecoCliente').value=("");
            document.getElementById('BairroEnderecoCliente').value=("");
            document.getElementById('CidadeEnderecoCliente').value=("");
            //document.getElementById('EstadoEnderecoCliente').value=("");
    		}

	    function meu_callback(conteudo) {
        		if (!("erro" in conteudo)) {
            		document.getElementById('EnderecoCliente').value=(conteudo.logradouro);
					document.getElementById('BairroEnderecoCliente').value=(conteudo.bairro);
            		document.getElementById('CidadeEnderecoCliente').value=(conteudo.localidade);
					//document.getElementById('EstadoEnderecoCliente').value=(conteudo.uf);
        		} 
	        else {
    		        Clean_Form();
        		    alert("CEP não encontrado.");
        		}
    		}
        
    		function pesquisacep(valor) {
        		var cep = valor.replace(/\D/g, '');

        		if (cep != "") {

            		//Expressão regular para validar o CEP.
            		var validacep = /^[0-9]{8}$/;

            		if(validacep.test(cep)) {

                		document.getElementById('EnderecoCliente').value="...";
                		document.getElementById('BairroEnderecoCliente').value="...";
                		document.getElementById('CidadeEnderecoCliente').value="...";
                		//document.getElementById('EstadoEnderecoCliente').value="...";

                		var script = document.createElement('script');

                		script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                		document.body.appendChild(script);

            		}
           		else {
                		Clean_Form();
                		alert("Formato do CEP é inválido.");
            		}
        		} 
        		else {
            		Clean_Form();
        		}
    		};
