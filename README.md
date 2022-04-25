# ProgettoTecnologieWeb # 

In questo repository sono presenti i sorgenti del progetto di Tecnologie Web ASD a.a. 2020/2021.

# :muscle: Progettisti: @EnricoBreg , @marcoBelt99, @FrancescoSindacoUnife , @DavideZanellato1999

# Comandi principali:

- comando: `git clone <link>` . Clona nella directory corrente il repository specificato in <link>

- comando: `git add <nome_file_da_aggiungere_al_repository>` . Aggiunge il file all'area di staging

- comando: `git commit -m "<messaggio_di_cosa_è_stato_modificato>"`. Prepara il file per il push

- comando: `git push`. Per aggiungere i file qui su github.

- comando: `git pull`. Per aggiornare le modifiche fatte del repository anche nel nostro pc

# Istruzioni per l'esecuzione

Ho provato (Marco) ad automatizzare l' insieme di comandi da fare ogni volta che si vuole fare un pull nel file: [script.sh](https://github.com/marcoBelt99/ProgettoTecnologieWeb/blob/main/script.sh)

Nella cartella: **`ProgettoTecnologieWeb`**, eseguire il comando: `./script.sh` 

(Se da problemi legati ai perfmessi fare:`chmod +rwx` e successivamente: `./script.sh`)

Se il problema persiste, eseguire i comandi nell'ordine:
Una volta clonato il repository, prima di avviare l'applicazione seguire i seguenti steps:
- Entrare nella repository del progetto (**GimmeFund**) ed eseguire:

	-	`composer install`

	-	`cp .env.example .env`

	-	`php artisan key:generate`

	-	`php artisan config:cache`

	-	`php artisan migrate:fresh`

	-	`php artisan db:seed`

- Avviare poi l'applicazione con:

	-	`php artisan serve`

# Aspetto applicazione

**Utente non registrato/non loggato**:
![non_utente](https://user-images.githubusercontent.com/74368037/165177942-c76758b0-e965-4f74-840e-526152193ec3.png)

**Utente normale**:
![gf-1](https://user-images.githubusercontent.com/74368037/165176716-e3642e8e-8135-4b2d-8581-cae945144592.png)
![Schermata da 2022-04-25 23-29-05](https://user-images.githubusercontent.com/74368037/165178877-7cba685f-bad7-4d3a-83dd-67cf1f37dc12.png)
![Schermata da 2022-04-25 23-31-36](https://user-images.githubusercontent.com/74368037/165178887-b1f509ef-fd1f-46bb-8e99-c786870c9955.png)
![Schermata da 2022-04-25 23-31-48](https://user-images.githubusercontent.com/74368037/165178913-d38be7f4-83ec-43a3-a502-06001be71145.png)
![Schermata da 2022-04-25 23-32-16](https://user-images.githubusercontent.com/74368037/165178935-01f0dce0-6de0-434f-b51b-bab9e58430e3.png)
![Schermata da 2022-04-25 23-32-33](https://user-images.githubusercontent.com/74368037/165178948-612073bd-557d-446d-86de-2042d778fe30.png)
![Schermata da 2022-04-25 23-32-48](https://user-images.githubusercontent.com/74368037/165178955-3a32e077-e045-48c0-b0b0-0d235a95cf84.png)

**Amministratore**:
Statistiche:
![gf-2](https://user-images.githubusercontent.com/74368037/165176828-753c5070-9237-4982-84eb-315c68469715.png)
Gestione categorie di raccolte fondi:
![admin2](https://user-images.githubusercontent.com/74368037/165177239-97a843d7-b3a7-420b-ac70-1f6f1e7d7c9a.png)
Gestione utenti:
![Schermata da 2022-04-25 23-37-22](https://user-images.githubusercontent.com/74368037/165179490-fd8609ee-d2b5-4446-a227-a98fd19cbd88.png)
