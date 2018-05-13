<template>
    <div>
        <h2 class="m-2 mt-4" id="formulaire">Notes</h2>
        <div v-if="!showForm">
            <div class="btn btn-secondary" @click="showForm = !showForm">Ajouter</div>
        </div>
        <div v-else>
            <div class="btn btn-secondary" @click="showForm = !showForm">Annuler</div>
        </div>
    
    
        <div class="card m-4" v-if="showForm">
            <div v-if="edit">
                <div class="card-header">Vous modifiez: <strong> {{ note.title }} </strong></div>
            </div>
            <div v-else>
                <div class="card-header">Ajouter une note</div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Titre de la note</label>
                    <input v-model="note.title" type="text" class="form-control" id="title" placeholder="Entrez le titre">
                </div>
    
                <div class="form-group">
                    <label for="body">Description</label>
                    <input v-model="note.body" type="text" class="form-control" id="body" placeholder="Description">
                </div>
    
                <div class="btn btn-info" @click="addNote">Enregistrer</div>
            </div>
        </div>
    
        <h2 class="m-2">Toutes les notes</h2>
    
        <div class="card card-body m-4" v-for="note in notes.data" v-bind:key="note.id">
            <div class="">
                <h3>{{ note.title }}</h3>
                <p>{{ note.body }}</p>
                <hr>
                <small>Note ID: {{ note.id }} </small>
                <br>
                <small>Last updated: {{ note.updated_at }} </small>
                <hr>
    
                <div class="row">
                    <div class="col-md-8">
                        <a class="btn btn-primary" :href="`http://localhost:8000/storage/documents/${note.file_name}`">Télécharger</a>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="#formulaire" class="btn btn-warning" @click="updateNote(note)">Modifier</a>
                        <a class="btn btn-danger" @click="deleteNote(note.id)">Effacer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                notes: [],
                note: {
                    course_id: 1,
                    user_id: 1,
                    file_name: "document_1525777760.rtf",
                },
                edit: false,
                showForm: false
            };
        },
    
        created() {
            this.fetchNotes();
        },
    
        methods: {
            fetchNotes() {
                let uri = "http://localhost:8000/api/notes";
                this.axios.get(uri)
                    .then(response => {
                        this.notes = response.data;
                    })
            },
    
            addNote() {
                if (this.edit == false) {
                    let uri = "http://localhost:8000/api/notes";
                    this.axios.post(uri, this.note);
                    alert('Note ajoutée');
                    this.note = {
                        user_id: 1,
                        course_id: 1,
                        file_name: "document_1525777760.rtf",
                    };
                    this.fetchNotes();
                }
                //update dans la base de données
                else {
                    let uri = "http://localhost:8000/api/notes/" + this.note.id;
                    this.axios.put(uri, this.note);
                    alert('Note Modifiée');
                    this.note = {
                        user_id: 1,
                        course_id: 1,
                        file_name: "document_1525777760.rtf",
                    };
                    this.fetchNotes();
                    this.edit = false;
                }
            },
    
            updateNote(note) {
                //duplication de l'objet pour éviter qu'il ne se modifie instanément
                this.note = JSON.parse(JSON.stringify(note));
                this.edit = true;
                this.showForm = true;
            },
    
            deleteNote(id) {
                if (confirm('Voulez-vous vraiment supprimer la note?')) {
                    let uri = "http://localhost:8000/api/notes/" + id;
                    this.axios.delete(uri)
                    this.fetchNotes()
                }
            },
    
            makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                };
                this.pagination = pagination;
            }
        }
    };
</script>