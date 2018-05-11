<template>
<div>
    <h2 class="m-4">Notes</h2>
    <nav aria-label="page navigation example">
        <ul class="pagination">
            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item" @click="fetchArticles(pagination.prev.page_url)"><a class="page-link" href="">Previous</a></li>
            <li class = "page-item"><a class="page-link" href="">Next</a></li>
        </ul>
    </nav>
    
    <div class="card card-body m-2" v-for="note in notes" v-bind:key="note.id">
        <div class="col-md-8 col-sm-8">
            <h3>{{ note.title }}</h3>
            <p>{{ note.body }}</p>
            <small> {{note.id }} </small>
            
        </div>
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
                    title: '',
                    body: '',
                    date:'',
                },
                note_id: '',
                pagination: {},
                edit: false,
            };
        },

        created() {
            this.fetchArticles();
        },

        methods: {
            fetchArticles(page_url) {
                let vm = this;
                this.axios.get('http://localhost:8000/api/notes')
                .then(response => {
                    this.notes = response.data;
                    vm.makePagination(response.meta, response.links);
                })
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