# SimpleLoginSystem 

## Sistema de cadastro/login simples criado com o objetivo de colocar em prática meus conhecimentos em PHP, MySQL, HTML e CSS3. 

### Como funciona:
O funcionamento do sistema é bem simples e direto: o usuário pode efetuar login com uma conta já existente no banco de dados ou cadastrar uma nova.<br><br>
Optando pela segunda opção, o usuário precisará informar obrigatoriamente nome de usuário, email, data de nascimento, senha e confirmação de senha. <b>Não é permitido criar uma conta utilizando um username ou e-mail já existende no banco de dados</b><br><br>
Realizado o cadastro (ou login), o usuário é redirecionado para a página index.php, onde ele é chamado pelo username e tem a opção de realizar logoff. A mensagem de saudação é diferente com base na origem da navegação do usuário (se o usuário veio da página login ou se ele acabou de se cadastrar).
<br><br>
### Tecnologias presentes:
Este projeto foi desenvolvido usando as versões:<br>
PHP 8.2.18 🐘<br>
MySQL 8.3.0 🗃️<br>
PhpMyAdmin 5.2.1 🔰<br>
HTML5 🌐<br>
CSS3 🎨<br>
Docker Desktop 🐋
<br><br>
### Como usar/alterar o sistema na sua máquina:
1 - Clone o repositório na sua CLI usando git clone https://github.com/andrey-rsantos/SimpleLoginSystem.git
<br>
2 - Com o Docker Desktop aberto, inicie o CLI na pasta clonada digite: <b>docker-composer up --build</b>
<br>
3 - Caso queira acessar o banco de dados diretamente, os dados de acesso para o PhpMyAdmin são encontrados no arquivo conexao.php
<br><br><br>


## Algumas imagens e observações do sistema:
### Login:
![image](https://github.com/user-attachments/assets/859e3ad6-eab2-433e-8e5f-62183880851f)<br>
Caso a sua sessão não esteja iniciada, você é redirecionado para a página de login. Aqui você precisa inserir seu username ou email junto com a sua senha para efetuar login.
<br><br>
Se não tiver uma conta ou queira entrar com outra, basta clicar no link para se cadastrar.
<br><br>

### Cadastro:
![image](https://github.com/user-attachments/assets/0143e985-1840-412c-bcf0-2075c51bdba4)<br>
Se você não tiver uma conta ou queira cadastrar uma nova, o sistema tem um formulário para isso.
<br><br>
<b>Algumas observações sobre o cadastro:</b><br>
1 - Não é possível cadastrar uma conta com um username ou e-mail que já esteja cadastrado no banco de dados. ❌ <br>
2 - A data de nascimento não pode ser no futuro e o usuário não pode ter menos que 10 anos. 📆 <br>
3 - Os dois cmapos de senha precisam ser iguais e a senha precisa ter ao menos 6 dígitos 🔒 .
<br><br>

### Index (página principal)
A depender da página de onde o usuário veio (cadastro ou login), a mensagem de saudação da página index será diferente. Isso se dá por conta de uma requisição GET na URL. Exemplos abaixo:
<br><br>

<b>?from=login</b><br>
![image](https://github.com/user-attachments/assets/e31ef6b2-e64f-4d73-8f19-fdda9829cb27)
<br><br>

<b>?from=cadastro</b><br>
![image](https://github.com/user-attachments/assets/a4957673-551d-4f94-9519-27a801fe459d)

<br><br>

## Considerações finais: 
Com este projeto puder colocar em prática alguns dos conhecimentos que já tinha nas tecnologias utilizadas, além de aprender novas habilidades e funções. Destaco como um aprendizado importante deste projeto a manipulação de sessões utilizando comandos como <b>session_start()</b>, <b>session_destroy()</b>, entre outros. Este é o primeiro sistema de cadastro/login que posto aqui no Github e acredito que seja o mais completo que fiz até o momento. O tempo para o desenvolvido foi de aproximadamente 5 horas, sendo as primeiras 2 parar criar a base e as outras 3 em busca de refinar o projeto, testar e escrever este readme. 
<br><br>
Agradeço a todos que leram até aqui, bem como aos que clonaram o projeto e puderam testar em suas máquinas. Caso queiram dar alguma dica ou sugestão, sinta-se à vontade. Valeuu! 😉





