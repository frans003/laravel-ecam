<template>
<div>
    <div class="card card-body" v-for="note in notes" v-bind:key="note.id">
            <div class="row">
                <div class="col-md-8 col-sm-8">
                    <h3>{{ note.title }}</h3>
                    <p>{{ note.body }}</p>
                    <small>Créé le {{ note.date.filters }}</small>
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
                    id: '',
                    title: '',
                    body: ''
                }, 

                note_id: '',
                edit: false
            }
        },
        created() {
            this.fetchArticles();
        },
        methods: {
            fetchArticles() {
                fetch('http://localhost:8888/api/notes')
                .then(res => {
                    this.notes = res.data;
                })
            }
        }
    }

</script>