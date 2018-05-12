<template>
<div>

    <h2 class="m-4">Notes</h2>
        
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
        })
        .catch(err => console.log(err));
        },
        } 
    }
</script>
