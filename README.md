# ProjetoFinal


# EsplanApp - Aplicação Web para Gestão de Pedidos em Estabelecimentos

## Descrição

O EsplanApp é uma aplicação web desenvolvida para otimizar a interação entre clientes e funcionários em bares, esplanadas e restaurantes. Através da leitura de um QR Code presente nas mesas, os clientes podem aceder ao menu digital e realizar pedidos diretamente dos seus dispositivos móveis. Os pedidos são então apresentados numa interface administrativa para uma gestão eficiente por parte dos funcionários.

## Funcionalidades Principais

* **Pedido via QR Code:** Acesso ao menu digital através da leitura de um QR Code único por mesa.
* **Gestão de Sessão por Mesa:** Identificação automática da mesa através do parâmetro `mesa` na URL.
* **Interface de Backoffice:** Plataforma administrativa para gestão do menu e visualização de pedidos.
* **Gestão de Menu (CRUD):** Funcionalidade para criar, ler, atualizar e eliminar produtos do menu através do backoffice.
* **Visualização de Pedidos:** Interface para os funcionários visualizarem os pedidos em tempo real.

## Arquitetura

O EsplanApp segue um padrão de arquitetura **Model-View-Controller (MVC)** para a organização do código, promovendo a separação de responsabilidades e a manutenibilidade.

## Configuração

As configurações principais da aplicação ESPLANAPP são geridas através do ficheiro `config.php`, localizado na raiz do projeto. Este ficheiro contém constantes PHP que definem parâmetros cruciais para o funcionamento da aplicação, tais como a ligação à base de dados, configurações de email e URLs base.

**Alteração das Variáveis de Ambiente:**

Para personalizar a aplicação para diferentes ambientes (e.g., outro servidor, configurações de email distintas), é necessário modificar os valores das constantes definidas no ficheiro `config.php`.

**Passos para Modificar as Variáveis:**

1.  **Acesso ao Ficheiro:** Utilize um editor de texto ou um cliente FTP (como o FileZilla) para aceder e abrir o ficheiro `config.php` no seu servidor.

2.  **Edição das Constantes:** Localize as seguintes secções e modifique os valores das constantes conforme necessário para o seu ambiente:

    * **Configurações Gerais da Aplicação:**
        ```php
        define('APP_NAME', 'ESPLANAPP'); // Nome da aplicação
        define('APP_VERSION', '1.0.0'); // Versão da aplicação
        define('BASE_URL', '[https://seudominio.com/Esplanapp/public/](https://seudominio.com/Esplanapp/public/)'); // URL base da aplicação
        ```
        * `BASE_URL`: Altere para o URL onde a sua aplicação estará acessível. Certifique-se de incluir o caminho correto para a pasta `public`.

    * **Configurações da Base de Dados MySQL:**
        ```php
        define('MYSQL_SERVER',      'servidor_mysql'); // Endereço do servidor MySQL
        define('MYSQL_DATABASE',    'nome_da_base_de_dados'); // Nome da base de dados
        define('MYSQL_USER',        'nome_de_utilizador'); // Nome de utilizador da base de dados
        define('MYSQL_PASS',        'palavra_passe'); // Palavra-passe da base de dados
        ```
        * Substitua os valores de `MYSQL_SERVER`, `MYSQL_DATABASE`, `MYSQL_USER` e `MYSQL_PASS` pelas credenciais da sua base de dados MySQL.

    * **Configurações de Email (PHPMailer):**
        ```php
        define('EMAIL_HOST',        'servidor_smtp'); // Servidor SMTP para envio de emails
        define('EMAIL_FROM',        'seu_email@dominio.com'); // Endereço de email remetente
        define('EMAIL_PASS',        'palavra_passe_email'); // Palavra-passe da conta de email
        define('EMAIL_PORT',        587); // Porta do servidor SMTP (comummente 465 para SSL/TLS ou 587 para STARTTLS)
        ```
        * Atualize `EMAIL_HOST`, `EMAIL_FROM`, `EMAIL_PASS` e `EMAIL_PORT` com as configurações do seu servidor de email. Verifique a documentação do seu provedor de email para obter os valores corretos.

    * **Outras Constantes:**
        As restantes constantes (`ESTADO`, `AES_KEY`, `AES_IV`) definem estados da aplicação e chaves de encriptação. Geralmente, não é necessário alterá-las a menos que tenha requisitos específicos de segurança ou fluxos de trabalho diferentes.

3.  **Guardar as Alterações:** Após modificar os valores necessários, guarde as alterações no ficheiro `config.php`.

**Importante:**

* Tenha cuidado ao editar este ficheiro, pois configurações incorretas podem impedir o funcionamento da aplicação.
* Mantenha as suas credenciais de base de dados e email em segurança e não as partilhe publicamente.

## Acesso à Aplicação

### Front-end (Interface do Cliente)

O acesso à interface do cliente é realizado através da leitura de um QR Code localizado nas mesas do estabelecimento.

1.  **Leitura do QR Code:** O cliente utiliza a aplicação de leitura de QR Codes do seu dispositivo móvel para digitalizar o código presente na mesa.

2.  **Acesso ao Menu via URL:** A leitura do QR Code direciona o dispositivo para um URL específico, contendo um parâmetro que identifica a mesa. Exemplo:
    ```
    https://<BASE_URL>?a=menu&mesa=<ID_DA_MESA>
    ```
    * `<BASE_URL>`: Corresponde ao valor definido na constante `BASE_URL` no ficheiro `config.php`.
    * `?a=menu`: Indica a ação a ser executada pela aplicação (neste caso, exibir o menu).
    * `&mesa=<ID_DA_MESA>`: A variável `mesa` no método GET identifica a mesa específica a que o cliente está associado. O valor `<ID_DA_MESA>` será dinâmico, codificado no QR Code de cada mesa.

3.  **Sessão da Mesa:** Ao aceder ao URL, a aplicação inicia uma sessão para a mesa identificada pelo parâmetro `mesa`, permitindo que o cliente visualize o menu e realize pedidos associados a essa mesa.

### Backoffice (Interface de Administração)

O acesso à interface de administração para os funcionários é feito através de um URL específico.

1.  **Acesso via Navegador:** Num navegador web, o funcionário deve aceder ao seguinte endereço:
    ```
    https://<BASE_URL>admin/?a=admin_login
    ```
    * `<BASE_URL>`: Corresponde ao valor definido na constante `BASE_URL` no ficheiro `config.php`.
    * `admin/?a=admin_login`: Indica o caminho e a ação para exibir a página de login do backoffice.

2.  **Credenciais de Acesso:** Na página de login, são solicitadas as credenciais de acesso (email e palavra-passe). As credenciais de exemplo são:
    * **Email:** `lemm.pt@gmail.com`
    * **Palavra-passe:** `123456`
    * **Nota:** Estas são credenciais de exemplo e deverão ser alteradas e geridas de forma segura na base de dados da aplicação para um ambiente de produção.

3.  **Funcionalidades do Backoffice:** Após a autenticação, o funcionário terá acesso às funcionalidades de gestão da aplicação, incluindo a gestão do menu (inserção, edição, remoção de produtos) e a visualização e gestão de pedidos.
