# Stock Management
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)
![MySQL](https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white)
![CSS](https://img.shields.io/badge/css-%23663399.svg?style=for-the-badge&logo=css&logoColor=white)

O Stock Management é uma aplicação web desenvolvida para controlar produtos, entradas e saídas, além de monitorar os níveis de estoque em tempo real. O sistema oferece às empresas de pequeno e médio porte uma visão clara e organizada de seus recursos e colaboradores, promovendo maior eficiência nas práticas do dia a dia e aprimorando a gestão e o controle empresarial.  

### 🛠️ Funcionalidades
- Cadastro e gerenciamento de produtos  
- Controle de entradas e saídas de estoque  
- Monitoramento em tempo real dos níveis de estoque  
- Interface simples e intuitiva para colaboradores  

---

### 🧠 Objetivo do Projeto
Este projeto **não tem foco em produção**.  
O objetivo principal é demonstrar conhecimentos em desenvolvimento **fullstack web** e aplicar **boa lógica de programação**, explorando conceitos como POO, MVC e CRUD.  
Serve como portfólio e estudo prático de arquitetura e boas práticas de desenvolvimento.

### 📚 Conhecimentos aplicados

Durante o desenvolvimento foram utilizados conceitos e boas práticas de programação e arquitetura de software, como:

- POO (Programação Orientada a Objetos):  
  Estruturação em classes e objetos

- MVC (Model-View-Controller):  
  Separação entre Model, View e Controller

- CRUD (Create, Read, Update, Delete):  
  Operações de criação, leitura, atualização e exclusão

- Autenticação e Autorização:  
  Controle de acesso por perfis

- Criação e Consumo de APIs Internas:   
  Desenvolvimento de endpoints REST para o próprio sistema e consumo dessas APIs pelo frontend.

---

## 🛠 Instalação do Projeto

Siga os passos abaixo para configurar o ambiente de desenvolvimento e instalar o projeto localmente.

### 🔄 1. Clonar o Repositório

Para clonar o repositório, utilize o seguinte comando:


```bash
git clone https://github.com/Harley-7/gerenciamento-estoque.git
```


### 📂 2. Navegar até o Diretório do Projeto

Depois de clonar, entre no diretório do projeto com:


```bash
cd gerenciamento-estoque
```


### 📦 3. Instalar Dependências

Para instalar todas as dependências do projeto, você pode utilizar o comando abaixo:


```bash
composer install
```

### ⚙️ 4. Configurar Variáveis de Ambiente

Crie um arquivo .env na raiz do projeto, utilizando o arquivo de exemplo como base. Para isso, copie o arquivo .env.example com o seguinte comando:


```bash
cp .env.example .env
```


### 🛢 5. Criar o Banco de dados

O script para criação do banco de dados e tabelas está disponível no arquivo **banco.sql**.

#### Executando no MySQL Prompt
1. Abra o terminal ou prompt de comando.
2. Acesse o diretório do projeto e use o comando abaixo:

```bash
mysql -u root -p < banco.sql
``` 

### 🚀 6. Iniciar o Servidor de Desenvolvimento

Para iniciar o servidor de desenvolvimento, utilize o comando abaixo:


```bash
php -S localhost:8000 -t public
```
Após iniciar o servidor, o projeto estará disponível para uso diretamente no navegador, no seguinte endereço: http://localhost:8000
