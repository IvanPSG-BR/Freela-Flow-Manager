<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-X0ST7CV8KR"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-X0ST7CV8KR');
        </script>

        <!-- Metadados da página -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Plataforma completa para freelancers e autônomos, unindo o gerenciamento do tempo e a administração do dinheiro em um só lugar.">

        <!-- Configurações e definição da URL base para os caminhos de importação -->
        <?php require dirname(dirname(dirname(__DIR__))) . '/config/config.php'; ?>
        <base href="<?php echo BASE_URL; ?>">

        <!-- Importação de arquivos CSS -->
        <link rel="stylesheet" href="public/css/tailwind.css<?php //echo "?v=" . filemtime('public/css/tailwind.css'); ?>">         
        <link rel="stylesheet" href="public/css/pages/home.css<?php //echo "?v=" . filemtime('public/css/pages/home.css'); ?>">
        
        <!-- Imagem e texto de título da página -->
        <link rel="icon" href="public/media/global/favicon.ico" />
        <title>Freela Flow Manager</title>
        
    </head>

    <body>
        <!-- Div onde o aplicativo Vue será montado -->
        <div id="app"></div>
        
        <!-- Cabeçalho da página -->
        <header class="flex justify-between">

            <div class="logo flex place-items-center p-1 transition delay-100 duration-300 ease-initial hover:scale-110 hover:translate-2">
                <!-- Link para a página inicial (TROCAR href AO EXECUTAR auto_upl.py) -->
                <a href="/src/views/home/home.php"> <!-- Live Share: "/src/views/home/home.php" - Website: "/") -->
                    <h1 class="website_name text-2xl md:text-3xl lg:text-4xl inline align-middle">
                        Freela 
                        <img src="public/media/global/favicon2.ico" alt="FFM Icon" class="website_icon w-10 md:w-12 lg:w-14 h-auto inline"> 
                        Manager
                    </h1>
                </a>
            </div>

            <nav class="navbar flex place-items-center">

                <a href="/?page=placeholder" class="page1 text-xs md:text-sm lg:text-base px-3 flex transition delay-100 duration-300 ease-initial hover:scale-110 hover:translate-y-1.5">Opção 1</a>

                <a href="/?page=placeholder" class="page2 text-xs md:text-sm lg:text-base px-3 flex transition delay-100 duration-300 ease-initial hover:scale-110 hover:translate-y-1.5">Opção 2</a>

                <a href="/?page=placeholder" class="page3 text-xs md:text-sm lg:text-base px-3 flex transition delay-100 duration-300 ease-initial hover:scale-110 hover:translate-y-1.5">Opção 3</a>

            </nav>

            <div class="auth_options flex place-items-center">

                <a href="/?page=placeholder" class="signin_btn text-xs md:text-sm lg:text-base px-2 flex transition delay-100 duration-300 ease-initial hover:scale-110 hover:-translate-x-1.5 hover:translate-y-1.5">Cadastrar</a>

                <a href="/?page=placeholder" class="login_btn text-xs md:text-sm lg:text-base px-2 flex transition delay-100 duration-300 ease-initial hover:scale-110 hover:-translate-x-1.5 hover:translate-y-1.5">Entrar</a>

            </div>

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
        <script src="/dist/bundle.js<?php //echo "?v=" . filemtime('/dist/bundle.js'); ?>"></script>

    </body>
</html>
