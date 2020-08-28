# scgc-soparia

## Sistema de cadastramento e gestão de clientes (SCGC)

#### SCGC é um sistema bem simples, criado para facilitar o acesso aos endereços dos clientes da empresa A Soparia.

- ../
    
    - img
        - logo.png
    
    - js
        - mask.js                   *(mascara telefone e captura de endereço através do CEP)*
    
    - php
        - CallBackClientData.php    *(recupera os dados digitados pelo usuário em caso de falha durante o cadastro)*
        - Conn.php                  *(Conexão com o banco de dados asopariabd)*
        - functions.php             *(funções para cadastrar/solicitar/alterar/deletar dados do cliente)*
        - pages.php                 *(define qual parte do index.php deve ser mostrada ao usuário)*
    
    - index.php *Pagina principal*


> cliente refere-se à pessoa que será cadastrara no sistema pelo usuário (atendente).

Utilização atravéz do [XAMPP Server](https://www.apachefriends.org/pt_br/index.html) *(Estrutura do banco de dados encontra-se em ./php/asopariabd.sql)*