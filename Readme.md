# Bloc Notes

A simple notes web applications. You can create, update and delete notes using a Laravel API and Vue frontend.


## Used technologies

### Backend 
- PHP 8.3
- Laravel 12
- MySQL
- Docker

### Frontend
- Vue 3
- TypeScript
- SCSS


## Installation

### Requisites
- Docker 
- Node 
- Composer 

### Step 1
```bash 
git clone https://github.com/pmunne/bloc_notes.git 
cd bloc_notes
```
### Step 2
```bash
docker-compose up -d --build
docker exec -it notes-api composer install
docker exec -it notes-api php artisan migrate --seed
```
- API: `http://localhost:8000/api/notes`
- Phpmyadmin: `http://localhost:8888`

### Step 3
From /bloc_notes
```bash
docker exec -it notes-app sh
npm install 
```
- Frontend: `http://localhost:5173`

---
## Authentication
All API request requires HTTP header: 'Doonamis'

## Endpoints

  GET|HEAD    api/Notes         notes.index   › Api\NoteController@index  
  POST        api/notes         notes.store   › Api\NoteController@store  
  GET|HEAD    api/notes/{note}  notes.show    › Api\NoteController@show  
  PUT|PATCH   api/notes/{note}  notes.update  › Api\NoteController@update  
  DELETE      api/notes/{note}  notes.destroy › Api\NoteController@destroy  

### Docker structure
The files structure goes like:

- bloc_notes
    - backend
        - docker
            - nginx: defautl.conf
            - php: Dockerfile
    - frontend
        - docker: Dockerfile
    - docker-compose.yml

### Frontend Structure
- src
    - assets
        - style: SCSS
    - components 
        - NoteCard.vue
        - NoteForm.vue
        - SkeletonNoteCard.vue
    - router
        - index.ts
    - views
        - NotesList.vue
    - App.vue
### Backend structure
- app
    - Http
        - Controllers: NoteController.php
        - Middleware: CheckHeader.php
    - Mopdels: Note.php
    - Providers: RouteServiceProvider
- database
    - migrations: create_notes_table.php
    - seeders: NoteSeeder.php
- routes: api.php
- .env

## Author
**Pau Munné Martínez**
[Linkedin](https://www.linkedin.com/in/pau-munné-martínez-90251123b)