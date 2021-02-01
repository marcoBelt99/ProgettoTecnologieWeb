# ProgettoTecnologieWeb # 

In questo repository sono presenti i sorgenti del progetto di Tecnologie Web ASD a.a. 2020/2021.



# Comandi principali:

- comando: `git clone <link>` . Clona nella directory corrente il repository specificato in <link>

- comando: `git add <nome_file_da_aggiungere_al_repository>` . Aggiunge il file all'area di staging

- comando: `git commit -m "<messaggio_di_cosa_è_stato_modificato>"`. Prepara il file per il push

- comando: `git push`. Per aggiungere i file qui su github.

- comando: `git pull`. Per aggiornare le modifiche fatte del repository anche nel nostro pc

# Istruzioni per l'esecuzione

Una volta clonato il repository, prima di avviare l'applicazione seguire i seguenti steps:
- Configurare il file .env
- Entrare nella repository del progetto ed eseguire:
	cp .env.example .env
	composer install
	php artisan key:generate
	php artisan config:cache
	php artisan migrate
	php artisan db:seed
- Avviare poi l'applicazione con
	php artisan serve

