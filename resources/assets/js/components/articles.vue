<template>
  <!-- Formulaire d'ajout et modification de note -->
  <div>
    <h2 class="m-2 mt-4" id="formulaire">Notes</h2>

    <hr>
  
    <div v-if="!showForm">
      <div class="btn btn-secondary m-2" @click="showForm = !showForm">Ajouter <i class="fas fa-plus-circle"></i></div>
    </div>
    <div v-else>
      <div class="btn btn-secondary m-2" @click="showForm = !showForm">Annuler <i class="fas fa-minus-circle"></i></div>
    </div>
  
  <!-- Show et hide le form en cliquant sur le bouton -->
  
    <div class="card m-4" v-if="showForm">
      <div v-if="edit">
        <div class="card-header">Vous modifiez la note ID: <strong> {{ note.id }} </strong></div>
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
  
        <div class="form-group">
          <label for="cours">Cours</label>
          <select v-model="note.course_id" class="form-control" id="">
                <option v-for="course in courses.data" :value="course.id" v-bind:key="course.id"> {{course.name}}</option>
              </select>
        </div>
  
        <div class="btn btn-info" @click="addNote">Enregistrer</div>
        
      </div>
    </div>
  
    <hr>
  
    <!-- Pagination -->
  
    <nav aria-label="Pagination">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchNotes(pagination.prev_page_url)">Previous</a></li>
  
        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
  
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchNotes(pagination.next_page_url)">Next</a></li>
      </ul>
    </nav>
  
    <!-- Liste des notes trié dans le controller -->
  
    <h2 class="m-2"><i class="fas fa-archive"></i> Toutes les notes</h2>
  
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
            <a class="btn btn-primary" :href="`http://localhost:8000/storage/documents/${note.file_name}`"><i class="fas fa-download"></i></a>
          </div>
          <div class="col-md-4 text-right">
            <a style="color:white" href="#formulaire" class="btn btn-warning" @click="updateNote(note)"><i class="fas fa-pencil-alt"></i></a>
            <a style="color:white" class="btn btn-danger" @click="deleteNote(note.id)"><i class="far fa-trash-alt"></i></a>
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
        file: '',
        courses: [],
        course: {},
        notes: [],
        note: {
          course_id: 1,
          user_id: 1,
          file_name: "document_1525777760.rtf"
        },
        edit: false,
        pagination: {},
        showForm: false
      };
    },
  // API des notes et cours
    created() {
      this.fetchNotes();
      this.fetchCourses();
    },
  
    methods: {
      fetchNotes(page_url) {
        let uri = "";
        if (page_url) {
          uri = page_url;
        } else {
          uri = "http://localhost:8000/api/notes";
        }
        this.axios.get(uri)
          .then(response => {
            this.notes = response.data;
            this.makePagination(this.notes);
          });
      },
  
      fetchCourses() {
        let uri = "http://localhost:8000/api/cours";
        this.axios.get(uri)
          .then(response => {
            this.courses = response.data;
          })
      },
  
      makePagination(notes) {
        let pagination = {
          current_page: notes.meta.current_page,
          last_page: notes.meta.last_page,
          next_page_url: notes.links.next,
          prev_page_url: notes.links.prev
        };
        this.pagination = pagination;
      },
  
      addNote() {
        if (this.edit == false) {
          let uri = "http://localhost:8000/api/notes";
          this.axios.post(uri, this.note);
          alert("Note ajoutée");
          this.note = {
            user_id: 1,
            course_id: 1,
            file_name: "document_1525777760.rtf"
          };
          this.fetchNotes();
        } else {
          //update dans la base de données
          let uri = "http://localhost:8000/api/notes/" + this.note.id;
          this.axios.put(uri, this.note);
          alert("Note Modifiée");
          this.note = {
            user_id: 1,
            course_id: 1,
            file_name: "document_1525777760.rtf"
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
        if (confirm("Voulez-vous vraiment supprimer la note?")) {
          let uri = "http://localhost:8000/api/notes/" + id;
          this.axios.delete(uri);
          this.fetchNotes();
        }
      },
    }
  };
</script>