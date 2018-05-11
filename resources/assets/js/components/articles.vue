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
            this.fetchNotes();
        },

        methods: {
            fetchNotes(page_url) {
                let vm = this;
                page_url = page_url || 'http://localhost:8888/api/notes'
                this.axios.get(page_url)
                    .then(res => {
                        this.notes = res.data.data;
                        vm.makePagination(res.meta, res.links);
                    })
                    .catch(err => console.log(err));

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