# ProgettoTecnologieWeb # 

In questo repository sono presenti i sorgenti del progetto di Tecnologie Web ASD a.a. 2020/2021.



# Comandi principali:

- comando: `git clone <link>` . Clona nella directory corrente il repository specificato in <link>

- comando: `git add <nome_file_da_aggiungere_al_repository>` . Aggiunge il file all'area di staging

- comando: `git commit -m "<messaggio_di_cosa_è_stato_modificato>"`. Prepara il file per il push

- comando: `git push`. Per aggiungere i file qui su github.

- comando: `git pull`. Per aggiornare le modifiche fatte del repository anche nel nostro pc

# Istruzioni per l'esecuzione

Ho provato (Marco) ad automatizzare l' insieme di comandi da fare ogni volta che si vuole fare un pull nel file: [script.sh](https://github.com/marcoBelt99/ProgettoTecnologieWeb/blob/main/script.sh)

Nella cartella: - ![#f03c15](https://via.placeholder.com/15/f03c15/000000?text=+) `ProgettoTecnologieWeb`, eseguire il comando: `./script.sh` 

(Se da problemi legati ai perfmessi fare:`chmod +rwx` e successivamente: `./script.sh`)

Se il problema persiste, eseguire i comandi nell'ordine:
Una volta clonato il repository, prima di avviare l'applicazione seguire i seguenti steps:
- Entrare nella repository del progetto (GimmeFund) ed eseguire:

	-	`composer install`

	-	`cp .env.example .env`

	-	`php artisan key:generate`

	-	`php artisan config:cache`

	-	`php artisan migrate:fresh`

	-	`php artisan db:seed`

- Avviare poi l'applicazione con:

	-	`php artisan serve`
