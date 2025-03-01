<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Metadados da página -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Plataforma completa para freelancers e autônomos, unindo o gerenciamento do tempo e a administração do dinheiro em um só lugar.">

        <!-- Configurações e definição da URL base para os caminhos de importação -->
        <?php require dirname(dirname(dirname(__DIR__))) . '/config/config.php'; ?>
        <base href="<?php echo BASE_URL; ?>">

        <!-- Importação de arquivos CSS -->
        <link rel="stylesheet" href="public/css/pages/home.css?v=<?php filemtime('public/css/pages/home.css'); ?>">
        <link rel="stylesheet" href="public/css/tailwind.css?v=<?php filemtime('public/css/tailwind.css'); ?>">">
        
        <!-- Imagem e texto de título da página -->
        <link rel="icon" href="public/media/global/favicon.ico" />
        <title>Freela Flow Manager</title>
    </head>

    <body>
        <!-- Div onde o aplicativo Vue será montado -->
        <div id="app"></div>
        
        <!-- Cabeçalho da página -->
        <header>
            <nav class="navbar flex justify-between">
                <div class="logo content-center">
                    <!-- Link para a página inicial (TROCAR href AO EXECUTAR auto_upl.py) -->
                    <a href="/src/views/home/home.php"> <!-- Live Share: "/src/views/home/home.php" - Website: "/") -->
                        <h1 class="website_name inline align-middle">Freela </h1>
                        <img src="public/media/global/favicon2.ico" alt="FFM Icon" class="website_icon inline">
                        <h1 class="website_name inline align-middle">Manager</h1>
                    </a>
                </div>

                <div class="page_options content-center">
                    <a href="/?page=placeholder"><h2 class="page n1 inline">Opção 1</h2></a>
                    <a href="/?page=placeholder"><h2 class="page n2 inline">Opção 2</h2></a>
                    <a href="/?page=placeholder"><h2 class="page n3 inline">Opção 3</h2></a>
                </div>

                <div class="auth_options content-center">
                    <a href="/?page=placeholder" class="signin_btn">Cadastrar</a>
                    <a href="/?page=placeholder" class="login_btn">Entrar</a>
                </div>
            </nav>
        </header>
        
        <!-- Conteúdo principal da página -->
        <main>
            <!-- Conteúdo dinâmico será inserido aqui -->
        </main>

        <!-- Rodapé da página -->
        <footer>
            <!-- Conteúdo do rodapé -->
        </footer>

        <!-- Importação do arquivo JavaScript compilado pelo Webpack -->
        <script src="/dist/bundle.js?v=<?php filemtime('/dist/bundle.js'); ?>"></script>
    </body>
</html>
