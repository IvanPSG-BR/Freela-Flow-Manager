# ANTES DE EXECUTAR O SCRIPT:
# - Verificar o caminho definido em config.php
# - Revisar páginas modificadas e confirmar que os caminhos estão corretos
# - Executar no terminal "npm run build" (sem aspas)
# ============================================================================ #
# DEPOIS DE EXECUTADO:
# - Verificar o caminho definido em config.php novamente
# - (Re)revisar páginas modificadas e confirmar que os caminhos estão corretos

from ftplib import FTP, error_perm
import os
from dotenv import load_dotenv

# Carregar variáveis do arquivo .env
load_dotenv()

# Configurações do FTP
FTP_HOST = os.getenv("FTP_HOST")
FTP_USER = os.getenv("FTP_USER")
FTP_PASS = os.getenv("FTP_PASS")
FTP_DIR = os.getenv("FTP_DIR")

def mostrar_menu():
    """
    Exibe o menu de opções e retorna a escolha do usuário
    """
    print("\n=== Menu de Upload ===")
    print("[0] Cancelar operação")
    print("[1] Enviar arquivos específicos")
    print("[2] Enviar tudo")
    
    while True:
        try:
            escolha = int(input("\nEscolha uma opção: "))
            if escolha in [0, 1, 2]:
                return escolha
            print("Opção inválida! Escolha 0, 1 ou 2.")
        except ValueError:
            print("Por favor, digite um número válido!")

# Conectar ao servidor FTP
ftp = FTP(FTP_HOST)
ftp.login(FTP_USER, FTP_PASS)
ftp.cwd(FTP_DIR)  # Mudar para o diretório correto

def set_permissions(ftp_conn, path, is_dir=False):
    """
    Define as permissões corretas para arquivos e diretórios
    """
    try:
        if is_dir:
            ftp_conn.sendcmd(f'SITE CHMOD 755 {path}')  # Permissão para diretórios
        else:
            ftp_conn.sendcmd(f'SITE CHMOD 644 {path}')  # Permissão para arquivos
    except error_perm as e:
        print(f"Aviso: Não foi possível definir permissões para {path}: {e}")

def ensure_remote_dir(ftp_conn, remote_dir):
    """
    Garante que o diretório remoto exista, criando-o se necessário.
    """
    original_dir = ftp_conn.pwd()
    remote_dir = remote_dir.replace("\\", "/")

    for folder in remote_dir.split('/'):
        if folder:
            try:
                ftp_conn.cwd(folder)
            except error_perm:
                try:
                    ftp_conn.mkd(folder)
                    ftp_conn.cwd(folder)
                    set_permissions(ftp_conn, folder, is_dir=True)  # Define permissões do novo diretório
                except error_perm as mkd_error:
                    print(f"Erro ao criar diretório {folder}: {mkd_error}")
                    raise
    
    ftp_conn.cwd(original_dir)

def upload_file(local_file, remote_filename):
    """
    Envia um arquivo local para o servidor FTP e define suas permissões.
    """
    with open(local_file, "rb") as file_obj:
        ftp.storbinary(f"STOR {remote_filename}", file_obj)
        set_permissions(ftp, remote_filename, is_dir=False)  # Define permissões do arquivo
    print(f"Upload de {local_file} concluído!")

# Lista de diretórios e arquivos a serem ignorados
ignore_dirs = {'node_modules', 'vendor', '.git', '.vscode'}
ignore_files = {'.env', 'package-lock.json', 'package.json', 'webpack.config.js', 'Dockerfile', 'auto_upl.py', 'apache.conf'}

# Lista de arquivos específicos para upload
# Adicione ou remova arquivos conforme necessário
# Exemplo: ['pasta/arquivo.php', 'index.html', 'css/estilo.css']
arquivos_especificos = ['src/views/home/home.php', 'dist/index.html']

def main():
    escolha = mostrar_menu()

    if escolha == 0:
        print("Operação cancelada!")
        ftp.quit()
        return
    
    base_dir = os.getcwd()

    if escolha == 1:
        # Enviar arquivos específicos da lista predefinida
        if not arquivos_especificos:
            print("A lista de arquivos específicos está vazia!")
            print("Adicione os arquivos desejados na variável 'arquivos_especificos' no código.")
            ftp.quit()
            return

        print("\nEnviando arquivos da lista predefinida:")
        for arquivo in arquivos_especificos:
            print(f"- {arquivo}")
            try:
                local_path = os.path.abspath(arquivo)
                if not os.path.exists(local_path):
                    print(f"Arquivo não encontrado: {arquivo}")
                    continue

                rel_path = os.path.relpath(local_path, base_dir).replace("\\", "/")
                remote_subdir = os.path.dirname(rel_path)

                if remote_subdir and remote_subdir != ".":
                    ensure_remote_dir(ftp, remote_subdir)
                    ftp.cwd(remote_subdir)
                    upload_file(local_path, os.path.basename(rel_path))
                    ftp.cwd(FTP_DIR)
                else:
                    upload_file(local_path, os.path.basename(arquivo))
            except Exception as e:
                print(f"Erro ao enviar {arquivo}: {e}")
    
    elif escolha == 2:
        # Enviar todos os arquivos
        for root, dirs, files in os.walk(base_dir):
            # Remover diretórios ignorados
            dirs[:] = [d for d in dirs if d not in ignore_dirs]

            for file in files:
                if file in ignore_files or file.startswith('.env'):
                    continue

                local_path = os.path.join(root, file)
                rel_path = os.path.relpath(local_path, base_dir).replace("\\", "/")

                remote_subdir = os.path.dirname(rel_path)

                if remote_subdir and remote_subdir != ".":
                    ensure_remote_dir(ftp, remote_subdir)
                    ftp.cwd(remote_subdir)
                    upload_file(local_path, os.path.basename(rel_path))
                    ftp.cwd(FTP_DIR)
                else:
                    upload_file(local_path, file)

    ftp.quit()
    print("Upload completo!")

if __name__ == "__main__":
    main()
