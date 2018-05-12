<template>
<div>

    <h2 class="m-4">Notes</h2>

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
        <!-- <button @click="editArticle(article)" class="btn btn-warning mb-2">Edit</button>
        <button @click="deleteArticle(article.id)" class="btn btn-danger">Delete</button> -->
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
                    user_id: '',
                    course_id: '',
                    title: '',
                    body: '',
                    file_name:'',
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
        



        } 
    }
</script>
