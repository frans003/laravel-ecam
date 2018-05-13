<template>
<div>

    <h2 class="m-4">Notes</h2>

    <form @submit.prevent="addArticle" class="mb-3">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Title" v-model="note.title">
      </div>
      <div class="form-group">
        <textarea class="form-control" placeholder="Body" v-model="note.body"></textarea>
      </div>
      <button type="submit" class="btn btn-success btn-block">Ajouter</button>
    </form>

    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchArticles(pagination.prev_page_url)">Previous</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchArticles(pagination.next_page_url)">Next</a></li>
      </ul>
    </nav>

    <div class="card card-body mb-2" v-for="note in notes" v-bind:key="note.id">
        <h3>{{ note.title }}</h3>
        <p>{{ note.body }}</p>
        <hr>
        <button @click="editArticle(note)" class="btn btn-warning mb-2">Edit</button>
        <button @click="deleteArticle(note.id)" class="btn btn-danger">Effacer la note</button>
    </div>
        
</div>
</template>

<script>

    export default {
        data() {
            return{
                notes: [],
                note: {
                    id: '',
                    user_id: 1,
                    course_id: 1,
                    title: '',
                    body: '',
                    file_name:'document_1525777760.rtf',
                },
                note_id: '',
                pagination: {},
                edit: false
            };
        },

        created() {
            this.fetchArticles();
        },

        methods: {
            fetchArticles(page_url) {
            let vm = this;
            page_url = page_url || 'http://localhost:8000/api/notes';
            fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.notes = res.data;
                    vm.makePagination(res.meta, res.links);
        })
        .catch(err => console.log(err));
        },
        
        makePagination(meta, links) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            };
        this.pagination = pagination;
        },

        deleteArticle(id) {
            if (confirm('Sur?')) {
                fetch(`http://localhost:8000/api/notes/${id}`, {
                method: 'delete'
                })

                .then(res => res.json())
                .then(data => {
                    alert('La note a été effacée');
                    this.fetchArticles();
                })
                .catch(err => console.log(err));
            }
        },
        
        addArticle() {
            if (this.edit === false) {
                // Add
                fetch('http://localhost:8000/api/notes', {
                method: 'post',
                body: JSON.stringify(this.note),
                headers: {
                    'content-type': 'application/json'
                }
                })
                .then(res => res.json())
                .then(data => {
                    this.note.title = '';
                    this.note.body = '';
                    this.note.user_id = '';
                    this.note.file_name = '';
                    this.note.course_id = '';
                    alert('Note ajoutée');
                    this.fetchArticles();
                })
                .catch(err => console.log(err));
            } 
        else {
        // Update
        fetch('http://localhost:8000/api/notes/'+this.note.id, {
          method: 'put',
          body: JSON.stringify(this.note),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.note.title = '';
            this.note.body = '';
            this.note.user_id = '';
            this.note.file_name = '';
            this.note.course_id = '';
            alert('Article Updated');
            this.edit = false;
            this.fetchArticles();
          })
          .catch(err => console.log(err));
      }
    },
        editArticle(note) {
        this.edit = true;
        this.note.id = note.id;
        this.note.note_id = note.id;
        this.note.title = note.title;
        this.note.body = note.body;
        this.note.file_name = note.file_name;
        this.note.course_id = note.course_id;
        this.note.user_id = note.user_id;
        }
        } 
    }
</script>
