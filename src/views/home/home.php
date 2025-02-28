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
        <link rel="stylesheet" href="public/css/pages/home.css">
        
        <!-- Imagem e texto de título da página -->
        <link rel="icon" href="public/media/global/favicon.ico" />
        <title>Freela Flow Manager</title>
    </head>

    <body>
        <!-- Div onde o aplicativo Vue será montado -->
        <div id="app"></div>
        
        <!-- Cabeçalho da página -->
        <header>
            <nav>
                <div class="logo">
                    <!-- Link para a página inicial -->
                    <a href="/">
                        <!-- Nome do site e logo -->
                        <h1 class="website_name inline">Freela </h1>
                        <img src="public/media/global/favicon2.ico" alt="FFM Icon" class="website_icon inline">
                        <h1 class="website_name inline">Manager</h1>
                    </a>
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
        <script src="/dist/bundle.js"></script>
    </body>
</html>
