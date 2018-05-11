<template>
<div>
    <h2>Notes</h2>
    <div class="card card-body" v-for="note in notes" v-bind:key="note.id">
        <div class="col-md-8 col-sm-8">
            <h3>{{ note.title }}</h3>
            <p>{{ note.body }}</p>
            
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
                    cover_image: ''
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
            fetchArticles() {
                this.axios.get('http://localhost:8000/api/notes')
                .then(response => {
                    this.notes = response.data;
                })
            },

            makePagination(meta, links){
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