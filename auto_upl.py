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


# Conectar ao servidor FTP
ftp = FTP(FTP_HOST)
ftp.login(FTP_USER, FTP_PASS)
ftp.cwd(FTP_DIR)  # Mudar para o diretório correto

def ensure_remote_dir(ftp_conn, remote_dir):
    """
    Garante que o diretório remoto exista, ignorando erros se ele já existir.
    """
    original_dir = ftp_conn.pwd()
    
    # Substituir \ por / (para evitar problemas no FTP)
    remote_dir = remote_dir.replace("\\", "/")  

    for folder in remote_dir.split('/'):
        if folder:  # Ignorar strings vazias
            try:
                ftp_conn.cwd(folder)
            except error_perm as e:
                if "550" in str(e):  # Erro 550 significa que o diretório já pode existir
                    pass
                else:
                    try:
                        ftp_conn.mkd(folder)
                        ftp_conn.cwd(folder)
                    except error_perm as mkd_error:
                        print(f"Erro ao criar diretório {folder}: {mkd_error}")
    
    ftp_conn.cwd(original_dir)  # Retorna ao diretório original

def upload_file(local_file, remote_filename):
    """
    Envia um arquivo local para o servidor FTP.
    """
    with open(local_file, "rb") as file_obj:
        ftp.storbinary(f"STOR {remote_filename}", file_obj)
    print(f"Upload de {local_file} concluído!")

# Lista de diretórios e arquivos a serem ignorados
ignore_dirs = {'node_modules', 'vendor', '.git', '.vscode'}
ignore_files = {'.env', 'package-lock.json', 'package.json', 'webpack.config.js'}  # pode incluir outros, se necessário

# Diretório base do projeto (pode ser alterado, se desejar)
base_dir = os.getcwd()

for root, dirs, files in os.walk(base_dir):
    # Remover diretórios ignorados
    dirs[:] = [d for d in dirs if d not in ignore_dirs]

    for file in files:
        if file in ignore_files or file.startswith('.env'):
            continue

        local_path = os.path.join(root, file)
        rel_path = os.path.relpath(local_path, base_dir).replace("\\", "/")  # Ajusta separador

        remote_subdir = os.path.dirname(rel_path)

        if remote_subdir and remote_subdir != ".":
            ensure_remote_dir(ftp, remote_subdir)
            ftp.cwd(remote_subdir)
            upload_file(local_path, os.path.basename(rel_path))
            ftp.cwd(FTP_DIR)  # Retornar para a pasta base
        else:
            upload_file(local_path, file)

ftp.quit()
print("Upload completo!")
