from ftplib import FTP
import os
from dotenv import load_dotenv

# Carregar variáveis do arquivo .env
load_dotenv()

# Configurações do FTP
FTP_HOST = os.getenv("FTP_HOST")
FTP_USER = os.getenv("FTP_USER")
FTP_PASS = os.getenv("FTP_PASS")
FTP_DIR = os.getenv("FTP_DIR")


# Conectar ao servidor FTP
ftp = FTP(FTP_HOST)
ftp.login(FTP_USER, FTP_PASS)
ftp.cwd(FTP_DIR)  # Mudar para o diretório correto

def ensure_remote_dir(ftp_conn, remote_dir):
    """
    Garante que o diretório remoto exista.
    Navega pela árvore de diretórios, criando os que não existirem.
    Após a criação, volta para o diretório original.
    """
    original_dir = ftp_conn.pwd()
    for folder in remote_dir.split('/'):
        if folder:  # ignora strings vazias
            try:
                ftp_conn.cwd(folder)
            except Exception:
                ftp_conn.mkd(folder)
                ftp_conn.cwd(folder)
    ftp_conn.cwd(original_dir)

def upload_file(local_file, remote_filename):
    """
    Envia o arquivo local para o servidor FTP com o nome remote_filename.
    """
    with open(local_file, "rb") as file_obj:
        ftp.storbinary(f"STOR {remote_filename}", file_obj)
    print(f"Upload de {local_file} concluído!")

# Lista de diretórios e arquivos a serem ignorados
ignore_dirs = {'node_modules', 'vendor', '.git', '.vscode'}
ignore_files = {'.env', 'public/google2172dc8bcad3d5a6.html', 'package-lock.json', 'package.json', 'webpack.config.js'}  # pode incluir outros, se necessário

# Diretório base do projeto (pode ser alterado, se desejar)
base_dir = os.getcwd()

for root, dirs, files in os.walk(base_dir):
    # Remove os diretórios que não queremos percorrer
    dirs[:] = [d for d in dirs if d not in ignore_dirs]

    for file in files:
        # Ignora arquivos que estejam na lista ou que comecem com '.env'
        if file in ignore_files or file.startswith('.env'):
            continue

        local_path = os.path.join(root, file)
        # Calcula o caminho relativo em relação ao diretório base
        rel_path = os.path.relpath(local_path, base_dir)
        remote_subdir = os.path.dirname(rel_path)

        if remote_subdir and remote_subdir != '.':
            # Garante que o diretório remoto exista
            ensure_remote_dir(ftp, remote_subdir)
            # Navega para o diretório remoto correspondente
            ftp.cwd(remote_subdir)
            # Faz o upload do arquivo (usando somente o nome do arquivo)
            upload_file(local_path, file)
            # Volta para o diretório base remoto (FTP_DIR)
            ftp.cwd(FTP_DIR)
        else:
            # Se o arquivo está na raiz, envia diretamente
            upload_file(local_path, file)

ftp.quit()
print("Upload completo!")
